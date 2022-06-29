<?php $__env->startSection('title', 'Detail Pengaduan'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .jumbotron {
        padding-top: 45px;
    }

    .breadcrumb-item a {
        color: #28B7B5;
    }

    .thumbnail {
        padding: 16px;
        background: #fff;
        border-radius: 16px;
    }

    .board-white {
        padding: 30px 20px 50px 20px;
        background: #fff;
        border-radius: 16px;
        text-align: left;
    }

    .board-white-info {
        padding: 30px 20px 30px 20px;
        background: #fff;
        border-radius: 16px;
        text-align: left;
    }

    .board-white h2 {
        font-weight: 500;
        font-size: 28px;
    }

    .board-white p, .text-grey {
        color: #909090;
    }

    .board-white .price {
        font-weight: 400;
        font-size: 22px;
        color: #28B7B5;
    }

    .board-white-info .photo {
        width: 70px;
        height: 70px;
        float: left;
        border-radius: 50%;
        margin-right: 16px;
    }

    .board-white-info .self-align {
        padding-top: 10px;
    }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jumbotron'); ?>
<div class="container-fluid">
    <div class="row custom-breadcrumb">
        <div class="col-lg-12 col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="<?php echo e(url()->previous()); ?>">Pengaduan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pengaduan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mt-4">
            <div class="thumbnail">
                <img src="<?php echo e(Storage::url($pengaduan->foto)); ?>" alt="" class="embed-responsive">
            </div>
        </div>
        <div class="col-lg-4 mt-4">
            <div class="board-white">
                <h2><?php echo e($pengaduan->judul_laporan); ?></h2>
                <p>
                    <?php if($pengaduan->status == '0'): ?>
                        <a href="" class="badge badge-danger">Pending</a>
                    <?php elseif($pengaduan->status == 'proses'): ?>
                        <a href="" class="badge badge-warning text-white">Proses</a>
                    <?php else: ?>
                        <a href="" class="badge badge-success">Selesai</a>
                    <?php endif; ?>
                </p>
                <p><?php echo e($pengaduan->isi_laporan); ?></p>
                <?php if($pengaduan->tanggapan != null): ?>
                    <p class="m-0">Tanggapan :</p>
                    <p class="m-0"><?php echo e($pengaduan->tanggapan->tanggapan); ?></p>
                <?php endif; ?>
                <p class="m-0 float-right mt-3"><?php echo e('Kategori '. ucwords($pengaduan->kategori_kejadian)); ?> - <?php echo e($pengaduan->tgl_kejadian->format('d M Y')); ?></p>
            </div>
            <div class="board-white-info mt-4">
                <p class="text-dark font-weight-bold">Pelapor</p>
                <img src="<?php echo e(asset('images/user_default.png')); ?>" alt="user profile"
                    class="photo">
                <div class="self-align">
                    <h5><a style="color: #28B7B5" href="#"><?php echo e($pengaduan->user->nama); ?></a></h5>
                    <p class="text-dark"><?php echo e($pengaduan->user->username); ?></p>
                </div>
            </div>
            <?php if($pengaduan->tanggapan != null): ?>
            <div class="board-white-info mt-4">
                <p class="text-dark font-weight-bold">Petugas</p>
                <img src="<?php echo e(asset('images/user_default.png')); ?>" alt="user profile"
                    class="photo">
                <div class="self-align">
                    <h5><a style="color: #28B7B5" href="#"><?php echo e($pengaduan->tanggapan->petugas->nama_petugas); ?></a></h5>
                    <p class="text-dark"><?php echo e($pengaduan->tanggapan->petugas->username); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/user/detail.blade.php ENDPATH**/ ?>