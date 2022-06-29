

<?php $__env->startSection('title', 'Semua Laporan'); ?>
    

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<style>
    .text-link {
        color: #28B7B5;
        text-decoration: underline;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header', 'Semua Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
<div class="card-body">
    <?php if($pengaduan ?? ''): ?>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengaduan</th>
                <th>Judul Laporan</th>
                <th>Isi Laporan</th>
                <th>Tanggal Tanggapan</th>
                <th>Tanggapan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($k += 1); ?></td>
                <td><?php echo e($v->tgl_pengaduan->format('d-M-Y')); ?></td>
                <td><?php echo e($v->judul_laporan); ?></td>
                <td><?php echo e($v->isi_laporan); ?></td>
                <td><?php echo e($v->tanggapan->tgl_tanggapan->format('d-M-Y') ?? ''); ?></td>
                <td><?php echo e($v->tanggapan->tanggapan ?? ''); ?></td>
                <td>
                    <?php if($v->status == '0'): ?>
                    <a href="" class="badge badge-danger">Pending</a>
                    <?php elseif($v->status == 'proses'): ?>
                    <a href="" class="badge badge-warning text-white">Proses</a>
                    <?php else: ?>
                    <a href="" class="badge badge-success">Selesai</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="text-center">
        Tidak ada data
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/admin/laporan/all.blade.php ENDPATH**/ ?>