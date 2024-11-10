<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('reports.index')); ?>"
            class="nav-link <?php echo e(request()->routeIs('reports.index') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Report
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('wells.index')); ?>" class="nav-link <?php echo e(request()->routeIs('wells.index') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Description Wells
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('readings.index')); ?>"
            class="nav-link <?php echo e(request()->routeIs('readings.index') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Well Readings
            </p>
        </a>
    </li>



    



    <li class="nav-header">EXAMPLES</li>
</ul>
<?php /**PATH C:\laragon\www\report\resources\views/components/sidebar.blade.php ENDPATH**/ ?>