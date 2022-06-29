<?php $__env->startSection('title', 'Detail Siswa'); ?>
    
<?php $__env->startSection('css'); ?>
    <style>
        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
            text-decoration: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <a href="<?php echo e(route('siswa.index')); ?>" class="text-info">Data Siswa</a>
    <a href="#" class="text-grey">&nbsp;/&nbsp;</a>
    <a href="#" class="text-grey">Detail Siswa</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        Detail Siswa
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>NISN</th>
                                <td>:</td>
                                <td><?php echo e($siswa->nisn); ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td><?php echo e($siswa->nama); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td><?php echo e($siswa->email); ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td><?php echo e($siswa->username); ?></td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td>:</td>
                                <td><?php echo e($siswa->telp); ?></td>
                            </tr>
                            <tr>
                                <th>Hapus Siswa</th>
                                <td>:</td>
                                <td>
                                    <a href="#" data-nisn="<?php echo e($siswa->nisn); ?>" class="btn btn-danger siswa" style="width: 100%">HAPUS</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <?php if(session()->has('notif')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session()->get('notif')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click', '.siswa', function (e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Peringatan!',
                    text: "Yakin akan menghapus siswa?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',   
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '<?php echo e(route('siswa.destroy', $siswa->nisn)); ?>',
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>"
                        },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: 'Pemberitahuan!',
                                    text: "Siswa berhasil dihapus!",
                                    icon: 'success',
                                    confirmButtonColor: '#28B7B5',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = "<?php echo e(route('siswa.index')); ?>";
                                    }else{
                                        location.href = "<?php echo e(route('siswa.index')); ?>";
                                    }
                                });
                            }
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Siswa gagal dihapus!",
                                icon: 'error',
                                confirmButtonColor: '#28B7B5',
                                confirmButtonText: 'OK',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Pemberitahuan!',
                        text: "Siswa gagal dihapus!",
                        icon: 'error',
                        confirmButtonColor: '#28B7B5',
                        confirmButtonText: 'OK',
                    });
                }
            });
        });
    </script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/Admin/Siswa/show.blade.php ENDPATH**/ ?>