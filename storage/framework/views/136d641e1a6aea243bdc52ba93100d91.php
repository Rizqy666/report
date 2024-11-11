<?php $__env->startSection('title', 'DAILY PLANT PARAMETER TRENDING'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">DAILY PLANT PARAMETER TRENDING</li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "<?php echo session('success'); ?>"
            });
        </script>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "<?php echo session('error'); ?>"
            });
        </script>
    <?php endif; ?>

    <div class="row">
        <div class="col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Report Input Form</h3>
                </div>
                <form action="<?php echo e(route('reports.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <!-- Tampilkan Tanggal Hari Ini -->
                        <div class="form-group">
                            <h4 class="form-text"><?php echo e(\Carbon\Carbon::now()->format('d-m-Y')); ?></h4>
                            <input type="hidden" name="report_date" value="<?php echo e(\Carbon\Carbon::now()->toDateString()); ?>">
                        </div>

                        <?php $__currentLoopData = $wells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $well): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="well-section mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">DESCRIPTION: <?php echo e($well->name); ?></h4>

                                </div>

                                <?php $__currentLoopData = $well->readings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group row">
                                        <!-- Kolom untuk Description -->
                                        <div class="col-md-3">
                                            <span class="form-text"><?php echo e($reading->description); ?></span>
                                        </div>
                                        <!-- Kolom untuk Tag -->
                                        <div class="col-md-2">
                                            <label for="value_<?php echo e($reading->id); ?>"
                                                class="col-form-label"><?php echo e($reading->tag); ?></label>
                                        </div>
                                        <!-- Kolom untuk Unit -->
                                        <div class="col-md-2">
                                            <label for="value_<?php echo e($reading->id); ?>" class="col-form-label">Satuan:
                                                <?php echo e($reading->unit); ?></label>
                                        </div>
                                        <!-- Kolom untuk Input Value -->
                                        <div class="col-md-5">
                                            <input type="hidden"
                                                name="data[<?php echo e($well->id); ?>][<?php echo e($reading->id); ?>][well_id]"
                                                value="<?php echo e($well->id); ?>">
                                            <input type="hidden"
                                                name="data[<?php echo e($well->id); ?>][<?php echo e($reading->id); ?>][well_reading_id]"
                                                value="<?php echo e($reading->id); ?>">
                                            <input type="number"
                                                name="data[<?php echo e($well->id); ?>][<?php echo e($reading->id); ?>][value]"
                                                id="value_<?php echo e($reading->id); ?>" class="form-control" required step="0.01"
                                                placeholder="Enter value for <?php echo e($reading->description); ?>">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>



            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">DAILY PLANT PARAMETER TRENDING</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Month
                        </span>
                    </div>
                </div>
            </div>
        </div>






    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
    <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>

    <script>
        const ctx = document.getElementById('visitors-chart').getContext('2d');
        const visitorsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
                datasets: [{
                    label: 'Daily Report Value',
                    data: <?php echo json_encode($chartValues, 15, 512) ?>,
                    borderColor: 'rgba(60,141,188,0.8)',
                    backgroundColor: 'rgba(60,141,188,0.4)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'category',
                        title: {
                            display: true,
                            text: 'Tanggal'
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Nilai'
                        },
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report\resources\views/report/index.blade.php ENDPATH**/ ?>