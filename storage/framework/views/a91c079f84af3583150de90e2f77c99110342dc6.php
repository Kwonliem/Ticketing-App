<?php $__env->startSection('title', 'Pengaduan'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/laporan.css')); ?>">
    <style>
        .my-shadow {
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        .btn-warning {
            background: #fff !important;
            border-color: orange !important;
            color: orange !important;
        }

        .btn-warning:hover {
            background: orange !important;
            color: #fff !important;
        }

        .btn-danger {
            background: #fff !important;
            border-color: red !important;
            color: red !important;
        }

        .btn-danger:hover {
            background: red !important;
            color: #fff !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jumbotron'); ?>
<h1 class="text-center text-hero mb-3"><?php echo e($siapa == 'me' ? 'Pengaduan Saya' : 'Semua Pengaduan'); ?></h1>
<p class="text-center text-subtitle mb-4"><?php echo e($siapa == 'me' ? 'Hanya berisi pengaduan yang saya buat' : 'Berisi semua pengaduan yang dikirimkan siswa lain'); ?></p>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
        <div class="card my-shadow mb-4">
            <img src="<?php echo e(url('storage/'.$v->foto)); ?>" class="img-fluid" alt="<?php echo e($v->judul_laporan); ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-7">
                        <h2><?php echo e($v->judul_laporan); ?></h2>
                        <p class="text-truncate"><?php echo e($v->isi_laporan); ?></p>
                        <?php if($v->status == '0'): ?>
                            <a href="" class="badge badge-danger">Pending</a>
                        <?php elseif($v->status == 'proses'): ?>
                            <a href="" class="badge badge-warning text-white">Proses</a>
                        <?php else: ?>
                            <a href="" class="badge badge-success">Selesai</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-5">
                        <a href="<?php echo e(route('call.detail', $v->id_pengaduan)); ?>" class="mt-2 mr-1">Detail</a>
                        <?php if($v->user->nisn == auth('siswa')->user()->nisn): ?>

                        <?php if($v->status == 'selesai'): ?>
                        <?php else: ?>
                        <a href="<?php echo e(route('call.edit', $v->id_pengaduan)); ?>" class="btn-warning mt-2 mr-1">Edit</a>
                        <?php endif; ?>    
                        <a href="#" data-id_pengaduan="<?php echo e($v->id_pengaduan); ?>" class="btn-danger mt-2 mr-1 pengaduan">Hapus</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click', '.pengaduan', function (e) {
            e.preventDefault();
            let id_pengaduan = $(this).data('id_pengaduan');
            Swal.fire({
                    title: 'Peringatan!',
                    text: "Yakin akan menghapus pegaduan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',   
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "<?php echo e(route('call.laporanDestroy')); ?>",
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            "id_pengaduan": id_pengaduan
                        },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: 'Pemberitahuan!',
                                    text: "Pengaduan berhasil dihapus!",
                                    icon: 'success',
                                    confirmButtonColor: '#28B7B5',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }else{
                                        location.reload();
                                    }
                                });
                            }
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Pengaduan gagal dihapus!",
                                icon: 'error',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Pengaduan gagal dihapus!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/user/laporan.blade.php ENDPATH**/ ?>