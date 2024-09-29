<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
      <ul class="menu-inner">
        <!-- Dashboards -->


        <?php if (\Illuminate\Support\Facades\Blade::check('isUser')): ?>

        <li class="menu-item <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>">

            <a href="<?php echo e(route('user.dashboard')); ?>" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div data-i18n="Dashboards">Dashboards</div>
            </a>

          </li>

        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('isVendor')): ?>

        <li class="menu-item <?php echo e(request()->routeIs('vendor.dashboard') ? 'active' : ''); ?>">

            <a href="<?php echo e(route('vendor.dashboard')); ?>" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div data-i18n="Dashboards">Dashboards</div>
            </a>

          </li>

        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('isUniversity')): ?>

        <li class="menu-item <?php echo e(request()->routeIs('university.dashboard') ? 'active' : ''); ?>">

            <a href="<?php echo e(route('university.dashboard')); ?>" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div data-i18n="Dashboards">Dashboards</div>
            </a>

          </li>

        <?php endif; ?>






      </ul>
    </div>
  </aside>
<?php /**PATH /home/almir/Desktop/tanzaadmin/resources/views/user/partials/navbar.blade.php ENDPATH**/ ?>