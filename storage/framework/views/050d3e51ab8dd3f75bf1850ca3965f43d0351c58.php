<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="mekanisme penyampaian pengaduan dugaan tindak pidana tertentu yang telah terjadi atau akan terjadi yang melibatkan pegawai dan orang lain yang yang dilakukan dalam organisasi tempatnya bekerja, dimana pelapor bukan merupakan bagian dari pelaku kejahatan yang dilaporkannya.">
    <meta name="keywords"
        content="whistleblowing system, rsud kota bogor, whistleblowing rsud kota bogor, pengaduan rsud kota bogor, wbs rsud kota bogor">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <title>Pengaduan Kerusakan Fasilitas</title>
    <?php echo $__env->make('layouts.landing.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('after-style'); ?>
</head>

<body class="landing-page d-flex flex-column justify-content-between" style="min-height: 100vh">
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="<?php echo e(route('complaint.create')); ?>" class="logo d-flex align-items-center">
                <img src="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>" alt="">
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    
                    <li><a class="nav-link <?php echo e(Route::currentRouteName() == 'complaint.create' ? 'active' : ''); ?>"
                            href="<?php echo e(route('complaint.create')); ?>">Pengaduan</a></li>
                    
                    <li><a class="nav-link <?php echo e(Route::currentRouteName() == 'login' ? 'active' : ''); ?>"
                            href="<?php echo e(route('login')); ?>">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <?php echo $__env->yieldContent('content'); ?>
    <footer id="footer" class="footer mt-5">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>SIMRS RSUD Kota Bogor</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="">SIMRS RSUD Kota Bogor</a>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <?php echo $__env->make('layouts.landing.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('after-script'); ?>
</body>

</html>
<?php /**PATH D:\Backupan\esimrs\resources\views/layouts/landing/master.blade.php ENDPATH**/ ?>