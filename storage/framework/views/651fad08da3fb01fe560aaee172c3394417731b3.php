<?php $__env->startSection('content'); ?>
<main id="main">
    <section class="hero d-flex align-items-center">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom">Selamat Datang Di </h1>
                    <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom">Whistleblowing System RSUD Kota Bogor</h1>
                    <h2 class="mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">Mari Bersama-sama Menciptakan Lingkungan Kerja Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</h2>

                    <div class="mx-auto mt-5" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                        <a class="btn-get-started" href="<?php echo e(route('complaint.create')); ?>">Buat Pengaduan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="row gx-0">
                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                    <div class="content">
                        <h2>DEFINISI WHISTLEBLOWING SYSTEM</h2>
                        <p>Mekanisme penyampaian pengaduan dugaan tindak pidana tertentu yang telah terjadi atau akan terjadi yang melibatkan pegawai dan orang lain yang yang dilakukan dalam organisasi tempatnya bekerja, dimana pelapor bukan merupakan bagian dari pelaku kejahatan yang dilaporkannya.</p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                    <img src="<?php echo e(asset('assets/images/landing/asd.jpg')); ?>" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="features mt-5">
        <div class="container">
            <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <p>Kriteria Pengaduan</p>
            </header>
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-start" data-aos="zoom-out" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                    <img src="<?php echo e(asset('assets/images/landing/categories.jpg')); ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                    <div class="row align-self-center gy-4">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-chat-square-dots"></i>
                                <h3>Penyuapan/Gratifikasi</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-chat-square-dots"></i>
                                <h3>Kecurangan Pengadaan Barang/Jasa</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-chat-square-dots"></i>
                                <h3>Pemalakan Penyedia Barang/Jasa</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-chat-square-dots"></i>
                                <h3>Korupsi</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-chat-square-dots"></i>
                                <h3>Pencurian atau Penyalahgunaan Aset</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-chat-square-dots"></i>
                                <h3>Benturan Kepentingan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <p>Jumlah Pengaduan</p>
            <h2 class="mt-3">Bulan <?php echo e(date('F Y')); ?></h2>
        </header>
        <div class="container">
            <canvas id="complaint_chart"></canvas>
        </div>
    </section>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        var violation = JSON.parse('<?php echo json_encode($violation); ?>')
        var complaint = JSON.parse('<?php echo json_encode($complaint); ?>')
</script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/script-landing.js')); ?>"></script>
<script>generateChart(violation, complaint)</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wbs\resources\views/complaint/user/index.blade.php ENDPATH**/ ?>