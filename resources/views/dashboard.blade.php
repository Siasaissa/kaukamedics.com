@include('layouts.adminhead')

<body class="g-sidenav-show  bg-gray-100">
    
  @include('layouts.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
          <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
          <p class="mb-4">
            Review real sales performance and recent orders from your store.
          </p>
        </div>
        <div class="col-xl-4 col-sm-7 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                  <h4 class="mb-0">Tsh {{ number_format($totalRevenue ?? 0, 0) }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">

            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-7 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Total Orders</p>
                  <h4 class="mb-0">{{ $totalOrders ?? 0 }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">person</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-7 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Total Products</p>
                  <h4 class="mb-0">{{ $totalProducts ?? 0 }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">leaderboard</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
            </div>
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 mt-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-0 ">Monthly Sales Overview</h6>
              <p class="text-sm ">Real sales totals for the last 6 months</p>
              <div class="pe-2">
                <div class="chart">
                  <canvas id="salesChart" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> Updated in real-time </p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Recent Orders</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">{{ $recentOrders->count() ?? 0 }} recent orders</span> from latest activity
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">View All</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Export</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Filter</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order Details</th>
                     
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentOrders ?? [] as $order)
                    @foreach($order->items as $item)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <div class="icon icon-sm icon-shape bg-gradient-info shadow text-center border-radius-md">
                              <i class="material-symbols-rounded opacity-10 text-white">receipt</i>
                            </div>
                          </div>
                          <div class="d-flex flex-column justify-content-center ms-3">
                            <h6 class="mb-0 text-sm">{{ $item['name'] }}</h6>
                            <p class="text-xs text-secondary mb-0">
                              {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                            </p>
                          </div>
                        </div>
                      </td>
                
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{ $item['quantity'] }} </span>
                      </td>
                    </tr>
                    @endforeach
                    @empty
                    <tr>
                      <td colspan="4" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                          <div class="icon icon-lg icon-shape bg-gradient-secondary shadow text-center border-radius-lg mb-2">
                            <i class="material-symbols-rounded opacity-10 text-white">inventory_2</i>
                          </div>
                          <h6 class="mb-0 text-sm">No Recent Orders</h6>
                          <p class="text-xs text-secondary mb-0">When orders are placed, they'll appear here</p>
                        </div>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- order track 
        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Orders overview</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">24%</span> this month
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
               
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-symbols-rounded text-warning text-gradient">pending</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $pendingOrders ?? 0 }} Pending Orders</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $pendingOrdersPercentage ?? 0 }}% of total</p>
                  </div>
                </div>
                
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-symbols-rounded text-success text-gradient">check_circle</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $completedOrders ?? 0 }} Completed Orders</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $completedOrdersPercentage ?? 0 }}% of total</p>
                  </div>
                </div>
               
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-symbols-rounded text-info text-gradient">trending_up</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Average Order Value</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Tsh {{ number_format($averageOrderValue ?? 0, 0) }}</p>
                  </div>
                </div>
             
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-symbols-rounded text-primary text-gradient">group</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $totalCustomers ?? 0 }} Total Customers</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Registered users</p>
                  </div>
                </div>
              
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="material-symbols-rounded text-success text-gradient">paid</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Monthly Revenue</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Tsh {{ number_format($totalRevenue ?? 0, 0) }}</p>
                  </div>
                </div>
              
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="material-symbols-rounded text-warning text-gradient">inventory</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $totalProducts ?? 0 }} Products</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Available in stock</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         -->
      </div>
      @include('layouts.adminfooter')
    </div>
  </main>
  
  <!--   Core JS Files   -->
<script src="{{ url ('assets/js/core/popper.min.js') }}"></script>
<script src="{{ url ('assets/js/core/bootstrap.min.js') }}"></script>

<script src="{{ url ('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ url ('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ url ('assets/js/plugins/chartjs.min.js') }}"></script>


  <script>
    var ctx = document.getElementById("salesChart").getContext("2d");

    // Get sales data from PHP
    var salesMonths = @json($salesMonths ?? []);
    var salesValues = @json($salesValues ?? []);
    var maxSalesValue = salesValues.length ? Math.max(...salesValues) : 0;

    new Chart(ctx, {
      type: "line",
      data: {
        labels: salesMonths,
        datasets: [{
          label: "Sales (Tsh)",
          tension: 0.4,
          borderColor: "#43A047",
          backgroundColor: "rgba(67,160,71,0.2)",
          fill: true,
          pointRadius: 5,
          data: salesValues,
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return 'Tsh ' + context.parsed.y.toLocaleString();
              }
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: '#e5e5e5'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: maxSalesValue > 0 ? maxSalesValue * 1.2 : 1000,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
              color: "#737373",
              callback: function(value) {
                return 'Tsh ' + value.toLocaleString();
              }
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>
