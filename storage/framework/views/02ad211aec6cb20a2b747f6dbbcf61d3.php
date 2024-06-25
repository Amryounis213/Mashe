<?php $__env->startSection('title', translate('system_addons')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .form-group {
            margin-bottom: 10px;
        }
    </style>
       <link rel="stylesheet" href="<?php echo e(dynamicAsset('public/assets/admin/vendor/swiper/swiper-bundle.min.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <!-- Page Header -->
                <h1 class="page-header-title text-capitalize">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <img src="<?php echo e(dynamicAsset('public/assets/admin/img/business.png')); ?>" class="w--20" alt="">
                    </div>
                    <span><?php echo e(translate('system_addons')); ?></span>

                </h1>
                <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#settingModal">
                    <strong class="mr-2"><?php echo e(translate('See_how_it_works')); ?></strong>
                    <div>
                        <i class="tio-info-outined ripple-animation"></i>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="" tabindex="-1" aria-labelledby="settingModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                        <button
                            type="button"
                            class="btn-close border-0"
                            data-dismiss="modal"
                            aria-label="Close"
                        ><i class="tio-clear"></i></button>
                    </div>
                    <div class="modal-body px-4 px-sm-5 pt-0 text-center">
                        <div class="row g-2 g-sm-3 mt-lg-0">
                            <div class="col-12">
                                <div class="swiper mySwiper pb-3">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="<?php echo e(dynamicAsset('public/assets/admin/img/slider-1.png')); ?>" loading="lazy"
                                                alt="" class="dark-support rounded">
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="d-flex flex-column align-items-center mx-w450 mx-auto">
                                                <p>
                                                    <?php echo e(translate('get_your_zip_file_from_the_purchased_theme_and_upload_it_and_activate_theme_with_your_Codecanyon_username_and_purchase_code')); ?>.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="d-flex flex-column align-items-center mx-w450 mx-auto">
                                                <img src="<?php echo e(dynamicAsset('public/assets/admin/img/slider-3.png')); ?>" loading="lazy"
                                                    alt="" class="dark-support rounded mb-4">
                                                <p>
                                                    <?php echo e(translate('now_you’ll_be_successfully_able_to_use_the_theme_for_your_website')); ?>

                                                </p>
                                                <p>
                                                    <?php echo e(translate('N:B_you_can_upload_only_theme_templates')); ?>.
                                                </p>
                                                <button class="btn btn-primary px-10 mt-3" data-dismiss="modal"><?php echo e(translate('Got_It')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- File Upload Card -->
        <div class="card mb-5">
            <div class="card-body pl-md-10">
                <h4 class="mb-3 text-capitalize d-flex align-items-center"><?php echo e(translate('Upload_payment_&_sms_module')); ?></h4>
                <form enctype="multipart/form-data" id="theme_form">
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-5 col-xl-4 col-xxl-3">
                            <!-- Drag & Drop Upload -->
                            <div class="uploadDnD">
                                <div class="form-group inputDnD">
                                    <input type="file" name="file_upload" class="form-control-file text--primary font-weight-bold read-file"
                                    id="inputFile" accept=".zip" data-title="<?php echo e(translate('Drag_&_drop_file_or_Browse_file')); ?>">
                                </div>
                            </div>

                            <div class="mt-5 card px-3 py-2 d--none" id="progress-bar">
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="">
                                        <img width="24" src="<?php echo e(dynamicAsset('/public/assets/admin/img/zip.png')); ?>" alt="">
                                    </div>
                                    <div class="flex-grow-1 text-start">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                            <span id="name_of_file" class="text-truncate fz-12"></span>
                                            <span class="text-muted fz-12" id="progress-label">0%</span>
                                        </div>
                                        <progress id="uploadProgress" class="w-100" value="0" max="100"></progress>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php ($condition_one=str_replace('MB','',ini_get('upload_max_filesize'))>=20 && str_replace('MB','',ini_get('upload_max_filesize'))>=20); ?>
                        <?php ($condition_two=str_replace('MB','',ini_get('post_max_size'))>=20 && str_replace('MB','',ini_get('post_max_size'))>=20); ?>
                        <div class="col-sm-6 col-lg-5 col-xl-4 col-xxl-9">
                            <div class="pl-sm-5">
                                <h5 class="mb-3 d-flex"><?php echo e(translate('instructions')); ?></h5>
                                <ul class="pl-3 d-flex flex-column gap-2 instructions-list">
                                    <li>
                                        1. <?php echo e(translate('please_make_sure')); ?>, <?php echo e(translate('your_server_php')); ?>

                                        "upload_max_filesize" <?php echo e(translate('value_is_grater_or_equal_to_20MB')); ?>. <?php echo e(translate('current_value_is')); ?>

                                        - <?php echo e(ini_get('upload_max_filesize')); ?>B
                                    </li>
                                    <li>
                                        2. <?php echo e(translate('please_make_sure')); ?>, <?php echo e(translate('your_server_php')); ?>

                                        "post_max_size"
                                        <?php echo e(translate('value_is_grater_or_equal_to_20MB')); ?>

                                        . <?php echo e(translate('current_value_is')); ?> - <?php echo e(ini_get('post_max_size')); ?>B
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button"
                                    class="btn btn--primary px-4 zip-upload" id="upload_theme"><?php echo e((isset($addons) && count($addons)>0)?translate('update'):translate('upload')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Buttons Card -->

        <!-- Theme Items -->
        <div class="row g-1 g-sm-2">
            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $data= include $addon.'/Addon/info.php';
                ?>

            <div class="col-6 col-md-4 col-xxl-3">
                <div class="card theme-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?php echo e($data['name']); ?>

                        </h3>

                        <div class="d-flex gap-2 gap-sm-3 align-items-center">
                            <?php if($data['is_published'] == 0): ?>
                                <button class="text-danger bg-transparent p-0 border-0 mr-2" data-toggle="modal" data-target="#deleteThemeModal_<?php echo e($key); ?>"><img src="<?php echo e(dynamicAsset('public/assets/admin/img/delete.svg')); ?>" class="svg" alt=""></button>
                                <!-- Delete Theme Modal -->
                                <div class="modal fade" id="deleteThemeModal_<?php echo e($key); ?>" tabindex="-1" aria-labelledby="deleteThemeModal_<?php echo e($key); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                                                <button
                                                    type="button"
                                                    class="btn-close border-0"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                ><i class="tio-clear"></i></button>
                                            </div>
                                            <div class="modal-body px-4 px-sm-5 text-center">
                                                <div class="mb-3 text-center">
                                                    <img width="75" src="<?php echo e(dynamicAsset('public/assets/admin/img/delete.png')); ?>" alt="">
                                                </div>

                                                <h3><?php echo e(translate('are_you_sure_you_want_to_delete_the').' '.$data['name']); ?>?</h3>
                                                <p class="mb-5"><?php echo e(translate('once_you_delete')); ?>, <?php echo e(translate('you_will_lost_the_this') .' '.$data['name']); ?></p>
                                                <div class="btn--container justify-content-center">
                                                    <button type="button" class="btn btn--primary min-w-120" data-dismiss="modal"><?php echo e(translate('cancel')); ?></button>
                                                    <button type="submit" class="btn btn--cancel min-w-120 theme-delete" data-dismiss="modal" data-path="<?php echo e($addon); ?>"><?php echo e(translate('delete')); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                                <button class="<?php echo e($data['is_published'] == 1 ? 'checkbox-color-primary' : 'text-muted'); ?> bg-transparent p-0 border-0" data-toggle="modal" data-target="#shiftThemeModal_<?php echo e($key); ?>"><img src="<?php echo e(dynamicAsset('public/assets/admin/img/check.svg')); ?>" class="svg" alt=""></button>

                                <div class="modal fade" id="shiftThemeModal_<?php echo e($key); ?>" tabindex="-1" aria-labelledby="shiftThemeModalLabel_<?php echo e($key); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 pb-0 d-flex justify-content-end">
                                                <button
                                                    type="button"
                                                    class="btn-close border-0"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                ><i class="tio-clear"></i></button>
                                            </div>
                                            <div class="modal-body px-4 px-sm-5 text-center">
                                                <div class="mb-3 text-center">
                                                    <img width="75" src="<?php echo e(dynamicAsset('public/assets/admin/img/success_image 2.png')); ?>" alt="">
                                                </div>

                                                <h3><?php echo e(translate('are_you_sure?')); ?></h3>
                                                <?php if($data['is_published']): ?>
                                                <p class="mb-5"><?php echo e(translate('want_to_disabled_this_'.' '.$data['name'])); ?></p>
                                                <?php else: ?>
                                                <p class="mb-5"><?php echo e(translate('want_to_activate_this_'.' '.$data['name'])); ?></p>
                                                <?php endif; ?>
                                                <div class="btn--container justify-content-center">
                                                    <button type="button" class="btn btn--cancel min-w-120" data-dismiss="modal"><?php echo e(translate('no')); ?></button>
                                                    <button type="button" class="btn btn--primary min-w-120 publish-addon" data-dismiss="modal" data-path="<?php echo e($addon); ?>"><?php echo e(translate('yes')); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="p-2 p-sm-3">
                        <div class="mb-2" id="activate_<?php echo e($key); ?>" style="display: none!important;">
                            <form action="" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input type="text" name="username" value=""
                                            class="form-control" placeholder="<?php echo e(translate('codecanyon_username')); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="purchase_code" value=""
                                            class="form-control" placeholder="<?php echo e(translate('purchase_code')); ?>">
                                    <input type="text" name="path" class="form-control" value="" hidden>
                                </div>

                                <div>
                                    <input type="hidden" value="key" name="theme">
                                    <button type="submit" class="btn btn--primary radius-button text-end"><?php echo e(translate('activate')); ?></button>
                                </div>
                            </form>
                        </div>

                        <div class="aspect-ration-3:2 border border-color-primary-light radius-10">
                            <img class="img-fit radius-10"
                                onerror='this.src="<?php echo e(dynamicAsset('public/assets/admin/img/placeholder.png')); ?>"'
                                src="<?php echo e(asset($addon.'/public/addon.png')); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- Activated Theme Modal -->
            <?php echo $__env->make('admin-views.system.addon.partials.activation-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>




    <div class="modal fade" id="settingModal">
        <div class="modal-dialog modal-lgstatus-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="single-item-slider owl-carousel">
                        <div class="item">
                            <div class="mb-20">
                                <div class="">
                                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/addon_setting.png')); ?>" loading="lazy" alt="" class="dark-support rounded mb-4 mw-100">
                                        <ol>
                                            <li><?php echo e(translate('After purchasing the Payment & SMS Module from Codecanyon, you will find a file download option.')); ?></li>
                                            <li><?php echo e(translate('Download the file. It will be downloaded as Zip format Filename.Zip.')); ?></li>
                                            <li><?php echo e(translate('Extract the file and you will get another file name payment.zip.')); ?></li>
                                            <li><?php echo e(translate('Upload the file here and your Addon uploading is complete !')); ?></li>
                                            <li><?php echo e(translate('Then active the Addon and setup all the options. you are good to go !')); ?></li>
                                        </ol>
                                        <div class="swiper-slide">
                                            <div class="d-flex flex-column align-items-center mx-w450 mx-auto">
                                                <button class="btn btn-primary px-10 mt-3" data-dismiss="modal"><?php echo e(translate('Got_It')); ?></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script href="<?php echo e(dynamicAsset('public/assets/admin/vendor/swiper/swiper-bundle.min.js')); ?>"></script>

<script>
    "use strict";
    $("img.svg").each(function () {
    let $img = jQuery(this);
    let imgID = $img.attr("id");
    let imgClass = $img.attr("class");
    let imgURL = $img.attr("src");

        jQuery.get(
          imgURL,
          function (data) {
            // Get the SVG tag, ignore the rest
            let $svg = jQuery(data).find("svg");

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== "undefined") {
              $svg = $svg.attr("id", imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== "undefined") {
              $svg = $svg.attr("class", imgClass + " replaced-svg");
            }

            // Remove any invalid XML tags as per http://validator.w3.organim
            $svg = $svg.removeAttr("xmlns:a");

            // Check if the viewport is set, else we gonna set it if we can.
            if (
              !$svg.attr("viewBox") &&
              $svg.attr("height") &&
              $svg.attr("width")
            ) {
              $svg.attr(
                "viewBox",
                "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
              );
            }

            // Replace image with new SVG
            $img.replaceWith($svg);
          },
          "xml"
        );
      });
        $('.read-file').on('change', function () {
            readUrl(this);
        });
        function readUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    let imgData = e.target.result;
                    let imgName = input.files[0].name;
                    input.setAttribute("data-title", imgName);
                    // console.log(e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        $('.zip-upload').on('click', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let formData = new FormData(document.getElementById('theme_form'));
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('admin.business-settings.system-addon.upload')); ?>",
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    $('#progress-bar').show();

                    // Listen to the upload progress event
                    xhr.upload.addEventListener("progress", function(e) {
                        if (e.lengthComputable) {
                            let percentage = Math.round((e.loaded * 100) / e.total);
                            $("#uploadProgress").val(percentage);
                            $("#progress-label").text(percentage + "%");
                        }
                    }, false);

                    return xhr;
                },
                beforeSend: function () {
                    $('#upload_theme').attr('disabled');
                },
                success: function(response) {
                    if (response.status == 'error') {
                        $('#progress-bar').hide();
                        toastr.error(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(response.status == 'success'){
                        toastr.success(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        location.reload();
                    }
                },
                complete: function () {
                    $('#upload_theme').removeAttr('disabled');
                },
            });
        })

    $('.publish-addon').on('click', function () {
        let path = $(this).data('path');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                    url: '<?php echo e(route('admin.business-settings.system-addon.publish')); ?>',
                    data: {
                        'path': path
                    },
                    success: function (data) {
                        if (data.flag === 'inactive') {
                            // console.log(data.view)
                            $('#activatedThemeModal').modal('show');
                            $('#activateData').empty().html(data.view);
                        } else {
                            if (data.errors) {
                                for (let i = 0; i < data.errors.length; i++) {
                                    toastr.error(data.errors[i].message, {
                                        CloseButton: true,
                                        ProgressBar: true
                                    });
                                }
                            } else {
                                toastr.success('<?php echo e(translate("updated successfully!")); ?>', {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                                setTimeout(function () {
                                    location.reload()
                                }, 2000);
                            }
                        }
                    }
                });
            })

    $('.theme-delete').on('click', function () {
        let path = $(this).data('path');
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.business-settings.system-addon.delete')); ?>',
                data: {
                    path
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.status === 'success') {
                        setTimeout(function () {
                            location.reload()
                        }, 2000);

                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }else if(data.status === 'error'){
                        toastr.error(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        })

        let swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/system/addon/index.blade.php ENDPATH**/ ?>