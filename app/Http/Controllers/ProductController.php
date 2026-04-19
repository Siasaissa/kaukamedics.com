<?php

namespace App\Http\Controllers;

use App\Concerns\ResolvesProductImages;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    use ResolvesProductImages;

    // Display all products
    public function index(Request $request)
    {
        $query = $request->query('query');
        $sort = $request->query('sort', 'latest');
        $perPage = (int) $request->query('per_page', 12);

        $allowedPerPage = [12, 24, 36];
        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 12;
        }

        $sidebarProducts = Product::query()
            ->latest('id')
            ->select(['id', 'name', 'unit'])
            ->take(8)
            ->get();

        $products = Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            });

        switch ($sort) {
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $products->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $products->orderBy('name', 'desc');
                break;
            case 'latest':
            default:
                $sort = 'latest';
                $products->orderBy('id', 'desc');
                break;
        }

        $products = $products->paginate($perPage)->withQueryString();

        return view('products', compact('products', 'sort', 'perPage', 'query', 'sidebarProducts'));
    }

    // Add product to cart (session only)
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Show cart contents from session
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Remove item from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Item removed successfully!');
    }

    // Update quantity
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int)$request->quantity);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }

    // Proceed to checkout (save to DB here later)
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty!');
        }

        // For now, just show checkout confirmation
        return view('checkout', compact('cart'));
    }
    public function adminProduct(){
       $products = Product::orderBy('id', 'desc')->paginate(20);
       $products->setCollection($this->appendImageUrls($products->getCollection()));

        return view('admin.products.index',compact('products'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'unit'  => 'nullable|string|max:50',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // optional
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public'); 
        $validated['image'] = $imagePath; // store the path in DB
    }

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
}


public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'unit'  => 'nullable|string|max:50',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        // Optionally delete old image
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $imagePath = $request->file('image')->store('products', 'public'); 
        $validated['image'] = $imagePath;
    }

    $product->update($validated);

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
}


public function destroy(Product $product)
{
    // Optionally delete image
    if ($product->image && file_exists(public_path('img/' . $product->image))) {
        unlink(public_path('img/' . $product->image));
    }

    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
}

public function uploadExcel(Request $request)
{
    $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,csv'
    ]);

    Excel::import(new ProductsImport, $request->file('excel_file'));

    return redirect()->back()->with('success', 'Products uploaded successfully!');
}

// Add special order (custom product) to cart
public function specialOrder(Request $request)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'quantity' => 'nullable|integer|min:1',
        'notes' => 'nullable|string|max:255',
    ]);

    $cart = session()->get('cart', []);

    // Create a unique ID for this custom item
    $id = 'custom-' . uniqid();

    $cart[$id] = [
        "name" => $request->product_name,
        "price" => 0, // unknown price (admin can review later)
        "quantity" => $request->quantity ?? 1,
        "image" => "default.png", // placeholder image
        "notes" => $request->notes,
        "custom" => true,
    ];

    session()->put('cart', $cart);

    return redirect()->route('cart')->with('success', 'Your special order has been added to the cart!');
}

//start of Api function

  public function apiIndex(Request $request)
    {
        $query = $request->query('query');
        $perPage = $request->query('per_page', 10);

        $products = Product::when($query, function($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
        ]);
    }

    // --- Get single product ---
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $product = $this->appendImageUrl($product);
        $relatedProducts = $this->appendImageUrls(
            Product::where('id', '!=', $product->id)
                ->latest('id')
                ->take(6)
                ->get()
        );

        $productDescription = 'Our medical equipment is selected to meet the daily demands of hospitals, clinics, laboratories, and healthcare professionals. Each item is chosen with a strong focus on durability, safety, reliable performance, and ease of use so that facilities can work with confidence in critical care environments.';
        $productQualityPoints = [
            'Built for dependable use in professional healthcare environments.',
            'Chosen for quality standards, practical handling, and long service life.',
            'Suitable for hospitals, clinics, pharmacies, and diagnostic settings.',
            'Supported by responsive supply service and consistent product sourcing.',
        ];

        return view('product-detail', compact('product', 'relatedProducts', 'productDescription', 'productQualityPoints'));
    }

    // Wishlist (session)
    public function addToWishlist($id)
    {
        $product = Product::find($id);
        if (!$product) return redirect()->back()->with('error', 'Product not found');

        $wishlist = session()->get('wishlist', []);
        $wishlist[$id] = ['name' => $product->name, 'price' => $product->price, 'image' => $product->image];
        session()->put('wishlist', $wishlist);

        return redirect()->back()->with('success', 'Added to wishlist');
    }

    public function removeFromWishlist($id)
    {
        $wishlist = session()->get('wishlist', []);
        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }
        return redirect()->back()->with('success', 'Removed from wishlist');
    }

    // Compare (session)
    public function addToCompare($id)
    {
        $product = Product::find($id);
        if (!$product) return redirect()->back()->with('error', 'Product not found');

        $compare = session()->get('compare', []);
        if (!isset($compare[$id])) {
            $compare[$id] = ['name' => $product->name, 'price' => $product->price, 'image' => $product->image];
        }
        session()->put('compare', $compare);

        return redirect()->back()->with('success', 'Added to compare');
    }

    public function removeFromCompare($id)
    {
        $compare = session()->get('compare', []);
        if (isset($compare[$id])) {
            unset($compare[$id]);
            session()->put('compare', $compare);
        }
        return redirect()->back()->with('success', 'Removed from compare');
    }

    // --- Cart operations ---
    private function getCart(Request $request)
    {
        return $request->session()->get('cart', []);
    }

    public function apiCart(Request $request)
    {
        $cart = $this->getCart($request);
        return response()->json([
            'success' => true,
            'data' => $cart
        ]);
    }

    public function apiAddToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $product = Product::find($request->id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $cart = $this->getCart($request);
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] += $quantity;
        } else {
            $cart[$request->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $quantity,
                "image" => $product->image
            ];
        }

        $request->session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cart' => $cart
        ]);
    }

    public function apiUpdateCart(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart($request);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            $request->session()->put('cart', $cart);
            return response()->json(['success' => true, 'cart' => $cart]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
    }

    public function apiRemoveFromCart(Request $request)
    {
        $request->validate(['id' => 'required']);
        $cart = $this->getCart($request);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            $request->session()->put('cart', $cart);
            return response()->json(['success' => true, 'cart' => $cart]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
    }

    // --- Special order ---
    public function apiSpecialOrder(Request $request)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'quantity' => 'nullable|integer|min:1',
        'notes' => 'nullable|string|max:255',
    ]);

    $cart = session()->get('cart', []);

    // Create a unique ID for this custom item
    $id = 'custom-' . uniqid();

    $cart[$id] = [
        "name" => $request->product_name,
        "price" => 0, // unknown price (admin can review later)
        "quantity" => $request->quantity ?? 1,
        "image" => "default.png", // placeholder image
        "notes" => $request->notes,
        "custom" => true,
    ];

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'message' => 'Your special order has been added to the cart!',
        'cart' => $cart, // optional: return updated cart
    ]);
}



}
