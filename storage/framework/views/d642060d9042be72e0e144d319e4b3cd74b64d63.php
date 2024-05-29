<?php $__env->startSection('content'); ?>
    <main id="main">
        <section class="contact" style="margin-top: 100px">
            <div class="container">
                <div class="row">
                    <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <p>Pengaduan Kerusakan SIMRS</p>
                    </header>
                    <h2>Pengaduan Kerusakan SIMRS hanya berkaitan dengan masalah Hardware (Printer dan Komputer), Jaringan (Wifi , Internet), dan Software (Windows, Ms Office)</h2>
                    <div class="col-xl-12 contact">
                        <div id="add_complaint_error_message"></div>
                        <form action="" method="post" id="add_complaint">
                            <div class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                data-aos-delay="200">
                                <h5 class="text-center fw-bold mb-3">Data Pengaduan Kerusakan</h5>
                                <div class="row gy-4">
                                    <div class="form-group col-md-12 mb-2 mt-4">
                                        <label for="report_name">Nama Pelapor</label>
                                        <input id="ticket" type="hidden" name="complaint_ticket"
                                            value="<?php echo e($complaintTicket); ?>" readonly>
                                        <input class="form-control" id="reported_name" type="text" name="reported_name" required>
                                        
                                    </div>
                                    
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="address">Ruangan</label>
                                        <input class="form-control" id="address" type="text" name="address" required>
                                    </div>
                                    <div>
                                        <label for="priority">Kategori</label>
                                        <select class="form-select col-md-6 mb-2" name="category" id="category" required>
                                            <option value="">--- Kategori ---</option>
                                            <option value="1">Software</option>
                                            <option value="2">Hardware</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="address">Nama barang</label>
                                        <input class="form-control" id="nama_barang" type="text" name="nama_barang">
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="volume">Volume</label>
                                        <input class="form-control" id="volume" type="number" name="volume">
                                    </div>
                                    <div>
                                        <label for="priority">Prioritas</label>
                                        <select class="form-select col-md-6 mb-2" name="priority" id="priority" required>
                                            <option value="">--- Prioritas ---</option>
                                            <option value="1">Tidak Darurat</option>
                                            <option value="2">Darurat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="desc">Uraian Pengaduan</label>
                                        <textarea name="desc" id="desc" cols="30" rows="5" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label for="file">Lampiran Bukti</label>
                                        <input name="file" type="file" id="file" class="form-control" required>
                                        <small class="text-danger">Batas Upload File: 10 mb</small><br>
                                        <small class="text-danger">Format File Yang Bisa Diupload: .jpg, .jpeg, .png</small>
                                    </div>
                                </div>
                                
                                <button class="mt-4" type="submit" id="add_complaint_button">Submit</button>
                                <div class="mt-3" id="add_complaint_loading" role="status" style="color: #0099ff"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-script'); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo e(asset('assets/js/script-landing.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\RSUD\e-cus_friends\resources\views/complaint/user/create.blade.php ENDPATH**/ ?>