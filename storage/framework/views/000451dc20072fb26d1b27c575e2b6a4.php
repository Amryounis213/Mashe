<?php $__env->startSection('title',translate('messages.terms_and_condition')); ?>

<?php $__env->startSection('content'); ?>
<div class="h-148px"></div>
    <main>
        <div class="main-body-div">
            <!-- Top Start -->
            <section class="top-start min-h-100px">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-2 text-center">
                           <h1><?php echo e(translate('messages.terms_and_condition')); ?></h1>
                           <br> <br>
                        </div>
                        <div class="col-12">
                            <?php echo $data; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- Top End -->
        </div>
    </main>
    <div class="h-148px"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/terms-and-conditions.blade.php ENDPATH**/ ?>