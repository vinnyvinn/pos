<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <form role="search" class="navbar-form">
        <div class="form-group">
        {{--<input type="text" placeholder="Search" class="form-control">--}}
        {{--<button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>--}}
        </div>
        </form>
        <div class="clearfix"></div>
        <div class="profile-info">
            <div class="col-xs-4">
                <a href="profile.html" class="rounded-image profile-image"><img src="images/users/user-100.jpg"></a>
            </div>
            <div class="col-xs-8">
                <div class="profile-text">Welcome <b></b></div>
                <div class="profile-buttons">
                    <a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>
                    <a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>
                    <a href="javascript:;" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
                </div>
            </div>
        </div>
        <!--- Divider -->
        <div class="clearfix"></div>
        <hr class="divider"/>
        <div class="clearfix"></div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li><a href='{{ url('/') }}'><i class='icon-home-3'></i> Dashboard</a></li>
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