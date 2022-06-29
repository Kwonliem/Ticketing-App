<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <link href="<?php echo e(asset('css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('css'); ?>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CALL<br></div>
            </a>

            <hr class="sidebar-divider my-0">

            <?php if(auth('admin')->user()->level == 'admin'): ?>
            <li class="nav-item <?php echo e(request()->is('admin/dashboard*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard.index')); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Pengaduan
            </div>

            <li class="nav-item <?php echo e(request()->is('admin/pengaduan/0*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('call.filterPengaduan', '0')); ?>">
                    <i class="fas fa-fw fa-filter"></i>
                    <span>Verifikasi dan Validasi</span></a>
            </li>

            <li class="nav-item <?php echo e(request()->is('admin/pengaduan/proses*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('call.filterPengaduan', 'proses')); ?>">
                    <i class="fas fa-fw fa-sync"></i>
                    <span>Pengaduan Proses</span></a>
            </li>

            <li class="nav-item <?php echo e(request()->is('admin/pengaduan/selesai*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('call.filterPengaduan', 'selesai')); ?>">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Pengaduan Selesai</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Pengelolaan Data
            </div>

            <li class="nav-item <?php echo e(request()->is('admin/petugas*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('petugas.index')); ?>">
                    <i class="fas fa-fw fa-user-friends"></i>
                    <span>Petugas</span></a>
            </li>

            <li class="nav-item <?php echo e(request()->is('admin/siswa*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('siswa.index')); ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Siswa</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
            
                Data Grafik
            </div>

            <li class="nav-item <?php echo e(request()->is('admin/laporan*') ? 'active' : ''); ?>">
                <a class="nav-link" href="/admin/grafik">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Grafik</span></a>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
            
                Export PDF
            </div>

            <li class="nav-item <?php echo e(request()->is('admin/laporan*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('laporan.index')); ?>">
                    <i class="fas fa-fw fa-file-export"></i>
                    <span>Export PDF</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
            
                Semua Laporan
            </div>

            <li class="nav-item <?php echo e(request()->is('admin/laporan*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('laporan.all')); ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Semua Laporan</span></a>
            </li>
            <?php elseif(auth('admin')->user()->level == 'petugas'): ?>
            <li class="nav-item <?php echo e(request()->is('admin/dashboard*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard.index')); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Pengaduan
            </div>

            <li class="nav-item <?php echo e(request()->is('admin/pengaduan/0*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('call.filterPengaduan', '0')); ?>">
                    <i class="fas fa-fw fa-filter"></i>
                    <span>Verifikasi dan Validasi</span></a>
            </li>

            <li class="nav-item <?php echo e(request()->is('admin/pengaduan/proses*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('call.filterPengaduan', 'proses')); ?>">
                    <i class="fas fa-fw fa-sync"></i>
                    <span>Pengaduan Proses</span></a>
            </li>

            <li class="nav-item <?php echo e(request()->is('admin/pengaduan/selesai*') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('call.filterPengaduan', 'selesai')); ?>">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Pengaduan Selesai</span></a>
            </li>
            <?php endif; ?>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php echo $__env->yieldContent('header'); ?>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(auth('admin')->user()->nama_petugas); ?></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                        <?php echo $__env->yieldContent('info'); ?>
                    </div>
                    
                    <?php echo $__env->yieldContent('content'); ?>
                </div>

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2021 CALL</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('js/jquery.easing.min.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>

    <?php echo $__env->yieldContent('js'); ?>
</body>

</html><?php /**PATH D:\backup c\documents\Tugas\laporan-app\resources\views/layouts/admin.blade.php ENDPATH**/ ?>