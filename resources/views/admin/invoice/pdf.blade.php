<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            margin: 0;
            padding: 15px;
        }
        h1, h2, h3, h4 {
            margin: 5px 0;
        }
        p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    {{-- Company Header --}}
    <div style="background-color: #f7941d; color: white; padding: 10px;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <!-- Logo -->
                <td width="100" valign="top">
                    @php
                        $logoPath = public_path('img/logo.png');
                        $logoBase64 = '';
                        if (file_exists($logoPath)) {
                            $imageData = file_get_contents($logoPath);
                            $logoBase64 = 'data:image/png;base64,' . base64_encode($imageData);
                        }
                    @endphp
                    @if($logoBase64)
                        <img src="{{ $logoBase64 }}" alt="Logo" style="height: 100px; width: auto;">
                    @endif
                </td>

                <!-- Company Info -->
                <td valign="top" style="padding-left: 10px;">
                    <h2 style="margin: 0; font-size: 14px;">KAUKA MEDICAL EQUIPMENT TANZANIA</h2>
                    <p style="margin: 2px 0; font-size: 9px;">Magomeni Kanisani</p>
                    <p style="margin: 2px 0; font-size: 9px;">P.O. Box 14012</p>
                    <p style="margin: 2px 0; font-size: 9px;">0625726051 / 0673726051</p>
                    <p style="margin: 2px 0; font-size: 9px;">kaukamedicalequipmenttanzania@gmail.com</p>
                    <p style="margin: 2px 0; font-size: 9px;">www.kaukamedics.com</p>
                    <p style="margin: 2px 0; font-size: 9px;">Tax ID: 150-846-935</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- Invoice Title --}}
    <div style="text-align: center; margin: 10px 0;">
        <h1 style="color: #f7941d; font-size: 18px; margin: 0;">INVOICE</h1>
    </div>

    {{-- Bill To and Invoice Info --}}
    <div style="margin-bottom: 10px;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <!-- Bill To -->
                <td width="60%" valign="top" style="font-size: 10px;">
                    <p style="margin: 2px 0;"><strong>Bill To</strong></p>
                    <p style="margin: 2px 0;"><strong>{{ $invoice->customer_name }}</strong></p>
                    <p style="margin: 2px 0;">{{ $invoice->customer_address }}</p>
                    <p style="margin: 2px 0;">{{ $invoice->customer_phone }}</p>
                    @if($invoice->customer_email)
                    <p style="margin: 2px 0;">{{ $invoice->customer_email }}</p>
                    @endif
                </td>

                <!-- Invoice Info -->
                <td valign="top" style="text-align: right;">
                    <h2 style="margin: 0; color: #f7941d; font-size: 16px;">{{ $invoice->invoice_number }}</h2>
                    <p style="margin: 2px 0; color: #f7941d; font-size: 10px;">{{ $invoice->invoice_date->format('m-d-Y') }}</p>
                    @if($invoice->reference)
                    <p style="margin: 2px 0; font-size: 10px;">Ref. : {{ $invoice->reference }}</p>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    {{-- Terms --}}
    <div style="margin-bottom: 10px; font-size: 8px; line-height: 1.3;">
        <h3 style="font-size: 10px; margin: 5px 0;">TERMS:</h3>
        <p style="margin: 2px 0;">1. All goods are supplied KAUKA MEDICAL EQUIPMENT TANZANIA sale basic</p>
        <p style="margin: 2px 0;">2. Account Holder invoice is due strictly 30 days from days date of invoice</p>
        <p style="margin: 2px 0;">3. All overdue Account The company reserves to charge interest at 3% rate of total</p>
        <p style="margin: 2px 0;">4. ALL CASH PAYMENT SHOULD BE MADE DIRECTLY BY CASH OR THROUGH THE FOLLOWING ACCOUNT NAME:</p>
        <p style="margin: 2px 0;">KAUKA MEDICAL EQUIPMENT TANZANIA BANK CRDB , NMB AND VODCOM LIPA NO 50666500</p>
    </div>

    {{-- Items Table --}}
    <table class="border" width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-size: 9px; margin-bottom: 10px;">
        <thead>
            <tr style="background-color: #f7941d; color: white;">
                <th style="border: 1px solid #343232; padding: 6px; text-align: left; font-size: 9px;">Sr no.</th>
                <th style="border: 1px solid #343232; padding: 6px; text-align: left; font-size: 9px;">Product</th>
                <th style="border: 1px solid #343232; padding: 6px; text-align: center; font-size: 9px;">Qty</th>
                <th style="border: 1px solid #343232; padding: 6px; text-align: right; font-size: 9px;">Rate</th>
                <th style="border: 1px solid #343232; padding: 6px; text-align: right; font-size: 9px;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $index => $item)
            <tr>
                <td style="border: 1px solid #343232; padding: 5px; text-align: center; font-size: 9px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #343232; padding: 5px; text-align: left; font-size: 9px;">{{ $item->product }}</td>
                <td style="border: 1px solid #343232; padding: 5px; text-align: center; font-size: 9px;">{{ number_format($item->qty, 2) }}</td>
                <td style="border: 1px solid #343232; padding: 5px; text-align: right; font-size: 9px;">{{ number_format($item->rate, 2) }}</td>
                <td style="border: 1px solid #343232; padding: 5px; text-align: right; font-size: 9px;">{{ number_format($item->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totals Section --}}
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-size: 9px;">
        <tr>
            <!-- Left column - Please Note -->
            <td width="50%" valign="top" style="border-top: 1px solid #f7941d; padding: 8px;">
                <strong style="font-size: 10px;">Please Note</strong>
            </td>
            <!-- Right column - Totals -->
            <td width="50%" valign="top" style="padding: 0;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td style="border-top: 1px solid #f7941d; border-bottom: 1px solid #f7941d; padding: 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 6px 8px; text-align: left; font-size: 9px;"><strong>Total</strong></td>
                                    <td style="padding: 6px 8px; text-align: right; font-size: 9px;"><strong>Sh {{ number_format($invoice->subtotal, 2) }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @if($invoice->shipping_charges > 0)
                    <tr>
                        <td style="border-bottom: 1px solid #f7941d; padding: 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 6px 8px; text-align: left; font-size: 9px;"><strong>(+) Shipping Charges</strong></td>
                                    <td style="padding: 6px 8px; text-align: right; font-size: 9px;"><strong>Sh {{ number_format($invoice->shipping_charges, 2) }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td style="border-bottom: 1px solid #f7941d; background-color: #f7941d; color: white; padding: 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 6px 8px; text-align: left; font-size: 9px;"><strong>Grand Total</strong></td>
                                    <td style="padding: 6px 8px; text-align: right; font-size: 9px;"><strong>Sh {{ number_format($invoice->grand_total, 2) }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 6px 8px; text-align: left; font-size: 9px;"><strong>Balance</strong></td>
                                    <td style="padding: 6px 8px; text-align: right; font-size: 9px;"><strong>Sh {{ number_format($invoice->balance, 2) }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; text-align: right; padding-top: 30px; font-size: 9px;">
                            Kauka medical equipment tanzania
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 8px; text-align: right; font-size: 9px;">
                            Signature
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Payment Details --}}
    <table width="100%" cellpadding="8" cellspacing="0" style="margin-top: 15px; border-collapse: collapse; font-size: 8px;">
        <tr>
            <!-- Column 1: Payable To -->
            <td width="33%" valign="top" style="border: 1px solid #343232; padding: 10px;">
                <strong style="display: block; margin-bottom: 5px; font-size: 9px;">Payable To</strong>
                <p style="margin: 3px 0;">NMB BANK CRDB BANK AND VODACOM LIPA</p>
            </td>
            
            <!-- Column 2: Banking Details -->
            <td width="33%" valign="top" style="border: 1px solid #343232; padding: 10px;">
                <strong style="display: block; margin-bottom: 5px; font-size: 9px;">Banking Details</strong>
                <p style="margin: 3px 0;"><strong>MARKS/PAYMENT INSTRUCTION</strong></p>
                <p style="margin: 3px 0;"><strong>ACCOUNT NAME :</strong>KAUKA MEDICAL EQUIPMENT TANZANIA</p>
                <p style="margin: 3px 0;"><strong>NMB BANK</strong></p>
                <p style="margin: 3px 0;">ACCOUNT NO :25110033313</p>
                <p style="margin: 3px 0;"><strong>CRDB BANK</strong></p>
                <p style="margin: 3px 0;">ACCOUNT NO: 015C000T5WU00</p>
                <p style="margin: 3px 0;">Or</p>
                <p style="margin: 3px 0;">Vodacom lipa no</p>
                <p style="margin: 3px 0;">50666500 kauka supply</p>
            </td>
            
            <!-- Column 3: Other Details -->
            <td width="33%" valign="top" style="border: 1px solid #343232; padding: 10px;">
                <strong style="display: block; margin-bottom: 5px; font-size: 9px;">Other Details</strong>
                <p style="margin: 3px 0;">Dar es salaam</p>
                <p style="margin: 8px 0 3px 0;"><strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('M d, Y') }}</p>
                <p style="margin: 3px 0;"><strong>Due Date:</strong> {{ $invoice->due_date->format('M d, Y') }}</p>
                @if($invoice->status)
                <p style="margin: 3px 0;"><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
                @endif
            </td>
        </tr>
    </table>

    {{-- Footer --}}
    <div style="margin-top: 20px; padding-top: 8px; border-top: 1px solid #000; font-size: 7px; text-align: center; color: #666;">
        <p style="margin: 2px 0;">Thank You For Your Business!</p>
        <p style="margin: 2px 0;">If you have any questions about this invoice, please contact us.</p>
    </div>
</body>
</html>