<?php $__env->startSection('title', 'Detail Pengaduan'); ?>
    
<?php $__env->startSection('css'); ?>
    <style>
        .text-primary:hover {
            text-decoration: underline;
        }

        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
        }

        .btn-purple {
            background: #6a70fc;
            border: 1px solid #6a70fc;
            color: #fff;
            width: 100%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <a href="<?php echo e(url()->previous()); ?>" class="text-primary">Data Pengaduan</a>
    <a href="#" class="text-grey">&nbsp;/&nbsp;</a>
    <a href="#" class="text-grey">Detail Pengaduan</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="text-center">
                        <h6 class="m-0 font-weight-bold text-info">
                            Pengaduan Sekolah
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>NISN</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->nisn); ?></td>
                            </tr>
                            <tr>
                                <th>Nama Siswa</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->user->nama); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengaduan</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->tgl_pengaduan->format('d-M-Y')); ?></td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td>:</td>
                                <td><img src="<?php echo e(url('storage/'.$pengaduan->foto)); ?>" class="img-fluid" alt="<?php echo e($pengaduan->judul_laporan); ?>"></td>
                            </tr>
                            <tr>
                                <th>Judul Laporan</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->judul_laporan); ?></td>
                            </tr>
                            <tr>
                                <th>Isi Laporan</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->isi_laporan); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kejadian</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->tgl_kejadian->format('d-M-Y')); ?></td>
                            </tr>
                            <tr>
                                <th>Kategori Kejadian</th>
                                <td>:</td>
                                <td><?php echo e(ucwords($pengaduan->kategori_kejadian)); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    <?php if($pengaduan->status == '0'): ?>
                                        <a href="" class="badge badge-danger">Pending</a>
                                    <?php elseif($pengaduan->status == 'proses'): ?>
                                        <a href="" class="badge badge-warning text-white">Proses</a>
                                    <?php else: ?>
                                        <a href="" class="badge badge-success">Selesai</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Lokasi Kejadian</th>
                                <td>:</td>
                                <td><?php echo e($pengaduan->lokasi_kejadian); ?></td>
                            </tr>
                            <tr>
                                <th>Hapus Pengaduan</th>
                                <td>:</td>
                                <td><a href="#" class="btn btn-danger mt-2 mr-1 pengaduan" style="width: 100%">Hapus</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="text-center">
                        <h6 class="m-0 font-weight-bold text-info">
                            Tanggapan Petugas
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('tanggapan.createOrUpdate')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id_pengaduan" value="<?php echo e($pengaduan->id_pengaduan); ?>">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="input-group mb-3">
                                <select name="status" id="status" class="custom-select">
                                    <?php if($pengaduan->status == '0'): ?>
                                        <option selected value="0">Pending</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    <?php elseif($pengaduan->status == 'proses'): ?>
                                        <option value="0">Pending</option>
                                        <option selected value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                    <?php else: ?>
                                        <option value="0">Pending</option>
                                        <option value="proses">Proses</option>
                                        <option selected value="selesai">Selesai</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggapan">Tanggapan</label>
                            <textarea name="tanggapan" id="tanggapan" rows="4" class="form-control" placeholder="Belum ada tanggapan"><?php echo e($tanggapan->tanggapan ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-info" style="width: 100%">KIRIM</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php if(session()->has('status')): ?>
<script>
    Swal.fire({
        title: 'Pemberitahuan!',
        text: "<?php echo e(Session::get('status')); ?>",
        icon: 'success',
        confirmButtonColor: '#28B7B5',
        confirmButtonText: 'OK',
    });
    </script>
<?php endif; ?>
<script>
    $(document).on('click', '.pengaduan', function (e) {
        e.preventDefault();
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
                    url: '<?php echo e(route('pengaduan.destroy', $pengaduan->id_pengaduan)); ?>',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>"
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
                                    location.href = "<?php echo e(route('call.filterPengaduan', ['status' => '0'])); ?>";
                                }else{
                                    location.href = "<?php echo e(route('call.filterPengaduan', ['status' => '0'])); ?>";
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/admin/Pengaduan/show.blade.php ENDPATH**/ ?>