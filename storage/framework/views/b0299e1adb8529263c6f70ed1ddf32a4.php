<?php $__env->startSection('title',translate('Customer_Details')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-auto mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(translate('messages.customer_id')); ?> #<?php echo e($customer['id']); ?></h1>
                    <span class="d-block">
                        <i class="tio-date-range"></i> <?php echo e(translate('messages.joined_at')); ?> : <?php echo e(date('d M Y '.config('timeformat'),strtotime($customer['created_at']))); ?>

                    </span>
                </div>

                <div class="col-auto ml-auto">
                    <a class="btn btn-icon btn-sm btn-soft-secondary rounded-circle mr-1"
                       href="<?php echo e(route('admin.customer.view',[$customer['id']-1])); ?>"
                       data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Previous_customer')); ?>">
                        <i class="tio-arrow-backward"></i>
                    </a>
                    <a class="btn btn-icon btn-sm btn-soft-secondary rounded-circle"
                       href="<?php echo e(route('admin.customer.view',[$customer['id']+1])); ?>" data-toggle="tooltip"
                       data-placement="top" title="<?php echo e(translate('Next_customer')); ?>">
                        <i class="tio-arrow-forward"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row mb-2 g-2">
            <!-- Collected Cash Card Example -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="resturant-card bg--2">
                    <img class="resturant-icon" src="<?php echo e(dynamicAsset('/public/assets/admin/img/dashboard/1.png')); ?>" alt="dashboard">
                    <div class="for-card-text font-weight-bold  text-uppercase mb-1"><?php echo e(translate('messages.wallet_balance')); ?></div>
                    <div class="for-card-count"><?php echo e($customer->wallet_balance??0); ?></div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="resturant-card bg--3">
                    <img class="resturant-icon" src="<?php echo e(dynamicAsset('/public/assets/admin/img/dashboard/3.png')); ?>" alt="dashboard">
                    <div class="for-card-text font-weight-bold  text-uppercase mb-1"><?php echo e(translate('messages.loyalty_point_balance')); ?></div>
                    <div class="for-card-count"><?php echo e($customer->loyalty_point??0); ?></div>
                </div>
            </div>
        </div>

        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-title"><?php echo e(translate('messages.Order_List')); ?> <span class="badge badge-soft-secondary" id="itemCount"><?php echo e($orders->total()); ?></span></h5>
                        <div  style="flex-grow:0;" class="search--button-wrapper">


                            <!-- Search -->
                            <form >
                                <input type="hidden" name="id"   value="<?php echo e($customer->id); ?>" id="">
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control" value="<?php echo e(request()->get('search')); ?>"
                                            placeholder="<?php echo e(translate('Ex:_Search_Here_by_ID...')); ?>" aria-label="Search" required>
                                    <button type="submit" class="btn btn--secondary">
                                        <i class="tio-search"></i>
                                    </button>
                                </div>
                            </form>
                                <!-- End Search -->
                                       <!-- Unfold -->
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                            data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                            <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.customer.order-export', ['type'=>'excel','id'=>$customer->id,request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.customer.order-export', ['type'=>'csv','id'=>$customer->id,request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                                .<?php echo e(translate('messages.csv')); ?>

                            </a>
                        </div>
                    </div>
                    <!-- End Unfold -->

                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('messages.sl')); ?></th>
                                    <th class="text-center w-50p"><?php echo e(translate('messages.order_id')); ?></th>
                                    <th class="text-center w-50p"><?php echo e(translate('messages.status')); ?></th>
                                    <th class="w-50p text-center"><?php echo e(translate('messages.total_amount')); ?></th>
                                    <th class="text-center w-100px"><?php echo e(translate('messages.action')); ?></th>
                                </tr>
                            </thead>


                            <tbody id="set-rows">
                                <?php echo $__env->make('admin-views.customer.partials._list_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </tbody>

                        </table>
                        <?php if(count($orders) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                        <!-- Pagination -->
                        <div class="page-area px-4 pb-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="hide-page">
                                    <?php echo $orders->links(); ?>

                                </div>
                            </div>
                        </div>
                        <!-- Pagination -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php if($customer): ?>
                                    <?php echo e($customer['f_name'].' '.$customer['l_name']); ?>

                                    <?php else: ?>
                                    <?php echo e(translate('messages.Customer')); ?>

                                <?php endif; ?>
                            </span>
                        </h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <?php if($customer): ?>
                        <div class="card-body">
                            <div class="media align-items-center customer--information-single" href="javascript:">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img onerror-image" data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/160x160/img1.jpg')); ?>" src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($customer->image, dynamicStorage('storage/app/public/profile/').'/'.$customer->image, dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'profile/')); ?>"
                                         alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <ul class="list-unstyled m-0">
                                        <li class="pb-1">
                                            <i class="tio-email mr-2"></i>
                                            <?php echo e($customer['email']); ?>

                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            <?php echo e($customer['phone']); ?>

                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-shopping-basket-outlined mr-2"></i>
                                            <?php echo e($orders->total()); ?> <?php echo e(translate('messages.orders')); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5><?php echo e(translate('messages.contact_info')); ?></h5>
                            </div>
                            <?php $__currentLoopData = $customer->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul class="list-unstyled list-unstyled-py-2">
                                    <?php if($address['contact_person_umber']): ?>
                                        <li>
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            <?php echo e($address['contact_person_umber']); ?>

                                        </li>
                                    <?php endif; ?>
                                    <li class="quick--address-bar">
                                        <div class="quick-icon badge-soft-secondary">
                                            <i class="tio-home"></i>
                                        </div>
                                        <div class="info">
                                            <h6><?php echo e($address['address_type']); ?></h6>
                                            <a target="_blank" href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo e($address['latitude']); ?>+<?php echo e($address['longitude']); ?>" class="text--title">
                                                <?php echo e($address['address']); ?>

                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                <?php endif; ?>
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        "use strict";
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/customer/customer-view.blade.php ENDPATH**/ ?>