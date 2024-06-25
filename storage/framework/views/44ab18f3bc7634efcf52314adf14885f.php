<?php $__env->startSection('title',translate('Review_List')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(translate('messages.food_reviews')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($reviews->total()); ?></span></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">

                <!-- Header -->
                <div class="card-header border-0 py-2">
                    <div class="search--button-wrapper justify-content-end">
                        <form  class="search-form">
                            <!-- Search -->
                            <div class="input-group input--group">
                                <input id="datatableSearch" name="search" value="<?php echo e(request()?->search ?? null); ?>" type="search" class="form-control min-height-45" placeholder="<?php echo e(translate('ex_:_search_item_name')); ?>" aria-label="<?php echo e(translate('messages.search_here')); ?>">
                                <button type="submit" class="btn btn--secondary min-height-45"><i class="tio-search"></i></button>
                            </div>
                            <!-- End Search -->
                        </form>
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:"
                                data-hs-unfold-options='{
                                        "target": "#usersExportDropdown",
                                        "type": "css-animation"
                                    }'>
                                <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                            </a>

                            <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                                <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                                <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.food.reviews_export', ['type' => 'excel', request()->getQueryString()])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                    <?php echo e(translate('messages.excel')); ?>

                                </a>
                                <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.food.reviews_export', ['type' => 'csv', request()->getQueryString()])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                    .<?php echo e(translate('messages.csv')); ?>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Header -->




                    <div class="card-body p-0">
                        <!-- Table -->
                        <div class="table-responsive datatable-custom">
                            <table id="columnSearchDatatable"
                                class="table table-borderless table-thead-bordered table-nowrap card-table"
                                data-hs-datatables-options='{
                                    "order": [],
                                    "orderCellsTop": true,
                                    "paging": false
                                }'>
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('messages.sl')); ?></th>
                                    <th class="w-10p"><?php echo e(translate('messages.food')); ?></th>
                                    <th class="w-20p"><?php echo e(translate('messages.customer')); ?></th>
                                    <th class="w-30p"><?php echo e(translate('messages.review')); ?></th>
                                    <th><?php echo e(translate('messages.date')); ?></th>
                                    <th class="w-30p text-center"><?php echo e(translate('messages.restaurant_reply')); ?></th>
                                    <th><?php echo e(translate('messages.action')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+$reviews->firstItem()); ?></td>

                                        <td class="d-flex">
                                            <?php if($review->food): ?>
                                                <a class="media align-items-center mb-1" href="<?php echo e(route('admin.food.view',[$review->food['id']])); ?>">
                                                    <img class="avatar avatar-lg mr-3 onerror-image"
                                                         src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(
                                                            $review->food['image'] ?? '',
                                                            dynamicStorage('storage/app/public/product').'/'.$review->food['image'] ?? '',
                                                            dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                                                            'product/'
                                                        )); ?>"
                                                         data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"
                                                         alt="<?php echo e($review->food['name']); ?> image">



                                                </a>
                                            <div class="py-2">
                                                <a class="media align-items-center mb-1" href="<?php echo e(route('admin.food.view',[$review->food['id']])); ?>">
                                                    <div class="media-body">
                                                        <h5 class="text-hover-primary mb-0"><?php echo e(Str::limit($review->food['name'],20,'...')); ?></h5>
                                                    </div>
                                                </a>
                                                <a class="mr-5 text-body" href="<?php echo e(route('admin.order.details',['id'=>$review->order_id])); ?>"> <?php echo e(translate('Order_ID')); ?>: <?php echo e($review->order_id); ?></a>
                                            </div>
                                            <?php else: ?>
                                                <?php echo e(translate('messages.Food_deleted!')); ?>

                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if($review->customer): ?>
                                                <a href="<?php echo e(route('admin.customer.view',[$review->user_id])); ?>">
                                                    <?php echo e($review->customer?$review->customer->f_name:""); ?> <?php echo e($review->customer?$review->customer->l_name:""); ?>

                                                </a>
                                                <p>
                                                   <?php echo e($review->customer?$review->customer->phone:""); ?>

                                                </p>
                                            <?php else: ?>
                                                <?php echo e(translate('messages.customer_not_found')); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <label class="rating">
                                                <?php echo e($review->rating); ?> <i class="tio-star m-sm-auto"></i>
                                            </label>
                                            <p class="text-wrap" data-toggle="tooltip" data-placement="left"
                                               data-original-title="<?php echo e($review?->comment); ?>"><?php echo $review->comment?Str::limit($review->comment, 30, '...'):''; ?></p>
                                        </td>
                                        <td class="text-uppercase">
                                            <div>
                                                <?php echo e(\App\CentralLogics\Helpers::date_format($review->created_at)); ?>


                                            </div>
                                            <div>
                                                <?php echo e(\App\CentralLogics\Helpers::time_format($review->created_at)); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-wrap text-center" data-toggle="tooltip" data-placement="top"
                                               data-original-title="<?php echo e($review?->reply); ?>"><?php echo $review->reply?Str::limit($review->reply, 50, '...'): translate('messages.Not_replied_Yet'); ?></p>
                                        </td>
                                        <td>
                                            <label class="toggle-switch toggle-switch-sm" for="reviewCheckbox<?php echo e($review->id); ?>">
                                                <input type="checkbox"
                                                       data-id="status-<?php echo e($review['id']); ?>" data-message="<?php echo e($review->status ? translate('messages.you_want_to_hide_this_review_for_customer') : translate('messages.you_want_to_show_this_review_for_customer')); ?>"
                                                       class="toggle-switch-input status_form_alert" id="reviewCheckbox<?php echo e($review->id); ?>"
                                                        <?php echo e($review->status ? 'checked' : ''); ?>>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <form action="<?php echo e(route('admin.food.reviews.status',[$review['id'],$review->status?0:1])); ?>" method="get" id="status-<?php echo e($review['id']); ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php if(count($reviews) === 0): ?>
                            <div class="empty--data">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                                <h5>
                                    <?php echo e(translate('no_data_found')); ?>

                                </h5>
                            </div>
                            <?php endif; ?>
                            <div class="page-area px-4 pb-3">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div>
                                        <?php echo $reviews->links(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Table -->
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

        });

        $(".status_form_alert").on("click", function (e) {
            const id = $(this).data('id');
            const message = $(this).data('message');
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(translate('messages.Are_you_sure_?')); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('no')); ?>',
                confirmButtonText: '<?php echo e(translate('yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#'+id).submit()
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/product/reviews-list.blade.php ENDPATH**/ ?>