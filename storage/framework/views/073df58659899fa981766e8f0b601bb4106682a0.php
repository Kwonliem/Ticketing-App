<?php $__env->startSection('title', 'Halaman Pengaduan'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header', "Data Pengaduan"); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            Data Pengaduan <?php echo e($status == '0' ? 'Belum diVerifikasi' : ucwords($status)); ?>

        </h6>
    </div>
    <div class="card-body">
        <table id="pengaduanTable" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                    <?php if($status == '0'): ?>
                        <th>Aksi</th>
                    <?php else: ?>
                        <th>Detail</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($k += 1); ?></td>
                    <td><?php echo e($v->tgl_pengaduan->format('d-M-Y')); ?></td>
                    <td><?php echo e($v->isi_laporan); ?></td>
                    <td>
                        <?php if($v->status == '0'): ?>
                            <a href="" class="badge badge-danger">Pending</a>
                        <?php elseif($v->status == 'proses'): ?>
                            <a href="" class="badge badge-warning text-white">Proses</a>
                        <?php else: ?>
                            <a href="" class="badge badge-success">Selesai</a>
                        <?php endif; ?>
                    </td>
                    <?php if($status == '0'): ?>
                    <td>
                        <a href="#" data-id_pengaduan="<?php echo e($v->id_pengaduan); ?>" class="btn btn-info pengaduan">Verifikasi</a>
                        <a href="#" data-id_pengaduan="<?php echo e($v->id_pengaduan); ?>" class="btn btn-danger pengaduanHapus">Hapus</a>
                    </td>
                    <?php else: ?>
                    <td><a href="<?php echo e(route('pengaduan.show', $v->id_pengaduan)); ?>" style="text-decoration: underline">Lihat</a></td>
                    <?php endif; ?>
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
            $('#pengaduanTable').DataTable();
        } );
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    
    
    $(document).on('click', '#del', function (e) {
        let id = $(this).data('userId');
        console.log(id);
    });



    $(document).on('click', '.pengaduan', function (e) {
        e.preventDefault();
        let id_pengaduan = $(this).data('id_pengaduan');
        Swal.fire({
                title: 'Peringatan!',
                text: "Yakin akan memverifikasi pengaduan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',   
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('tanggapan.createOrUpdate')); ?>',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id_pengaduan": id_pengaduan,
                        "status": "proses",
                        "tanggapan": ''
                    },
                    success: function (response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Pemberitahuan!',
                                text: "Pengaduan berhasil diverifikasi!",
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
                            text: "Pengaduan gagal diverifikasi!",
                            icon: 'error',
                            confirmButtonColor: '#28B7B5',
                            confirmButtonText: 'OK',
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Pemberitahuan!',
                    text: "Pengaduan gagal diverifikasi!",
                    icon: 'error',
                    confirmButtonColor: '#28B7B5',
                    confirmButtonText: 'OK',
                });
            }
        });
    });

    $(document).on('click', '.pengaduanHapus', function (e) {
        e.preventDefault();
        var id_pengaduan = $(this).data('id_pengaduan');
        Swal.fire({
                title: 'Peringatan!',
                text: "Yakin akan menghapus pengaduan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',   
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: '<?php echo e(route('pengaduan.destroy', 'id_pengaduan')); ?>',
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/admin/Pengaduan/filter.blade.php ENDPATH**/ ?>