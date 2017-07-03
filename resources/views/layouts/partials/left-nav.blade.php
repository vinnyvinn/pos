<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <form role="search" class="navbar-form">
        <div class="form-group">
        {{--<input type="text" placeholder="Search" class="form-control">--}}
        {{--<button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>--}}
        </div>
        </form>
        <div class="clearfix"></div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href='{{ url('/') }}'><i class='icon-home-3'></i> <span>Dashboard</span></a>
                </li>
                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='icon-cog-2'></i>
                        <span>Configuration</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='{{ route('tax.index') }}'><span>Tax Types</span></a></li>
                        <li><a href='{{ route('unitOfMeasure.index') }}'><span>Unit of Measures</span></a></li>
                        <li><a href='{{ route('price-list-name.index') }}'><span>Price Lists</span></a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href='javascript:void(0);'>
                        <i class='icon-home-2'></i>
                        <span>Stalls</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='{{ route('stall.index') }}'><i class='icon-home-2'></i> View All</a></li>
                        <li><a href='{{ route('stall.create') }}'><i class='icon-home-2'></i> Create</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="icon-user"></i>
                        <span>Customers</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('customer.index') }}">View All</a></li>
                        <li><a href="{{ route('customer.create') }}">Create</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="icon-users"></i>
                        <span>Suppliers</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('supplier.index') }}">View All</a></li>
                        <li><a href="{{ route('supplier.create') }}">Create</a></li>
                    </ul>

                </li>

                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='icon-bag'></i>
                        <span>Stock Items</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='{{ route('stockItem.create') }}'><span>Add New</span></a></li>
                        <li><a href='{{ route('stockItem.index') }}'><span>View All</span></a></li>
                        <li><a href='{{ route('stockItem.index', ['status' => '1']) }}'><span>View Active</span></a></li>
                        <li><a href='{{ route('stockItem.index', ['status' => '0']) }}'><span>View Inactive</span></a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="icon-anchor"></i>
                        <span>Inventory</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('stock.index') }}">View All</a>
                            <a href="{{ route('stock.create') }}">Receive</a>
                        </li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="icon-anchor"></i>
                        <span>Purchase Order</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('purchaseOrder.index') }}">View All</a>
                            <a href="{{ route('purchaseOrder.create') }}">Create</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="portlets">
            {{--<div id="chat_groups" class="widget transparent nomargin">--}}
                {{--<h2>Chat Groups</h2>--}}
                {{--<div class="widget-content">--}}
                    {{--<ul class="list-unstyled">--}}
                        {{--<li><a href="javascript:;"><i class="fa fa-circle-o text-red-1"></i> Colleagues</a></li>--}}
                        {{--<li><a href="javascript:;"><i class="fa fa-circle-o text-blue-1"></i> Family</a></li>--}}
                        {{--<li><a href="javascript:;"><i class="fa fa-circle-o text-green-1"></i> Friends</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
        <div class="clearfix"></div>
        <br><br><br>
    </div>

</div>