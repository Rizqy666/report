<?php $__env->startSection('title', 'DAILY PLANT PARAMETER TRENDING'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">DAILY PLANT PARAMETER TRENDING</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Horizontal Form</h3>
                </div>
                <form action="<?php echo e(route('reports.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="well_id">Select Well</label>
                            <select name="well_id" id="well_id" class="form-control" required>
                                <option value="">Select Well</option>
                                <?php $__currentLoopData = $wells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $well): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($well->id); ?>"><?php echo e($well->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="well_reading_id">Select Well Reading</label>
                            <select name="well_reading_id" id="well_reading_id" class="form-control" required>
                                <option value="">Select Well Reading</option>
                                <!-- Akan diisi menggunakan JavaScript -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="value">Value for Report</label>
                            <input type="number" name="value" id="value" class="form-control" required
                                step="0.01">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Sign in</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
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
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">820</span>
                            <span><?php echo e(\Carbon\Carbon::now()->format('d-m-Y')); ?></span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 12.5%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Week
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
    <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report\resources\views/report/index.blade.php ENDPATH**/ ?>