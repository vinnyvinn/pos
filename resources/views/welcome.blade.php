@extends('layouts.app')

@section('header')
    <link href="assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">
        <!-- Start info box -->
        <div class="row top-summary">
            <div class="col-lg-3 col-md-6">
                <div class="widget green-1 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">TOTAL <b>CUSTOMERS</b></p>
                            <h2><span>{{number_format($customers)}}</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="widget-footer">
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="widget darkblue-2 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="icon-bag"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">TOTAL <b>SALES THIS WEEK</b></p>
                            <h2>KSH <span class="animate-number" data-value="{{ number_format($sales) }}" data-duration="3000">0</span></h2>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="widget-footer">
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<i class="fa fa-caret-down rel-change"></i> <b>11%</b> decrease in sales--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="widget orange-4 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">OVERALL <b>INCOME</b></p>
                            <h2>KSH <span class="animate-number" data-value="{{ number_format($sales) - $expenses }}" data-duration="3000">0</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="widget-footer">
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<i class="fa fa-caret-down rel-change"></i> <b>7%</b> decrease in income--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="widget lightblue-1 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">TOTAL <b>LOGINS THIS WEEK</b></p>
                            <h2><span>{{number_format($days)}}</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="widget-footer">
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<i class="fa fa-caret-up rel-change"></i> <b>6%</b> increase in users--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of info box -->

        <div class="row">
            <div class="col-lg-12 portlets">
                <div id="website-statistics1" class="widget">
                    <div class="widget-header transparent">
                        <h2><i class="icon-chart-line"></i> <strong>Website</strong> Statistics</h2>
                        <div class="additional-btn">
                            <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                            <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                            <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                            <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                            <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div id="website-statistic" class="statistic-chart">
                            <div class="row stacked">
                                <div class="col-sm-12">
                                    <div class="toolbar">
                                        <div class="pull-left">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-default btn-xs">Daily</a>
                                                <a href="#" class="btn btn-default btn-xs active">Monthly</a>
                                                <a href="#" class="btn btn-default btn-xs">Yearly</a>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <a class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                    Export <i class="icon-down-open-2"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li><a href="#">Export as PDF</a></li>
                                                    <li><a href="#">Export as CSV</a></li>
                                                    <li><a href="#">Export as PNG</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a></li>
                                                </ul>
                                            </div>
                                            <a href="#" class="btn btn-primary btn-xs"><i class="icon-cog-2"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="morris-home" class="morris-chart" style="height: 270px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            {{--<div class="col-lg-4 portlets">--}}
                {{--<div class="widget darkblue-3">--}}
                    {{--<div class="widget-header transparent">--}}
                        {{--<h2><strong>Server</strong> Status</h2>--}}
                        {{--<div class="additional-btn">--}}
                            {{--<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>--}}
                            {{--<a class="hidden" id="dropdownMenu1" data-toggle="dropdown">--}}
                                {{--<i class="fa fa-cogs"></i>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">--}}
                                {{--<li><a href="#">Action</a></li>--}}
                                {{--<li><a href="#">Another action</a></li>--}}
                                {{--<li><a href="#">Something else here</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="#">Separated link</a></li>--}}
                            {{--</ul>--}}
                            {{--<a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>--}}
                            {{--<a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>--}}
                            {{--<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>--}}
                            {{--<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="widget-content">--}}
                        {{--<div id="website-statistic2" class="statistic-chart">--}}

                            {{--<div class="col-sm-12 stacked">--}}
                                {{--<h4><i class="fa fa-circle-o text-green-1"></i> Server Loads</h4>--}}
                                {{--<div class="col-sm-8 status-data">--}}

                                    {{--<div class="col-xs-12">--}}
                                        {{--<div class="row stacked">--}}
                                            {{--<div class="col-xs-4 text-center right-border">--}}
                                                {{--Processes<br>--}}
                                                {{--<span class="animate-number" data-value="322" data-duration="3000">0</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-4 text-center right-border">--}}
                                                {{--Connections<br>--}}
                                                {{--<span class="animate-number" data-value="4789" data-duration="3000">0</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-4 text-center">--}}
                                                {{--Avg. Load<br>--}}
                                                {{--<span class="animate-number" data-value="76" data-duration="3000">0</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}
                                    {{--<div class="progress progress-xs">--}}
                                        {{--<div style="width: 72%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="72" role="progressbar" class="progress-bar bg-orange-2" title="Average Load: 76%" data-placement="right" data-toggle="tooltip">--}}
                                            {{--<span class="sr-only">72% Complete (success)</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-4 text-center">--}}
                                    {{--<div class="ws-load echart" data-percent="50"><span class="percent"></span></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"></div>--}}
                            {{--<div id="home-chart-2"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        </div>

        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="widget">
                    <div class="widget-header">
                        <h2><i class="icon-chart-pie-1"></i> <strong>Sales</strong> Report</h2>
                        <div class="additional-btn">
                            <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                            <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                            <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                            <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                            <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row stacked">
                            <div class="col-sm-5 mini-stats">
                                <div id="morris-bar-home" class="morris-chart" style="height: 170px;"></div>
                                <div class="sales-report-data">
                                    <span class="pull-left">Completed Sales</span><span class="pull-right">65 / 174</span>
                                    <div class="progress progress-xs">
                                        <div style="width: 38%;" class="progress-bar bg-blue-1"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <span class="pull-left">Return(s) Processed</span><span class="pull-right">22 / 25</span>
                                    <div class="progress progress-xs">
                                        <div style="width: 88%;" class="progress-bar bg-lightblue-1"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <span class="pull-left">Shipped Products</span><span class="pull-right">418 / 624</span>
                                    <div class="progress progress-xs">
                                        <div style="width: 58%;" class="progress-bar"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <span class="pull-left">Overall Product Stock</span><span class="pull-right">19%</span>
                                    <div class="progress progress-xs">
                                        <div style="width: 19%;" class="progress-bar bg-pink-1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div id="vector-map" style="height:370px"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="sales-report" class="collapse in hidden-xs">
                            <div class="table-responsive">
                                <table data-sortable class="table table-striped">
                                    <thead>
                                    <tr><th width="70">No</th><th data-sortable="false" width="40"><input type="checkbox" id="select-all-rows"></th><th width="120">Order ID</th><th>Buyer</th><th width="100">Status</th><th width="150">Location</th><th width="120">Total</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr><td>1</td><td><input type="checkbox" class="rows-check"></td><td>#0021</td><td><a href="#">John Doe</a></td><td><span class="label label-primary">Order</span></td><td>Yogyakarta, ID</td><td><strong class="text-primary">&#36; 1,245</strong></td></tr>
                                    <tr><td>2</td><td><input type="checkbox" class="rows-check"></td><td>#0022</td><td><a href="#">Johnny Depp</a></td><td><span class="label label-success">Payment</span></td><td>London, UK</td><td><strong class="text-success">&#36; 1,245</strong></td></tr>
                                    <tr><td>3</td><td><input type="checkbox" class="rows-check"></td><td>#0023</td><td><a href="#">Scarlett Johansson</a></td><td><span class="label label-success">Payment</span></td><td>Canbera, AU</td><td><strong class="text-success">&#36; 1,245</strong></td></tr>
                                    <tr><td>4</td><td><input type="checkbox" class="rows-check"></td><td>#0024</td><td><a href="#">Hanna Barbara</a></td><td><span class="label label-danger">Cancel</span></td><td>Bali, ID</td><td><strong class="text-danger">&#36; 1,245</strong></td></tr>
                                    <tr><td>5</td><td><input type="checkbox" class="rows-check"></td><td>#0025</td><td><a href="#">Ali Larter</a></td><td><span class="label label-primary">Order</span></td><td>Bandung, ID</td><td><strong class="text-primary">&#36; 1,245</strong></td></tr>
                                    <tr><td>6</td><td><input type="checkbox" class="rows-check"></td><td>#0026</td><td><a href="#">Willy Wonka</a></td><td><span class="label label-danger">Cancel</span></td><td>Semarang, ID</td><td><strong class="text-danger">&#36; 1,245</strong></td></tr>
                                    <tr><td>7</td><td><input type="checkbox" class="rows-check"></td><td>#0027</td><td><a href="#">Chris Isaac</a></td><td><span class="label label-warning">Waiting</span></td><td>New York, US</td><td><strong class="text-warning">&#36; 1,245</strong></td></tr>
                                    <tr><td>8</td><td><input type="checkbox" class="rows-check"></td><td>#0028</td><td><a href="#">Jenny Doe</a></td><td><span class="label label-primary">Order</span></td><td>Boston, US</td><td><strong class="text-primary">&#36; 1,245</strong></td></tr>
                                    <tr><td>9</td><td><input type="checkbox" class="rows-check"></td><td>#0029</td><td><a href="#">Ban ki moon</a></td><td><span class="label label-danger">Cancel</span></td><td>Boston, US</td><td><strong class="text-danger">&#36; 1,245</strong></td></tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-6 portlets">

            </div>
            <div class="col-lg-4 col-md-6 portlets">
                <div id="stock-app" class="widget green-3">
                    <div class="widget-header transparent">
                        <h2><strong>Stock</strong> Markets</h2>
                        <div class="additional-btn">
                            <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                            <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                            <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                            <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                            <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div id="website-statistic3" class="statistic-chart">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h2>NASDAQ</h2>
                                </div>
                                <div class="col-xs-6">
                                    <label id="nasdaq-status" class="stock-status"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h2>DOW JONES</h2>
                                </div>
                                <div class="col-xs-6">
                                    <label id="dow-status" class="stock-status"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h2>S&P</h2>
                                </div>
                                <div class="col-xs-6">

                                    <label id="sp-status" class="stock-status"></label>
                                </div>
                            </div>
                        </div>
                        <div id="home-chart-3"></div>
                    </div>

                    <div class="widget-footer">
                    </div>
                 </div>
           </div>
            {{--<b>Most Selling Product:</b> {{$max}}<br>--}}
            {{--<b>Least Selling Product:</b> {{$min}}<br>--}}
        </div>

        <!-- Footer Start -->
        <footer style="position:relative; width:100%; bottom: 0">
            Tikone Solutions Limited &copy; {{ Carbon\Carbon::now()->format('Y') }}
            <div class="footer-links pull-right">
                <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
            </div>
        </footer>
        <!-- Footer End -->
    </div>
@endsection

@section('footer')

    <script src="assets/libs/d3/d3.v3.js"></script>
    <script src="assets/libs/rickshaw/rickshaw.min.js"></script>
    <script src="assets/libs/raphael/raphael-min.js"></script>
    <script src="assets/libs/morrischart/morris.min.js"></script>
    <script src="assets/libs/jquery-knob/jquery.knob.js"></script>
    <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js"></script>
    <script src="assets/libs/jquery-clock/clock.js"></script>
    <script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js"></script>
    <script src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js"></script>
    <script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js"></script>
    <script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js"></script>

    <script src="assets/js/apps/calculator.js"></script>
    <script src="assets/js/apps/todo.js"></script>
    <script src="assets/js/apps/notes.js"></script>
    <script src="assets/js/pages/index.js"></script>
@endsection