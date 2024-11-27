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


    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Report Input Form</h3>
            </div>
            <form action="<?php echo e(route('reports.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <!-- Tampilkan Tanggal Hari Ini -->
                    <div class="form-group mb-3">
                        
                        
                        <div class="row">
                            <div class="col-4">
                                <label for="report_date" class="form-label">Tanggal Laporan</label>
                                <input type="date" name="report_date" class="form-control" required>


                            </div>
                        </div>
                    </div>

                    <!-- Tabel untuk Input -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">Well Name</th>
                                <th class="text-center" style="width: 22%;">Description</th>
                                <th class="text-center" style="width: 15%;">Tag</th>
                                <th class="text-center" style="width: 10%;">Unit</th>
                                <th class="text-center" style="width: 15%;">Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if($wells->isEmpty()): ?>
                                <!-- Jika Tidak Ada Data Wells -->
                                <tr>
                                    <td colspan="5" class="text-center">Belum memiliki data</td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $wells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $well): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <!-- Hitung jumlah baris untuk rowspan -->
                                    <?php
                                        $rowCount = $well->readings->count();
                                    ?>

                                    <?php if($rowCount === 0): ?>
                                        <!-- Jika Well Tidak Memiliki Readings -->
                                        <tr>
                                            <td colspan="5" class="text-center">"<?php echo e($well->name); ?>" belum memiliki data
                                                readings</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $well->readings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <!-- Nama Well -->
                                                <?php if($index === 0): ?>
                                                    <td rowspan="<?php echo e($rowCount); ?>"><?php echo e($well->name); ?></td>
                                                <?php endif; ?>

                                                <!-- Description -->
                                                <td><?php echo e($reading->description ?? '-'); ?></td>

                                                <!-- Tag -->
                                                <td><?php echo e($reading->tag ?? '-'); ?></td>

                                                <!-- Unit -->
                                                <td><?php echo e($reading->unit ?? '-'); ?></td>

                                                <!-- Input Value -->
                                                <td>
                                                    <input type="hidden"
                                                        name="data[<?php echo e($well->id); ?>][<?php echo e($reading->id); ?>][well_id]"
                                                        value="<?php echo e($well->id); ?>">
                                                    <input type="hidden"
                                                        name="data[<?php echo e($well->id); ?>][<?php echo e($reading->id); ?>][well_reading_id]"
                                                        value="<?php echo e($reading->id); ?>">
                                                    <input type="number"
                                                        name="data[<?php echo e($well->id); ?>][<?php echo e($reading->id); ?>][value]"
                                                        id="value_<?php echo e($reading->id); ?>" class="form-control" required
                                                        step="0.01" placeholder="Value"
                                                        style="width: 100%; padding-left: 8px;">


                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('visitors-chart').getContext('2d');
        const visitorsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartLabels, 15, 512) ?>, // Pastikan ini sudah benar
                datasets: [{
                    label: 'Daily Report Value',
                    data: <?php echo json_encode($chartValues, 15, 512) ?>, // Pastikan ini sudah benar
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