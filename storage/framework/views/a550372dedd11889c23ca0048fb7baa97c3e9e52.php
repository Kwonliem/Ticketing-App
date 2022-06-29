<?php $__env->startSection('title', 'Buat Pengaduan'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .content {
        background-color: #fff;
        border-radius: 11px;
        text-align: left;
    }

    .content h1 {
        font-weight: 500;
        font-size: 22px;
    }

    .content p {
        font-weight: 300;
        font-size: 16px;
        color: #707070;
    }

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jumbotron'); ?>
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-11 col-11">
        <div class="content p-5">
            <h1>Tulis Pengaduan Disini</h1>
            <p>Setelah pengaduan berhasil terkirim, petugas sekolah<br>akan memverifikasi kebenarannya terlebih dahulu!</p>
            <div class="mt-2">
                <form action="<?php echo e(route('call.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="judul_laporan">Judul Laporan</label>
                        <input type="text" value="<?php echo e(old('judul_laporan')); ?>" name="judul_laporan" id="judul_laporan"
                            placeholder="Tulis Judul Pengaduan Anda" class="form-control <?php $__errorArgs = ['judul_laporan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['judul_laporan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="isi_laporan">Isi Laporan</label>
                        <textarea name="isi_laporan" id="isi_laporan" rows="5" placeholder="Tulis Isi Pengaduan Anda" class="form-control <?php $__errorArgs = ['isi_laporan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('isi_laporan')); ?></textarea>
                        <?php $__errorArgs = ['isi_laporan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kejadian">Tanggal Kejadian</label>
                        <input type="text" value="<?php echo e(old('tgl_kejadian')); ?>" name="tgl_kejadian"
                            placeholder="Pilih Tanggal Kejadian" class="form-control <?php $__errorArgs = ['tgl_kejadian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" onfocusin="(this.type='date')"
                            onfocusout="(this.type='text')">
                        <?php $__errorArgs = ['tgl_kejadian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_kejadian">Tulis Lokasi Kejadian</label>
                        <textarea name="lokasi_kejadian" id="lokasi_kejadian" rows="3" class="form-control <?php $__errorArgs = ['lokasi_kejadian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> mb-3"
                            placeholder="Tulis Lokasi Kejadian"><?php echo e(old('lokasi_kejadian')); ?></textarea>
                        <?php $__errorArgs = ['lokasi_kejadian'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="kategori_kejadian">Pilih Kategori Kejadian</label>
                        <div class="input-group mb-3">
                            <select name="kategori_kejadian" id="kategori_kejadian" class="custom-select" required>
                                <option value="" selected>Pilih Kategori Kejadian</option>
                                <option value="agama">Agama</option>
                                <option value="hukum">Hukum</option>
                                <option value="lingkungan">Lingkungan</option>
                                <option value="sosial">Sosial</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Tambahkan Bukti Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn btn-custom text-white mt-3" style="width: 100%">KIRIM</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php if(!auth('siswa')->check()): ?>
        <script>
            Swal.fire({
                title: 'Peringatan!',
                text: "Login dibutuhkan!",
                icon: 'warning',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'Masuk',
                allowOutsideClick: false
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo e(route('call.masuk')); ?>';
                }else{
                    window.location.href = '<?php echo e(route('call.masuk')); ?>';
                }
                });
        </script>
    
    <?php endif; ?>

    <?php if(session()->has('pengaduan')): ?>
        <script>
            Swal.fire({
                title: 'Pemberitahuan!',
                text: '<?php echo e(session()->get('pengaduan')); ?>',
                icon: '<?php echo e(session()->get('type')); ?>',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/user/pengaduan.blade.php ENDPATH**/ ?>