<?php $__env->startSection('title',translate('Restaurant_bulk_import')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/export.png')); ?>" alt="">
                </div>
                    <?php echo e(translate('messages.Restaurant_bulk_import')); ?>

            </h1>
        </div>





        <div class="card">
            <div class="card-body p-2 p-xl-3">

                <div class="row gy-2">
                    <div class="col-lg-4">
                        <div class="border rounded p-3 p-xl-4">
                            <div class="d-flex justify-content-between gap-2 mb-4">
                                <div class="d-flex flex-column gap-1">
                                    <h2 class="mb-0 font-weight-normal"><?php echo e(translate('messages.step_1')); ?></h2>
                                    <div class="text-capitalize"><?php echo e(translate('messages.download_the_excel_file')); ?></div>
                                </div>
                                <img width="60" src="<?php echo e(dynamicAsset('/public/assets/admin/img/bulk1.png')); ?>" alt="">
                            </div>

                            <h5 class="mb-3"><?php echo e(translate('messages.instruction')); ?></h5>
                            <ul class="pl-4">
                                <li>
                                    <?php echo e(translate('Download_the_format_file_and_fill_it_with_proper_data.')); ?>

                                </li>
                                <li>
                                    <?php echo e(translate('You_can_download_the_example_file_to_understand_how_the_data_must_be_filled.')); ?>

                                </li>
                                <li>
                                    <?php echo e(translate('Have_to_upload_excel_file.')); ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border rounded p-3 p-xl-4">
                            <div class="d-flex justify-content-between gap-2 mb-4">
                                <div class="d-flex flex-column gap-1">
                                    <h2 class="mb-0 font-weight-normal"><?php echo e(translate('messages.step_2')); ?></h2>
                                    <div class="text-capitalize"><?php echo e(translate('messages.Match Spread sheet data according to instruction')); ?></div>
                                </div>
                                <img width="60" src="<?php echo e(dynamicAsset('/public/assets/admin/img/bulk2.png')); ?>" alt="">
                            </div>

                            <h5 class="mb-3"><?php echo e(translate('messages.instruction')); ?></h5>
                            <ul class="pl-4">
                                <li>
                                    <?php echo e(translate('Fill_up_the_data_according_to_the_format.')); ?>

                                </li>
                                <li>
                                    <?php echo e(translate('Make_sure_the_phone_numbers_and_email_addresses_are_unique.')); ?>

                                </li>
                                <li>
                                    <?php echo e(translate('You_can_get_zone_id_from_their_list,_please_input_the_right_ids.')); ?>

                                </li>
                                <li>
                                    <?php echo e(translate('For_delivery_time_the_format_is_"from-to_type"_for_example:_"30-40_min"._Also_you_can_use_days_or_hours_as_type._Please_be_carefull_about_this_format_or_leave_this_field_empty.')); ?>

                                </li>
                                <li>
                                    <?php echo e(translate('Latitude_must_be_a_number_between_-90_to_90_and_Longitude_must_a_number_between_-180_to_180._Otherwise_it_will_create_server_error')); ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border rounded p-3 p-xl-4">
                            <div class="d-flex justify-content-between gap-2 mb-4">
                                <div class="d-flex flex-column gap-1">
                                    <h2 class="mb-0 font-weight-normal"><?php echo e(translate('messages.step_3 ')); ?></h2>
                                    <div class="text-capitalize"><?php echo e(translate('messages.Validate data and complete import')); ?></div>
                                </div>
                                <img width="60" src="<?php echo e(dynamicAsset('/public/assets/admin/img/bulk3.png')); ?>" alt="">
                            </div>

                            <h5 class="mb-3"><?php echo e(translate('messages.instruction')); ?></h5>
                            <ul class="pl-4">
                                <li>
                                    <?php echo e(translate('In_the_Excel_file_upload_section,_first_select_the_upload_option.')); ?>

                                 </li>
                                 <li>
                                    <?php echo e(translate('Upload_your_file_in_.xls,_.xlsx_format.')); ?>

                                 </li>
                                 <li>
                                    <?php echo e(translate('Finally_click_the_upload_button.')); ?>

                                 </li>
                                <li>
                                   <?php echo e(translate('After_uploading_restaurant_you_need_to_edit_them_and_set_restaurants`s_logo_and_cover.`s_path')); ?>

                                </li>
                                <li>
                                   <?php echo e(translate('You_can_upload_your_restaurant_images_in_restaurant_folder_from_gallery,_and_copy_image`s_path')); ?>

                                </li>
                                <li>
                                   <?php echo e(translate('Default_password_for_restaurant_is_12345678.')); ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-center pb-4 mt-4">
                    <h3 class="mb-3 export--template-title"><?php echo e(translate('Download_Spreadsheet_Template')); ?></h3>
                    <div class="btn--container justify-content-center export--template-btns">
                        <a href="<?php echo e(dynamicAsset('public/assets/restaurants_bulk_format.xlsx')); ?>" download=""
                            class="btn btn-outline-primary"><?php echo e(translate('with_Current_Data')); ?></a>
                        <a href="<?php echo e(dynamicAsset('public/assets/restaurants_bulk_format_nodata.xlsx')); ?>" download=""
                            class="btn btn-primary"><?php echo e(translate('without_Any_Data')); ?></a>
                    </div>
                </div>
            </div>
        </div>




        <h4 class="mb-3 mt-4"><?php echo e(translate('Excel File Upload')); ?></h4>
        <div class="card">
            <div class="card-body">
                <form class="product-form" id="import_form"  action="<?php echo e(route('admin.restaurant.bulk-import')); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="button" id="btn_value">
                <div class="row gy-2">
                    <div class="col-lg-6">
                        <h5 class="mb-3"><?php echo e(translate('Select Data Upload type')); ?></h5>

                        <div class="border rounded">
                            <div class="radio-wrap d-flex justify-content-between gap-3 p-3 active">
                                <label class="form-check-label flex-grow-1" for="update_new_data"><?php echo e(translate('Upload New Data')); ?></label>
                                <input  value="import" type="radio" name="upload_type" id="update_new_data"  checked>
                            </div>
                            <div class="radio-wrap d-flex justify-content-between gap-3 p-3">
                                <label class="form-check-label flex-grow-1" for="update_ex_data"><?php echo e(translate('Update Existing Data')); ?></label>
                                <input value="update" type="radio" name="upload_type" id="update_ex_data">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mw-100">
                                <h5 class="mb-3"><?php echo e(translate('Import items file')); ?></h5>

                                <div class="image-box banner">
                                    <label for="upload_excel" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                        <img width="54" class="upload-icon" src="<?php echo e(asset('public/assets/admin/img/excel-upload.png')); ?>" alt="Upload Icon">
                                        <span class="upload-text px-2 filename text-center"><?php echo e(translate('Must be Excel files using our Excel template above')); ?></span>
                                    </label>

                                    <input type="file" id="upload_excel" name="upload_excel" accept=".xls, .xlsx" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <button id="reset_btn" type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                            <button type="submit" name="button"  class="btn btn-primary update_or_import"><?php echo e(translate('messages.Import')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        $('#reset_btn').click(function(){
            $('#upload_excel').val('');
            $('.filename').text('<?php echo e(translate('Must_be_Excel_files_using_our_Excel_template_above')); ?>');
            $('#bulk__import').val(null);
        })

    $(document).on("click", ":submit", function(e){
        e.preventDefault();
            let data = $(this).val();
            myFunction(data)
    });

    $('[name="upload_type"]').on('change', function() {
            $('[name="upload_type"]').parent().removeClass('active');
            $(this).parent().addClass('active');
        });

        $(document).on("click", ".update_or_import", function(e){
            e.preventDefault();
            let upload_type = $('input[name="upload_type"]:checked').val();
            myFunction(upload_type)
        });
    function myFunction(data) {
        Swal.fire({
        title: '<?php echo e(translate('Are_you_sure?')); ?>' ,
        text: "<?php echo e(translate('You_want_to_')); ?>" +data,
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: 'default',
        confirmButtonColor: '#FC6A57',
        cancelButtonText: '<?php echo e(translate('no')); ?>',
        confirmButtonText: '<?php echo e(translate('yes')); ?>',
        reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#btn_value').val(data);
                $("#import_form").submit();
            } else {
                toastr.success("<?php echo e(translate('Cancelled')); ?>");
            }
        })
    }
        </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/vendor/bulk-import.blade.php ENDPATH**/ ?>