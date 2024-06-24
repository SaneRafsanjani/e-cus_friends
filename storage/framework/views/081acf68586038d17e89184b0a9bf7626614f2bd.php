<?php $__env->startSection('content'); ?>
    <main id="main">
        <section class="contact" style="margin-top: 100px">
            <div class="container">
                <div class="row">
                    
                    <div class="col-xl-12 contact">
                        <div id="add_complaint_error_message"></div>
                        <form action="" method="post" id="add_complaint">
                            <div class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                data-aos-delay="200">
                                <h5 class="text-center fw-bold mb-3">Data Petugas</h5>
                                <div class="row gy-4">
                                    <div class="form-group col-md-6 mb-2 mt-4">
                                        <label for="report_name">Petugas</label>
                                        <select class="form-control" name="pelaksana" id="pelaksana">
                                            <option value="">---- Pilih Petugas ----</option>
                                            <?php $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($p->ID_PETUGAS); ?>"><?php echo e($p->NAMA_PETUGAS); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        
                                    </div>
                                    
                                </div>
                                <button class="mt-4" type="submit" id="add_complaint_button">Submit</button>
                                <div class="mt-3" id="add_complaint_loading" role="status" style="color: #1c9285"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('assets/js/script-landing.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ipsrs\resources\views/complaint/admin/petugas.blade.php ENDPATH**/ ?>