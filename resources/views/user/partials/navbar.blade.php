<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
      <ul class="menu-inner">
        <!-- Dashboards -->


        @isUser

        <li class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

            <a href="{{ route('user.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div data-i18n="Dashboards">Dashboards</div>
            </a>

          </li>

        @endisUser

        @isVendor

        <li class="menu-item {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">

            <a href="{{ route('vendor.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div data-i18n="Dashboards">Dashboards</div>
            </a>

          </li>

        @endisVendor

        





      </ul>
    </div>
  </aside>
