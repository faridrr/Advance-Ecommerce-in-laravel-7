@extends('backend.layouts.master')
@section('title','E-SHOP || DASHBOARD')
@section('main-content')
    <div class="container-fluid">
    @include('backend.layouts.notification')
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Category -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Category</div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Category::countActiveCategory()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::countActiveProduct()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cubes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div
                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countActiveOrder()}}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Posts-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Post</div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Post::countActivePost()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Vente Total / Jours</h6>
                        <div class="form-group">
                            <select name="month" id="month" class="form-control" onchange="window.location.href = '{{ route('admin') }}' + '/' + this.value">
                                <option value="">Month</option>
                                <option @if(isset($month) && $month == 1 ) selected @endif  value="1">Jan</option>
                                <option @if(isset($month) && $month == 2 ) selected @endif  value="2">Feb</option>
                                <option @if(isset($month) && $month == 3 ) selected @endif  value="3">Mar</option>
                                <option @if(isset($month) && $month == 4) selected @endif  value="4">Apr</option>
                                <option @if(isset($month) && $month == 5 ) selected @endif  value="5">May</option>
                                <option @if(isset($month) && $month == 6 ) selected @endif  value="6">Jun</option>
                                <option @if(isset($month) && $month == 7 ) selected @endif  value="7">Jul</option>
                                <option @if(isset($month) && $month == 8 ) selected @endif  value="8">Aug</option>
                                <option @if(isset($month) && $month == 9) selected @endif  value="9">Sep</option>
                                <option @if(isset($month) && $month == 10 ) selected @endif  value="10">Oct</option>
                                <option @if(isset($month) && $month == 11 ) selected @endif  value="11">Nov</option>
                                <option @if(isset($month) && $month == 12 ) selected @endif  value="12">Dec</option>
                            </select>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Vente Total / Mois</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Vente Standard / Jours</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Vente Logo / Jours</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Vente Personalisé / Jours</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart5"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        @endsection

        @push('scripts')
            <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            {{-- pie chart --}}
            <script type="text/javascript">
                var analytics = <?php echo $users; ?>

                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable(analytics);
                    var options = {
                        title: 'Last 7 Days registered user'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                    chart.draw(data, options);
                }
            </script>
            {{-- line chart --}}
            <script type="text/javascript">
                const url = "{{route('product.order.income')}}";
                const url1 = "{{route('product.order.income1')}}";
                const url2 = "{{route('product.order.income2')}}";
                const url3 = "{{route('product.order.income3')}}";

                const urlMonth = "{{route('product.order.incomeMonth', ['month' => $month])}}";
                const urlMonth1 = "{{route('product.order.incomeMonth1', ['month' => $month])}}";
                const urlMonth2 = "{{route('product.order.incomeMonth2', ['month' => $month])}}";
                const urlMonth3 = "{{route('product.order.incomeMonth3', ['month' => $month])}}";

                const urlMonthStandard = "{{route('product.order.incomeMonthStandard', ['month' => $month])}}";
                const urlMonthStandard1 = "{{route('product.order.incomeMonthStandard1', ['month' => $month])}}";
                const urlMonthStandard2 = "{{route('product.order.incomeMonthStandard2', ['month' => $month])}}";
                const urlMonthStandard3 = "{{route('product.order.incomeMonthStandard3', ['month' => $month])}}";


                const urlMonthLogo = "{{route('product.order.incomeMonthLogo', ['month' => $month])}}";
                const urlMonthLogo1 = "{{route('product.order.incomeMonthLogo1', ['month' => $month])}}";
                const urlMonthLogo2 = "{{route('product.order.incomeMonthLogo2', ['month' => $month])}}";
                const urlMonthLogo3 = "{{route('product.order.incomeMonthLogo3', ['month' => $month])}}";


                const urlMonthPersonalized = "{{route('product.order.incomeMonthPersonalized', ['month' => $month])}}";
                const urlMonthPersonalized1 = "{{route('product.order.incomeMonthPersonalized1', ['month' => $month])}}";
                const urlMonthPersonalized2 = "{{route('product.order.incomeMonthPersonalized2', ['month' => $month])}}";
                const urlMonthPersonalized3 = "{{route('product.order.incomeMonthPersonalized3', ['month' => $month])}}";

                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#858796';

                function number_format(number, decimals, dec_point, thousands_sep) {
                    // *     example: number_format(1234.56, 2, ',', ' ');
                    // *     return: '1 234,56'
                    number = (number + '').replace(',', '').replace(' ', '');
                    var n = !isFinite(+number) ? 0 : +number,
                        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                        s = '',
                        toFixedFix = function (n, prec) {
                            var k = Math.pow(10, prec);
                            return '' + Math.round(n * k) / k;
                        };
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                    if (s[0].length > 3) {
                        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                    }
                    if ((s[1] || '').length < prec) {
                        s[1] = s[1] || '';
                        s[1] += new Array(prec - s[1].length + 1).join('0');
                    }
                    return s.join(dec);
                }

                // Area Chart Example
                var ctx = document.getElementById("myAreaChart");
                var ctx2 = document.getElementById("myAreaChart2");
                var ctx3 = document.getElementById("myAreaChart3");
                var ctx4 = document.getElementById("myAreaChart4");
                var ctx5 = document.getElementById("myAreaChart5");

                axios.get(url)
                    .then(async function ( response) {
                        const data_keys = Object.keys(response.data);
                        const data_values = Object.values(response.data);
                        const resp1 = await axios.get(url1).then(response => response.data)
                        const data_values1 = Object.values(resp1);
                        const resp2 = await axios.get(url2).then(response => response.data)
                        const data_values2 = Object.values(resp2);
                        const resp3 = await axios.get(url3).then(response => response.data)
                        const data_values3 = Object.values(resp3);

                        var myLineChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Commandes",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values,// [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                                },
                                {
                                    label: "Livré",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,0,81)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,0,81)",
                                    pointBorderColor: "rgb(223,0,81)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,0,81)",
                                    pointHoverBorderColor: "rgb(223,0,81)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values1,
                                },
                                {
                                    label: "Annulé/Retour",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(11,223,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(11,223,0)",
                                    pointBorderColor: "rgb(11,223,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(11,223,0)",
                                    pointHoverBorderColor: "rgb(11,223,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values2,
                                },
                                {
                                    label: "Terminer",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,160,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,160,0)",
                                    pointBorderColor: "rgb(223,160,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,160,0)",
                                    pointHoverBorderColor: "rgb(223,160,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values3,
                                }
                                ],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        time: {
                                            unit: 'date'
                                        },
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            maxTicksLimit: 5,
                                            padding: 10,
                                            // Include a dollar sign in the ticks
                                            callback: function (value, index, values) {
                                                return number_format(value);
                                            }
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2]
                                        }
                                    }],
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function (tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(function (error) {
                        //   vm.answer = 'Error! Could not reach the API. ' + error
                        console.log(error)
                    });

                axios.get(urlMonth)
                    .then(async function ( response) {

                        let data_keys = await Object.keys(response.data);
                        const data_values = Object.values(response.data);
                        const resp1 = await axios.get(urlMonth1).then(response => response.data)
                        const data_values1 = Object.values(resp1);
                        const resp2 = await axios.get(urlMonth2).then(response => response.data)
                        const data_values2 = Object.values(resp2);
                        const resp3 = await axios.get(urlMonth3).then(response => response.data)
                        const data_values3 = Object.values(resp3);

                        var myLineChart = new Chart(ctx2, {
                            type: 'line',
                            data: {
                                labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Commandes",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values,// [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                                },
                                {
                                    label: "Livré",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,0,81)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,0,81)",
                                    pointBorderColor: "rgb(223,0,81)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,0,81)",
                                    pointHoverBorderColor: "rgb(223,0,81)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values1,
                                },
                                {
                                    label: "Annulé/Retour",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(11,223,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(11,223,0)",
                                    pointBorderColor: "rgb(11,223,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(11,223,0)",
                                    pointHoverBorderColor: "rgb(11,223,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values2,
                                },
                                {
                                    label: "Terminer",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,160,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,160,0)",
                                    pointBorderColor: "rgb(223,160,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,160,0)",
                                    pointHoverBorderColor: "rgb(223,160,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_values3,
                                }
                                ],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function (tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(function (error) {
                        //   vm.answer = 'Error! Could not reach the API. ' + error
                        console.log(error)
                    });

                /*
                  Standard
                 */
                axios.get(urlMonthStandard)
                    .then(async function ( response) {

                        let data_keys = await Object.keys(response.data);
                        const data_valuesStandard = Object.values(response.data);
                        const respStandard1 = await axios.get(urlMonthStandard1).then(response => response.data)
                        const data_valuesStandard1 = Object.values(respStandard1);
                        const respStandard2 = await axios.get(urlMonthStandard2).then(response => response.data)
                        const data_valuesStandard2 = Object.values(respStandard2);
                        const respStandard3 = await axios.get(urlMonthStandard3).then(response => response.data)
                        const data_valuesStandard3 = Object.values(respStandard3);

                        var myAreaChart3 = new Chart(ctx3, {
                            type: 'line',
                            data: {
                                labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Commandes",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesStandard,// [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                                },
                                {
                                    label: "Livré",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,0,81)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,0,81)",
                                    pointBorderColor: "rgb(223,0,81)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,0,81)",
                                    pointHoverBorderColor: "rgb(223,0,81)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesStandard1,
                                },
                                {
                                    label: "Annulé/Retour",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(11,223,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(11,223,0)",
                                    pointBorderColor: "rgb(11,223,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(11,223,0)",
                                    pointHoverBorderColor: "rgb(11,223,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesStandard2,
                                },
                                {
                                    label: "Terminer",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,160,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,160,0)",
                                    pointBorderColor: "rgb(223,160,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,160,0)",
                                    pointHoverBorderColor: "rgb(223,160,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesStandard3,
                                }
                                ],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function (tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(function (error) {
                        //   vm.answer = 'Error! Could not reach the API. ' + error
                        console.log(error)
                    });
                /*
                  Logo
                 */
                axios.get(urlMonthLogo)
                    .then(async function ( response) {

                        let data_keys = await Object.keys(response.data);
                        const data_valuesLogo = Object.values(response.data);
                        const respLogo1 = await axios.get(urlMonthLogo1).then(response => response.data)
                        const data_valuesLogo1 = Object.values(respLogo1);
                        const respLogo2 = await axios.get(urlMonthLogo2).then(response => response.data)
                        const data_valuesLogo2 = Object.values(respLogo2);
                        const respLogo3 = await axios.get(urlMonthLogo3).then(response => response.data)
                        const data_valuesLogo3 = Object.values(respLogo3);

                        var myAreaChart4 = new Chart(ctx4, {
                            type: 'line',
                            data: {
                                labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Commandes",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesLogo,// [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                                },
                                {
                                    label: "Livré",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,0,81)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,0,81)",
                                    pointBorderColor: "rgb(223,0,81)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,0,81)",
                                    pointHoverBorderColor: "rgb(223,0,81)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesLogo1,
                                },
                                {
                                    label: "Annulé/Retour",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(11,223,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(11,223,0)",
                                    pointBorderColor: "rgb(11,223,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(11,223,0)",
                                    pointHoverBorderColor: "rgb(11,223,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesLogo2,
                                },
                                {
                                    label: "Terminer",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,160,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,160,0)",
                                    pointBorderColor: "rgb(223,160,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,160,0)",
                                    pointHoverBorderColor: "rgb(223,160,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesLogo3,
                                }
                                ],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function (tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(function (error) {
                        //   vm.answer = 'Error! Could not reach the API. ' + error
                        console.log(error)
                    });
                /*
                  Personalized
                 */
                axios.get(urlMonthPersonalized)
                    .then(async function ( response) {

                        let data_keys = await Object.keys(response.data);
                        const data_valuesPersonalized = Object.values(response.data);
                        const respPersonalized1 = await axios.get(urlMonthPersonalized1).then(response => response.data)
                        const data_valuesPersonalized1 = Object.values(respPersonalized1);
                        const respPersonalized2 = await axios.get(urlMonthPersonalized2).then(response => response.data)
                        const data_valuesPersonalized2 = Object.values(respPersonalized2);
                        const respPersonalized3 = await axios.get(urlMonthPersonalized3).then(response => response.data)
                        const data_valuesPersonalized3 = Object.values(respPersonalized3);

                        var myAreaChart5 = new Chart(ctx5, {
                            type: 'line',
                            data: {
                                labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Commandes",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesPersonalized,// [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                                },
                                {
                                    label: "Livré",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,0,81)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,0,81)",
                                    pointBorderColor: "rgb(223,0,81)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,0,81)",
                                    pointHoverBorderColor: "rgb(223,0,81)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesPersonalized1,
                                },
                                {
                                    label: "Annulé/Retour",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(11,223,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(11,223,0)",
                                    pointBorderColor: "rgb(11,223,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(11,223,0)",
                                    pointHoverBorderColor: "rgb(11,223,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesPersonalized2,
                                },
                                {
                                    label: "Terminer",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgb(223,160,0)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgb(223,160,0)",
                                    pointBorderColor: "rgb(223,160,0)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgb(223,160,0)",
                                    pointHoverBorderColor: "rgb(223,160,0)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: data_valuesPersonalized3,
                                }
                                ],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function (tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(function (error) {
                        //   vm.answer = 'Error! Could not reach the API. ' + error
                        console.log(error)
                    });

            </script>
    @endpush
