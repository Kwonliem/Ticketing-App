<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <title>Masuk • CALL</title>

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

        .btn-social {
            font-weight: 400;
            font-size: 16px;
            background: #f6f6f6;
            border: #f6f6f6;
            padding: 10px 24px 10px 24px;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-social:hover {
            font-weight: 400;
            font-size: 16px;
            background: #ececec;
            border: #f6f6f6;
            padding: 10px 24px 10px 24px;
            width: 100%;
        }

    </style>
</head>

<body>

    <nav class="navbar py-4 navbar-expand-lg navbar-light bg-white custom-nav">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo e(route('call.index')); ?>">CA<span>LL</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(route('call.index')); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('tentang*') ? 'active' : ''); ?>" href="<?php echo e(route('call.tentang')); ?>">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('pengaduan*') ? 'active' : ''); ?>" href="<?php echo e(route('call.pengaduan')); ?>">Buat
                                Pengaduan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="jumbotron">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-10 col-11">
                <div class="content p-5">
                    <h1>Masuk terlebih dahulu</h1>
                    <p>Silahkan masuk menggunakan akun yang sudah didaftarkan atau menggunakan media sosial.</p>
                    <div class="mt-2">
                        <form action="<?php echo e(route('call.login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="username">Email atau Username</label>
                                <input type="text" value="<?php echo e(old('username')); ?>" name="username" id="username" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['username'];
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
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['password'];
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
                            <button type="submit" class="btn btn-custom text-white mt-3" style="width: 100%">Masuk</button>
                        </form>
                        <div class="text-center">
                            <p class="my-3">Belum punya akun? <a href="<?php echo e(route('call.daftar')); ?>" style="text-decoration: underline">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>
<?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/user/masuk.blade.php ENDPATH**/ ?>