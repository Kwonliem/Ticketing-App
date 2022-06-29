<?php $__env->startSection('title', 'Halaman Petugas'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header', 'Data Petugas'); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            Data Petugas
        </h6>
    </div>
    <div class="card-body">
        <a href="<?php echo e(route('petugas.create')); ?>" class="btn btn-info mb-2">Tambah Petugas</a>
        <table id="petugasTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th>Telp</th>
                    <th>Level</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($k += 1); ?></td>
                    <td><?php echo e($v->nama_petugas); ?></td>
                    <td><?php echo e($v->username); ?></td>
                    <td><?php echo e($v->telp); ?></td>
                    <td><?php echo e($v->level); ?></td>
                    <td><a href="<?php echo e(route('petugas.edit', $v->id_petugas)); ?>" style="text-decoration: underline">Lihat</a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#petugasTable').DataTable();
        } );
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/Admin/Petugas/index.blade.php ENDPATH**/ ?>