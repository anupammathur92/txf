    <div class="dashboard-menu niceScroll">
        <div class="nav-menu">
            <div class="user-info">
                <!-- <div class="user-icon"><img src="{{ asset('images/avatar-1.jpg') }}" alt="img"></div> -->
                <div class="user-name">
                    <h5>{{ auth()->user()->full_name }}</h5>
                    <span class="h6 text-muted">Administrator</span>
                </div>
            </div>
            <ul class="list-unstyled nav">
                <li class="nav-item"><span class="menu-title text-muted">NAVIGATION</span></li>
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fal fa-home-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fal fa-file-alt"></i> User Management </a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.list_user') }}" class="nav-link">List</a></li>
                        <li class="nav-item"><a href="{{ route('admin.create_user') }}" class="nav-link">Add</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fal fa-book"></i>Category</a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.list_category') }}" class="nav-link">List</a></li>
                        <li class="nav-item"><a href="{{ route('admin.create_category') }}" class="nav-link">Add</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fal fa-book"></i>Ticket Category</a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.list_ticket_category') }}" class="nav-link">List</a></li>
                        <li class="nav-item"><a href="{{ route('admin.create_ticket_category') }}" class="nav-link">Add</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fal fa-location-arrow"></i>Venue</a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.list_venue') }}" class="nav-link">List</a></li>
                        <li class="nav-item"><a href="{{ route('admin.create_venue') }}" class="nav-link">Add</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fal fa-user-circle"></i>Artist</a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.list_artist') }}" class="nav-link">List</a></li>
                        <li class="nav-item"><a href="{{ route('admin.create_artist') }}" class="nav-link">Add</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fal fa-street-view"></i>Events</a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.complete_event') }}" class="nav-link">Complete Event</a></li>
                        <li class="nav-item"><a href="{{ route('admin.inprocess_event') }}" class="nav-link">Inprocess Event </a></li>
                        <li class="nav-item"><a href="{{ route('admin.upcoming_event') }}" class="nav-link">upcoming Event</a></li>
                        <li class="nav-item"><a href="{{ route('admin.create_event') }}" class="nav-link">Add</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('admin.list_payment') }}" class="nav-link"><i class="fal fa-credit-card"></i>Payments</a></li>
                <li class="nav-item"><a href="{{ route('admin.list_contact_us') }}" class="nav-link"><i class="fal fa-phone-square"></i>Contact Us</a></li>
                <li class="nav-item"><a href="{{ route('admin.list_enquiry') }}" class="nav-link"><i class="fal fa-phone"></i>Enquiries</a></li>
                <li class="nav-item"><a href="{{ route('admin.subscribe_list') }}" class="nav-link"><i class="fal fa-user-circle"></i>Subscription List</a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="fal fa-file"></i>Reports</a>
                    <ul class="sub-menu">
                        <li class="nav-item"><a href="{{ route('admin.show_export_user') }}" class="nav-link">Users</a></li>
                        <li class="nav-item"><a href="{{ route('admin.show_export_bookings') }}" class="nav-link">Booking</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('admin.list_content') }}" class="nav-link"><i class="fal fa-comment"></i>Content Manager</a></li>
                <li class="nav-item"><a href="{{ route('admin.financial_summary') }}" class="nav-link"><i class="fal fa-list"></i>Financial Summary</a></li>
            </ul>
        </div>
    </div>