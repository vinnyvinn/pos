<div class="left side-menu hidden-print"  id="left-menu">
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
                        <span>Products</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='{{ route('stockItem.create') }}'><span>Add New</span></a></li>
                        <li><a href='{{ route('stockItem.index') }}'><span>View All</span></a></li>
                        <li><a href='{{ route('stockItem.index', ['status' => 'active']) }}'><span>View Active</span></a></li>
                        <li><a href='{{ route('stockItem.index', ['status' => 'inactive']) }}'><span>View Inactive</span></a></li>
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
                            <a href="{{ route('purchaseOrder.index', ['t' => 'unprocessed']) }}">Unprocessed</a>
                            <a href="{{ route('purchaseOrder.index', ['t' => 'partial']) }}">Partially Processed</a>
                            <a href="{{ route('purchaseOrder.index', ['t' => 'archived']) }}">Archived</a>
                            <a href="{{ route('purchaseOrder.index', ['t' => 'received']) }}">Goods Received</a>
                        </li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="icon-users-1"></i>
                        <span>Users</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
{{--                        {{ dd(Auth::user()->userGroup()->permissions['users_full_access']) }}--}}
                        @if(hasPermission(SmoDav\Models\UserGroup::PERM_USER_FULL_ACCESS))
                            <li>
                                {{--<a href="{{ route('users.index') }}">View All</a>--}}
                                <a href="{{ route('users.index') }}">Users</a>
                            </li>
                        @endif
                        @if(SmoDav\Models\UserGroup::PERM_ROLES_FULL_ACCESS)
                                <a href="{{ route('user-group.index') }}">User Groups</a>
                            @endif
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="fa fa-dollar"></i>
                        <span>Sale</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        @if(hasPermission(SmoDav\Models\UserGroup::PERM_TRANSACTION_APPROVE))
                            <li>
                                <a href="{{route('sale.index')}}">View All</a>
                            </li>
                            @endif
                        @if(hasPermission(SmoDav\Models\UserGroup::PERM_TRANSACTION_VIEW))
                            <li>
                                <a href="{{ route('sale.create') }}">Make Sale</a>
                            </li>
                            @endif
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);">
                        <i class="fa fa-dollar"></i>
                        <span>Reports</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('daily.index')}}">Daily Report</a>
                        </li>
                        <li>
                            <a href="{{ route('weekly.index') }}">Weekly Report</a>
                        </li>
                        <li>
                            <a href="{{ route('monthly.index') }}">Monthly Report</a>
                        </li>
                        <li>
                            <a href="{{ route('custom.index') }}">Custom Report</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);"><i class="fa fa-dollar"></i>
                        Petty Cash

                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        @if(SmoDav\Models\UserGroup::PERM_PETTY_CASH_FULL_ACCESS)
                        <li>
                    <li>
                            <a href="{{ route('pettyCashType.index') }}">Petty Cash Types</a>
                        </li>
                        <li>
                            <a href="{{ route('pettyCash.index') }}">Petty Cash</a>

                        </li>
                        @endif
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
