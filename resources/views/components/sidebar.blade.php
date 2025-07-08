<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex flex-column align-items-center justify-content-center mt-4">
            <a href="./index.html" class="text-nowrap logo-img mb-2">
                <img src="../assets/images/logos/logo.png" alt="Logo" style="width: 90px; height: auto;" />
            </a>
            <span class="fw-semibold fs-5">Police App</span>
        </div>


        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="ti ti-atom"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('vahicles') }}" aria-expanded="false">
                        <i class="ti ti-car"></i>
                        <span class="hide-menu">Vahicles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('officers') }}" aria-expanded="false">
                        <i class="ti ti-user"></i>
                        <span class="hide-menu">Officers</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('locations')}}" aria-expanded="false">
                        <i class="ti ti-map-pin"></i>
                        <span class="hide-menu">Locations</span>
                    </a>
                </li>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
