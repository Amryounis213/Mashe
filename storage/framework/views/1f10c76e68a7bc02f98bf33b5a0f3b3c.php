<?php $__env->startSection('title', translate('messages.add_delivery_man')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/delivery-man.png')); ?>" alt="public">
                </div>
                <span>
                    <?php echo e(translate('messages.add_new_deliveryman')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <form action="<?php echo e(route('admin.delivery-man.store')); ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title gap-1">
                        <span class="card-title-icon"><i class="tio-user"></i></span>
                        <span>
                            <?php echo e(translate('messages.general_info')); ?>

                        </span>
                    </h5>
                </div>
                <?php echo csrf_field(); ?>
                <div class="card-body pb-2">
                    <div class="row g-3">
                        <div class="col-lg-8">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.first_name')); ?></label>
                                        <input type="text" name="f_name" class="form-control h--45px"
                                            placeholder="<?php echo e(translate('Ex:_Jhone')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.last_name')); ?></label>
                                        <input type="text" name="l_name" class="form-control h--45px"
                                            placeholder="<?php echo e(translate('Ex:_Joe')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.email')); ?></label>
                                        <input type="email" name="email" class="form-control h--45px"
                                            placeholder="<?php echo e(translate('Ex:_ex@example.com')); ?>" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.deliveryman_type')); ?></label>
                                        <select name="earning" class="form-control h--45px">
                                            <option value="" readonly="true" hidden="true"><?php echo e(translate('messages.delivery_man_type')); ?></option>
                                            <option value="1"><?php echo e(translate('messages.freelancer')); ?></option>
                                            <option value="0"><?php echo e(translate('messages.salary_based')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.zone')); ?></label>
                                        <select name="zone_id" class="form-control js-select2-custom h--45px" required
                                            data-placeholder="<?php echo e(translate('messages.select_zone')); ?>">
                                            <option value="" readonly="true" hidden="true"><?php echo e(translate('Ex:_XYZ_Zone')); ?></option>
                                            <?php $__currentLoopData = \App\Models\Zone::where('status',1)->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset(auth('admin')->user()->zone_id)): ?>
                                                    <?php if(auth('admin')->user()->zone_id == $zone->id): ?>
                                                        <option value="<?php echo e($zone->id); ?>" selected><?php echo e($zone->name); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <option value="<?php echo e($zone->id); ?>"><?php echo e($zone->name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0"><?php echo e(translate('image')); ?></p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                    <img width="30" class="upload-icon" src="<?php echo e(asset('public/assets/admin/img/upload-icon.png')); ?>" alt="Upload Icon">
                                    <span class="upload-text"><?php echo e(translate('Upload Image')); ?></span>
                                    <img src="#" alt="Preview Image" class="preview-image">
                                    </label>
                                    <button type="button" class="delete_image">
                                    <i class="tio-delete"></i>
                                    </button>
                                    <input type="file" id="image-input" name="image" accept="image/*" hidden>
                                </div>

                                <p class="opacity-75 max-w220 mx-auto text-center">
                                    <?php echo e(translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title gap-1">
                        <span class="card-title-icon"><i class="tio-user"></i></span>
                        <span>
                            <?php echo e(translate('messages.Identification_Information')); ?>

                        </span>
                    </h5>
                </div>
                <?php echo csrf_field(); ?>
                <div class="card-body pb-2">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-group m-0">
                                <label class="input-label"><?php echo e(translate('messages.Vehicle')); ?></label>
                                <select name="vehicle_id" class="form-control js-select2-custom h--45px" required
                                    data-placeholder="<?php echo e(translate('messages.select_vehicle')); ?>">
                                    <option value="" readonly="true" hidden="true"><?php echo e(translate('messages.select_vehicle')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Vehicle::where('status',1)->get(['id','type']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($v->id); ?>" ><?php echo e($v->type); ?>

                                                </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group m-0">
                                <label class="input-label"><?php echo e(translate('messages.identity_type')); ?></label>
                                <select name="identity_type" class="form-control h--45px">
                                    <option value="passport"><?php echo e(translate('messages.passport')); ?></option>
                                    <option value="driving_license"><?php echo e(translate('messages.driving_license')); ?></option>
                                    <option value="nid"><?php echo e(translate('messages.nid')); ?></option>
                                    <option value="restaurant_id"><?php echo e(translate('messages.restaurant_id')); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group m-0">
                                <label class="input-label"><?php echo e(translate('messages.identity_number')); ?></label>
                                <input type="text" name="identity_number" class="form-control h--45px"
                                    placeholder="<?php echo e(translate('Ex:_DH-23434-LS')); ?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group m-0">
                                <label class="input-label"><?php echo e(translate('messages.identity_image')); ?></label>



                                <div class="row g-2" id="additional_Image_Section">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="custom_upload_input position-relative border-dashed-2">
                                            <input type="file" name="identity_image[]" class="custom-upload-input-file action-add-more-image"
                                                   data-index="1" data-imgpreview="additional_Image_1"
                                                   accept=".jpg, .png, .webp, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                                   data-target-section="#additional_Image_Section"
                                            >

                                            <span class="delete_file_input delete_file_input_section btn btn-outline-danger btn-sm square-btn d-none">
                                                <i class="tio-delete"></i>
                                            </span>

                                            <div class="img_area_with_preview z-index-2">
                                                <img id="additional_Image_1" class="bg-white d-none"
                                                     src="<?php echo e(asset('public/assets/admin/img/upload-icon.png-dummy')); ?>" alt="">
                                            </div>
                                            <div
                                                class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                                <div
                                                    class="d-flex flex-column justify-content-center align-items-center">
                                                    <img alt="" width="30"
                                                         src="<?php echo e(asset('public/assets/admin/img/upload-icon.png')); ?>">
                                                    <div class="text-muted mt-3"><?php echo e(translate('Upload_Picture')); ?></div>
                                                    <div class="fs-10 text-muted mt-1"><?php echo e(translate('Upload jpg, png, jpeg, gif maximum 2 MB')); ?></div>
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


            <?php if(isset($page_data) && count($page_data) > 0 ): ?>
                <div class="card shadow--card-2 mt-3">
                    <div class="card-header">
                        <h4 class="card-title m-0 d-flex align-items-center">
                             <span class="card-header-icon mr-2">
                                <i class="tio-user"></i>
                            </span>
                            <span><?php echo e(translate('messages.Additional_Data')); ?></span>
                        </h4>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <?php $__currentLoopData = data_get($page_data,'data',[]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($item['field_type'], ['file' , 'check_box']) ): ?>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="<?php echo e($item['input_data']); ?>"><?php echo e(translate($item['input_data'])); ?></label>
                                            <input id="<?php echo e($item['input_data']); ?>" <?php echo e($item['is_required']  == 1? 'required' : ''); ?> type="<?php echo e($item['field_type'] == 'phone' ? 'tel': $item['field_type']); ?>" name="additional_data[<?php echo e($item['input_data']); ?>]" class="form-control h--45px"
                                                placeholder="<?php echo e(translate($item['placeholder_data'])); ?>"
                                            >
                                        </div>
                                    </div>
                                <?php elseif($item['field_type'] == 'check_box' ): ?>
                                    <?php if($item['check_data'] != null): ?>
                                    <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for=""> <?php echo e(translate($item['input_data'])); ?> </label>
                                        <?php $__currentLoopData = $item['check_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="additional_data[<?php echo e($item['input_data']); ?>][]"  class="form-check-input" value="<?php echo e($i); ?>"> <?php echo e(translate($i)); ?>

                                            </label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    </div>
                                    <?php endif; ?>
                                <?php elseif($item['field_type'] == 'file' ): ?>
                                    <?php if($item['media_data'] != null): ?>
                                    <?php
                                    $image= '';
                                    $pdf= '';
                                    $docs= '';
                                        if(data_get($item['media_data'],'image',null)){
                                            $image ='.jpg, .jpeg, .png,';
                                        }
                                        if(data_get($item['media_data'],'pdf',null)){
                                            $pdf =' .pdf,';
                                        }
                                        if(data_get($item['media_data'],'docs',null)){
                                            $docs =' .doc, .docs, .docx' ;
                                        }
                                        $accept = $image.$pdf. $docs ;
                                    ?>
                                        <div class="col-md-4 col-12 image_count_<?php echo e($key); ?>" data-id="<?php echo e($key); ?>" >
                                            <div class="form-group">
                                                <label class="form-label" for="<?php echo e($item['input_data']); ?>"><?php echo e(translate($item['input_data'])); ?></label>
                                                <input id="<?php echo e($item['input_data']); ?>" <?php echo e($item['is_required']  == 1? 'required' : ''); ?> type="<?php echo e($item['field_type']); ?>" name="additional_documents[<?php echo e($item['input_data']); ?>][]" class="form-control h--45px"
                                                    placeholder="<?php echo e(translate($item['placeholder_data'])); ?>"
                                                        <?php echo e(data_get($item['media_data'],'upload_multiple_files',null) ==  1  ? 'multiple' : ''); ?> accept="<?php echo e($accept ??  '.jpg, .jpeg, .png'); ?>"
                                                    >

                                            


                                                
                                                




                                                </div>

                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <span class="card-header-icon"><i class="tio-user"></i></span>
                        <span><?php echo e(translate('messages.account_info')); ?></span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group m-0">
                                <label class="input-label" for="phone"><?php echo e(translate('messages.phone')); ?></label>
                                <div class="input-group">
                                    <input type="tel" name="phone" id="phone" placeholder="<?php echo e(translate('Ex:_017********')); ?>"
                                        class="form-control h--45px" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-0">
                                <label class="input-label"
                                    for="exampleFormControlInput1"><?php echo e(translate('messages.password')); ?>

                                    <span class="input-label-secondary ps-1" title="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"></span>
                                </label>
                                <input type="text" name="password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"
                                class="form-control h--45px" placeholder="<?php echo e(translate('Ex:_8+_Character')); ?>"
                                    required>
                            </div>
                        </div>
                        <!-- This is Static -->
                        <div class="col-md-4">
                            <div class="form-group m-0">
                                <label class="input-label"
                                for="exampleFormControlInput1"><?php echo e(translate('messages.confirm_password')); ?></label>
                                <input type="text" name="password" class="form-control h--45px"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"
                                placeholder="<?php echo e(translate('Ex:_8+_Character')); ?>"
                                required>
                            </div>
                        </div>
                        <!-- This is Static -->
                    </div>
                </div>
            </div>
            <div class="btn--container mt-4 justify-content-end">
                <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                <button type="submit" class="btn btn--primary submitBtn"><?php echo e(translate('messages.submit')); ?></button>
            </div>
        </form>
    </div>

</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        "use strict";
        let elementCustomUploadInputFileByID = $('.custom-upload-input-file');
        let elementCustomUploadInputFileByID2 = $('.custom-upload-input-file2');

        $('.action-add-more-image').on('change', function () {
            let parentDiv = $(this).closest('div');
            parentDiv.find('.delete_file_input').removeClass('d-none');
            parentDiv.find('.delete_file_input').fadeIn();
            addMoreImage(this, $(this).data('target-section'))
        })
        $('.action-add-more-image2').on('change', function () {
            let parentDiv = $(this).closest('div');
            parentDiv.find('.delete_file_input').removeClass('d-none');
            parentDiv.find('.delete_file_input').fadeIn();
            addMoreImage2(this, $(this).data('target-section') )
        })

        function addMoreImage(thisData, targetSection) {
            let $fileInputs = $(targetSection + " input[type='file']");
            let nonEmptyCount = 0;
            $fileInputs.each(function () {
                if (parseFloat($(this).prop('files').length) === 0) {
                    nonEmptyCount++;
                }
            });

            uploadColorImage(thisData)

            if (nonEmptyCount === 0) {

                let datasetIndex = thisData.dataset.index + 1;

                let newHtmlData = `<div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="custom_upload_input position-relative border-dashed-2">
                                    <input type="file" name="${thisData.name}" class="custom-upload-input-file action-add-more-image" data-index="${datasetIndex}" data-imgpreview="additional_Image_${datasetIndex}"
                                        accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" data-target-section="${targetSection}">

                                    <span class="delete_file_input delete_file_input_section btn btn-outline-danger btn-sm square-btn d-none">
                                        <i class="tio-delete"></i>
                                    </span>

                                    <div class="img_area_with_preview position-absolute z-index-2 border-0">
                                        <img alt="" id="additional_Image_${datasetIndex}" class="bg-white d-none" src="img">
                                    </div>
                                    <div class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <img alt="" width="30"
                                                         src="<?php echo e(asset('public/assets/admin/img/upload-icon.png')); ?>">
                                            <div class="text-muted mt-3"><?php echo e(translate('Upload_Picture')); ?></div>
                                            <div class="fs-10 text-muted mt-1"><?php echo e(translate('Upload jpg, png, jpeg, gif maximum 2 MB')); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                $(targetSection).append(newHtmlData);
            }

            elementCustomUploadInputFileByID.on('change', function () {
                if (parseFloat($(this).prop('files').length) !== 0) {
                    let parentDiv = $(this).closest('div');
                    parentDiv.find('.delete_file_input').fadeIn();
                }
            })

            $('.delete_file_input_section').click(function () {
                $(this).closest('div').parent().remove();
            });


            $('.action-add-more-image').on('change', function () {
                let parentDiv = $(this).closest('div');
                parentDiv.find('.delete_file_input').removeClass('d-none');
                parentDiv.find('.delete_file_input').fadeIn();
                addMoreImage(this, $(this).data('target-section'))
            })

        }
        function addMoreImage2(thisData, targetSection) {

            let $fileInputs = $(targetSection + " input[type='file']");
            let nonEmptyCount = 0;
            $fileInputs.each(function () {
                if (parseFloat($(this).prop('files').length) === 0) {
                    nonEmptyCount++;
                }
            });
          var  count=0;

          console.log(thisData.dataset.image_count_key);
            uploadColorImage(thisData)
            $('.image_count_'+thisData.dataset.image_count_key).each(function() {
                const dataIndexElements = $(this).find('[data-index]');

                count += dataIndexElements.length;
            });

            if(count ===  5){
              console.log('done');
              return true;
            }
            if (nonEmptyCount === 0) {

            let datasetIndex = thisData.dataset.index + 1;

            let newHtmlData = ` <div class="col-sm-6 col-md-4 col-lg-3">
                <p class="mb-2 form-label">&nbsp;</p>
                        <div class=" custom_upload_input position-relative border-dashed-2">
                            <input type="file" name="${thisData.name}" class="custom-upload-input-file2 action-add-more-image2"
                                    data-index="${datasetIndex}" data-imgpreview="additional_data_Image_${datasetIndex}"
                                    accept="${thisData.accept}"
                                    data-target-section="${targetSection}"
                                    data-image_count_key="${thisData.dataset.image_count_key}"
                            >

                            <span class="delete_file_input delete_file_input_section btn btn-outline-danger btn-sm square-btn d-none">
                                <i class="tio-delete"></i>
                            </span>

                            <div class="img_area_with_preview z-index-2">
                                <img id="additional_data_Image_${datasetIndex}" class="bg-white d-none"
                                        src="<?php echo e(asset('public/assets/admin/img/upload-icon.png-dummy')); ?>" alt="">
                            </div>
                            <div
                                class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center">
                                    <img alt="" width="30"
                                            src="<?php echo e(asset('public/assets/admin/img/upload-icon.png')); ?>">
                                    <div class="text-muted mt-3"><?php echo e(translate('Upload_Picture')); ?></div>
                                    <div class="fs-10 text-muted mt-1"><?php echo e(translate('Upload jpg, png, jpeg, gif maximum 2 MB')); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>`;







            $(targetSection).append(newHtmlData);
            }
            elementCustomUploadInputFileByID2.on('change', function () {
                if (parseFloat($(this).prop('files').length) !== 0) {
                    let parentDiv = $(this).closest('div');


                    parentDiv.find('.delete_file_input').fadeIn();
                }
            })

            $('.delete_file_input_section').click(function () {
                $(this).closest('div').parent().remove();
            });


            $('.action-add-more-image2').on('change', function () {
                let parentDiv = $(this).closest('div');
                parentDiv.find('.delete_file_input').removeClass('d-none');
                parentDiv.find('.delete_file_input').fadeIn();
                addMoreImage2(this,$(this).data('target-section') )
            })

        }

        $('.delete_file_input').on('click', function () {
            let $parentDiv = $(this).parent().parent();
            $parentDiv.find('input[type="file"]').val('');
            $parentDiv.find('.img_area_with_preview img').addClass("d-none");
            $(this).removeClass('d-flex');
            $(this).hide();
        });

        function uploadColorImage(thisData = null) {
            if (thisData) {
                document.getElementById(thisData.dataset.imgpreview).setAttribute("src", window.URL.createObjectURL(thisData.files[0]));
                document.getElementById(thisData.dataset.imgpreview).classList.remove('d-none');
            }
        }



        $('#reset_btn').click(function(){
            location.reload();
            $('#viewer').attr('src','<?php echo e(dynamicAsset('public/assets/admin/img/900x400/img1.jpg')); ?>');
            $('#coba').attr('src','<?php echo e(dynamicAsset('public/assets/admin/img/900x400/img1.jpg')); ?>');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/delivery-man/index.blade.php ENDPATH**/ ?>