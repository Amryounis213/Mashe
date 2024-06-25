<?php $__env->startSection('title',translate('messages.language')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <h1 class="page-header-title text-capitalize">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notes.png')); ?>" class="mw-26px" alt="public">
                    </div>
                    <span>
                        <?php echo e(translate('messages.business_setup')); ?>

                    </span>
                </h1>
                <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                    <strong class="mr-2"><?php echo e(translate('See_how_it_works')); ?></strong>
                    <div>
                        <i class="tio-info-outined"></i>
                    </div>
                </div>
            </div>
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <?php echo $__env->make('admin-views.business-settings.partials.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="row __mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="search--button-wrapper justify-content-between">
                            <h5 class="m-0"><?php echo e(translate('language_content_table')); ?></h5>
                            <form class="search-form min--260">
                                <div class="input-group input--group">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control h--40px"
                                            placeholder="<?php echo e(translate('messages.Ex : Search')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>" value="<?php echo e(request()?->search ?? null); ?>" required>
                                    <input type="hidden">
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable"  >
                                <thead>
                                <tr>
                                    <th ><?php echo e(translate('SL#')); ?></th>
                                    <th ><?php echo e(translate('Current_value')); ?></th>
                                    <th ><?php echo e(translate('translated_value')); ?></th>
                                    <th > <?php echo e(translate('auto_translate')); ?></th>
                                    <th ><?php echo e(translate('update')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php ($count=0); ?>
                                <?php $__currentLoopData = $full_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php ($count++); ?>

                                <tr id="lang-<?php echo e($count); ?>">
                                    <td><?php echo e($count+$full_data->firstItem() -1); ?></td>
                                    <td >
                                        <input type="text" name="key[]"
                                        value="<?php echo e($key); ?>" hidden>
                                        <div style="max-inline-size: 450px"> <?php echo e(translate($key)); ?></div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="value[]"
                                        id="value-<?php echo e($count); ?>"
                                        value="<?php echo e($full_data[$key]); ?>">
                                    </td>
                                    <td >
                                        <button type="button"
                                                data-key="<?php echo e($key); ?>" data-id="<?php echo e($count); ?>"
                                                class="btn btn-ghost-success btn-block auto-translate-btn"><i class="tio-globe"></i>
                                        </button>
                                    </td>
                                    <td >
                                        <button type="button"
                                                data-key="<?php echo e($key); ?>"
                                                data-id="<?php echo e($count); ?>"
                                                class="btn btn--primary btn-block update-language-btn"><i class="tio-save-outlined"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php if(count($full_data) !== 0): ?>
                            <hr>
                            <?php endif; ?>
                            <div class="page-area">
                                <?php echo $full_data->links(); ?>

                            </div>
                            <?php if(count($full_data) === 0): ?>
                            <div class="empty--data">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                                <h5>
                                    <?php echo e(translate('no_data_found')); ?>

                                </h5>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict"
        $(document).on('click', '.update-language-btn', function () {
            let key = $(this).data('key');
            let id = $(this).data('id');
            let value = $('#value-'+id).val() ;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.language.translate-submit',[$lang])); ?>",
                method: 'POST',
                data: {
                    key: key,
                    value: value
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function () {
                    toastr.success('<?php echo e(translate('text_updated_successfully')); ?>');
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });

        $(document).on('click', '.auto-translate-btn', function () {
            let key = $(this).data('key');
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.language.auto-translate',[$lang])); ?>",
                method: 'POST',
                data: {
                    key: key
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    toastr.success('<?php echo e(translate('Key translated successfully')); ?>');
                    $('#value-'+id).val(response.translated_data);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/language/translate.blade.php ENDPATH**/ ?>