<?php $__env->startSection('title', 'Edit Readings Description'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Edit Readings Description</li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>


    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Readings</h3>
            </div>
            <form action="<?php echo e(route('readings.update', $wellReading->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Wells</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tambahkan description" value="<?php echo e(old('name', $well->name)); ?>" required
                                disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Tambahkan description"
                                value="<?php echo e(old('description', $wellReading->description)); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tag" class="col-sm-2 col-form-label">Tag</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tag" name="tag"
                                placeholder="Tambahkan tag" value="<?php echo e(old('tag', $wellReading->tag)); ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="unit" name="unit"
                                placeholder="Tambahkan unit" value="<?php echo e(old('unit', $wellReading->unit)); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="<?php echo e(route('readings.index')); ?>" class="btn btn-default float-right">Cancel</a>
                </div>
            </form>



        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
    <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 5,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report\resources\views/well_readings/edit.blade.php ENDPATH**/ ?>