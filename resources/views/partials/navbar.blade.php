<div id="sidebar" class="app-sidebar">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        @if (auth::user()->role === "SUPER-ADMIN") 
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ Request::is('home')? "active":"" }}">
                <a href="/home" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-header">Data</div>
            <div class="menu-item {{ Request::is('employee/employees')? "active":"" }}">
                <a href="/employee/employees" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-people-fill text-theme"></i></span>
                    <span class="menu-text">Employee</span>
                </a>
            </div>

            <div class="menu-header">Assets</div>
            <div class="menu-item {{ Request::is('asset')? "active":"" }} {{ Request::is('asset/history')? "active":"" }}">
                <a href="/asset" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-inboxes-fill text-theme"></i></span>
                    <span class="menu-text">Asset</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('fuel')? "active":"" }} {{ Request::is('fuel/history')? "active":"" }} {{ Request::is('fuel-delivery')? "active":"" }} {{ Request::is('fuel-refill')? "active":"" }}">
                <a href="/fuel" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-droplet-fill text-theme"></i></span>
                    <span class="menu-text">Fuel</span>
                </a>
            </div>

            <div class="menu-header">Components</div>
            {{-- <div class="menu-item {{ Request::is('land/lands')? "active":"" }}">
                <a href="/land/lands" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-signpost-2-fill text-theme"></i></span>
                    <span class="menu-text">Land Owner</span>
                </a>
            </div> --}}
            <div class="menu-item {{ Request::is('vendor/vendors')? "active":"" }}">
                <a href="/vendor/vendors" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-signpost-2-fill text-theme"></i></span>
                    <span class="menu-text">Vendor</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('location/locations')? "active":"" }}">
                <a href="/location/locations" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-pin-map-fill text-theme"></i></span>
                    <span class="menu-text">Location</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('vehicle/vehicles')? "active":"" }} {{ Request::is('vehicle/history')? "active":"" }}">
                <a href="/vehicle/vehicles" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-truck text-theme"></i></span>
                    <span class="menu-text">Vehicle</span>
                </a>
            </div>

            <div class="menu-header">Operations</div>
            <div class="menu-item {{ Request::is('daily/dailys')? "active":"" }}">
                <a href="/daily/dailys" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-calendar4 text-theme"></i></span>
                    <span class="menu-text">Daily Activity</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('prepparation/prepparations')? "active":"" }}">
                <a href="/preparation/preparations" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear-wide-connected text-theme"></i></span>
                    <span class="menu-text">Preparation</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('hourmeter/hourmeters')? "active":"" }}">
                <a href="/hourmeter/hourmeters" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-clock-history text-theme"></i></span>
                    <span class="menu-text">Hour Meter</span>
                </a>
            </div>

            <div class="menu-item {{ Request::is('stockore/stockores')? "active":"" }}">
                <a href="/stockore/stockores" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-pie-chart-fill text-theme"></i></span>
                    <span class="menu-text">Stock Ore</span>
                </a>
            </div>

            <div class="menu-item {{ Request::is('production/productions')? "active":"" }}">
                <a href="/production/productions" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-shekel-sign text-theme"></i></span>
                    <span class="menu-text">Production</span>
                </a>
            </div>

            <div class="menu-item {{ Request::is('hauling/haulings')? "active":"" }} {{ Request::is('hauling/ritase')? "active":"" }}">
                <a href="/hauling/haulings" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-truck text-theme"></i></span>
                    <span class="menu-text">Hauling</span>
                </a>
            </div>

            <div class="menu-item {{ Request::is('barging/bargings')? "active":"" }} {{ Request::is('barging/ritase')? "active":"" }}">
                <a href="/barging/bargings" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-ship text-theme"></i></span>
                    <span class="menu-text">Barging</span>
                </a>
            </div>
            <div class="menu-divider"></div>
            <div class="menu-header">Settings</div>
            <div class="menu-item {{ Request::is('setting/setting')? "active":"" }}">
                <a href="/setting/setting" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
        </div>
        @elseif (auth::user()->role === "STAFF-ASSET") 
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ Request::is('home')? "active":"" }}">
                <a href="/home" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-header">Data</div>
            <div class="menu-item {{ Request::is('employee/employees')? "active":"" }}">
                <a href="/employee/employees" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-people-fill text-theme"></i></span>
                    <span class="menu-text">Employee</span>
                </a>
            </div>

            <div class="menu-header">Assets</div>
            <div class="menu-item {{ Request::is('asset')? "active":"" }} {{ Request::is('asset/history')? "active":"" }}">
                <a href="/asset" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-inboxes-fill text-theme"></i></span>
                    <span class="menu-text">Asset</span>
                </a>
            </div>
            <div class="menu-item {{ Request::is('fuel')? "active":"" }} {{ Request::is('fuel/history')? "active":"" }} {{ Request::is('fuel-delivery')? "active":"" }} {{ Request::is('fuel-refill')? "active":"" }}">
                <a href="/fuel" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-droplet-fill text-theme"></i></span>
                    <span class="menu-text">Fuel</span>
                </a>
            </div>

            <div class="menu-divider"></div>
            <div class="menu-header">Settings</div>
            <div class="menu-item {{ Request::is('setting/setting')? "active":"" }}">
                <a href="/setting/setting" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
        </div>
        @elseif (auth::user()->role === "INVESTOR") 
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ Request::is('home')? "active":"" }}">
                <a href="/home" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu text-theme"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>
            <div class="menu-divider"></div>
            <div class="menu-header">Settings</div>
            <div class="menu-item {{ Request::is('setting/setting')? "active":"" }}">
                <a href="/setting/setting" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear text-theme"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>