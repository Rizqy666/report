<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">DAILY PLANT PARAMETER TRENDING</h3>
                        <div>
                            <form method="GET" id="filterForm">
                                <select class="form-control" id="filter-well" name="well_reading"
                                    onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Data</option>
                                    <?php $__currentLoopData = $wellReadings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $well): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $well->wellReadings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($reading->id); ?>"
                                                <?php echo e($selectedWellReading == $reading->id ? 'selected' : ''); ?>>
                                                <?php echo e($well->name); ?> - <?php echo e($reading->description); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>

                        </div>
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

    <script>
        document.getElementById('filter-input').addEventListener('input', function() {
            const filterValue = this.value.toLowerCase();
            document.querySelectorAll('.report-item').forEach(function(item) {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filterValue) ? '' : 'none';
            });
        });
    </script>
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


        function filterByWell(value) {
            window.location.href = `<?php echo e(route('home')); ?>?well=${value}`
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report\resources\views/dashboard/home.blade.php ENDPATH**/ ?>