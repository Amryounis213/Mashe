<?php $__env->startSection('title',translate('messages.Order List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pt-0 pb-2">
            <div class="d-flex flex-wrap justify-content-between">
                <h2 class="page-header-title align-items-center text-capitalize py-2 mr-2">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <?php if(str_replace('_',' ',$status) == 'All'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/order.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Pending'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/pending.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Confirmed'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/confirm.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Cooking'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/cooking.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Ready for delivery'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/ready.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Food on the way'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/ready.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Delivered'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/ready.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Refunded'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/order.png')); ?>" alt="public">
                        <?php elseif(str_replace('_',' ',$status) == 'Scheduled'): ?>
                            <img class="mw-24px" src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/order.png')); ?>" alt="public">
                        <?php endif; ?>
                    </div>
                    <span>
                        <?php echo e(str_replace('_',' ',$status)); ?> <?php echo e(translate('messages.orders')); ?> <span class="badge badge-soft-dark ml-2"><?php echo e($orders->total()); ?></span>
                    </span>
                </h2>
            </div>
        </div>
        <!-- End Page Header -->


        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header py-2">
                <div class="search--button-wrapper justify-content-end max-sm-flex-100">
                    <form >
                        <!-- Search -->
                        <div class="input-group input--group">
                            <input id="datatableSearch_" type="search" name="search" class="form-control" value="<?php echo e(request()?->search ?? null); ?>"
                                    placeholder="<?php echo e(translate('Ex : Search by Order Id')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>">
                            <button type="submit" class="btn btn--secondary">
                                <i class="tio-search"></i>
                            </button>
                        </div>
                        <!-- End Search -->
                    </form>

                    <div class="d-sm-flex justify-content-sm-end align-items-sm-center m-0">

                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                            </a>

                            <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header"><?php echo e(translate('messages.options')); ?></span>
                                <a id="export-copy" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/illustrations/copy.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.copy')); ?>

                                </a>
                                <a id="export-print" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/illustrations/print.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.print')); ?>

                                </a>
                                <div class="dropdown-divider"></div>
                                <span
                                    class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                                <a id="export-excel" class="dropdown-item" href="<?php echo e(route("vendor.order.export",['status'=>$st,'type'=>'excel',request()->getQueryString() ])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.excel')); ?>

                                </a>
                                <a id="export-csv" class="dropdown-item" href="<?php echo e(route("vendor.order.export",['status'=>$st,'type'=>'csv',request()->getQueryString() ])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.csv')); ?>

                                </a>
                                <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/pdf.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.pdf')); ?>

                                </a>
                            </div>
                        </div>
                        <!-- End Unfold -->

                        <!-- Unfold -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white" href="javascript:;"
                                data-hs-unfold-options='{
                                    "target": "#showHideDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-table mr-1"></i> <?php echo e(translate('messages.column')); ?> <span
                                    class="badge badge-soft-dark rounded-circle ml-1"></span>
                            </a>

                            <div id="showHideDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2">
                                                <?php echo e(translate('messages.Order_ID')); ?>


                                            </span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_order">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_order" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(translate('messages.date')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_date">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_date" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(translate('messages.customer')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm"
                                                    for="toggleColumn_customer">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_customer" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(translate('messages.total')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_total">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_total" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(translate('messages.order_status')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_order_status">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_order_status" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="mr-2"><?php echo e(translate('messages.actions')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm"
                                                    for="toggleColumn_actions">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_actions" checked>
                                                <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable"
                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="w-60px">
                            <?php echo e(translate('messages.sl')); ?>

                        </th>
                        <th class="w-90px table-column-pl-0"><?php echo e(translate('messages.Order_ID')); ?></th>
                        <th class="w-140px"><?php echo e(translate('messages.order_date')); ?></th>
                        <th class="w-140px"><?php echo e(translate('messages.customer_information')); ?></th>
                        <th class="w-100px"><?php echo e(translate('messages.total_amount')); ?></th>
                        <th class="w-100px text-center"><?php echo e(translate('messages.order_status')); ?></th>
                        <th class="w-100px text-center"><?php echo e(translate('messages.actions')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                            <td class="">
                                <?php echo e($key+$orders->firstItem()); ?>

                            </td>
                            <td class="table-column-pl-0">
                                <a href="<?php echo e(route('vendor.order.details',['id'=>$order['id']])); ?>" class="text-hover"><?php echo e($order['id']); ?></a>
                            </td>
                            <td>
                                <span class="d-block">
                                    <?php echo e(Carbon\Carbon::parse($order['created_at'])->locale(app()->getLocale())->translatedFormat('d M Y')); ?>

                                </span>
                                <span class="d-block text-uppercase">
                                    <?php echo e(Carbon\Carbon::parse($order['created_at'])->locale(app()->getLocale())->translatedFormat(config('timeformat'))); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($order->is_guest): ?>
                                     <?php
                                        $customer_details = json_decode($order['delivery_address'],true);
                                    ?>
                                    <strong><?php echo e($customer_details['contact_person_name']); ?></strong>
                                    <div><?php echo e($customer_details['contact_person_number']); ?></div>
                                <?php elseif($order->customer): ?>
                                    <a class="text-body text-capitalize"
                                        href="<?php echo e(route('vendor.order.details',['id'=>$order['id']])); ?>">
                                        <span class="d-block font-semibold">
                                                <?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?>

                                        </span>
                                        <span class="d-block">
                                                <?php echo e($order->customer['phone']); ?>

                                        </span>
                                    </a>
                                <?php else: ?>
                                    <label
                                        class="badge badge-danger"><?php echo e(translate('messages.invalid_customer_data')); ?></label>
                                <?php endif; ?>
                            </td>
                            <td>


                                <div class="text-right mw-85px">
                                    <div>
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($order['order_amount'])); ?>

                                    </div>
                                    <?php if($order->payment_status=='paid'): ?>
                                    <strong class="text-success">
                                        <?php echo e(translate('messages.paid')); ?>

                                    </strong>
                                    <?php elseif($order->payment_status=='partially_paid'): ?>
                                        <strong class="text-success">
                                            <?php echo e(translate('messages.partially_paid')); ?>

                                        </strong>
                                    <?php else: ?>
                                        <strong class="text-danger">
                                            <?php echo e(translate('messages.unpaid')); ?>

                                        </strong>
                                    <?php endif; ?>
                                </div>

                            </td>
                            <td class="text-capitalize text-center">
                                <?php if(isset($order->subscription)  && $order->subscription->status != 'canceled' ): ?>
                                    <?php
                                        $order->order_status = $order->subscription_log ? $order->subscription_log->order_status : $order->order_status;
                                    ?>
                                <?php endif; ?>
                                    <?php if($order['order_status']=='pending'): ?>
                                        <span class="badge badge-soft-info mb-1">
                                            <?php echo e(translate('messages.pending')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='confirmed'): ?>
                                        <span class="badge badge-soft-info mb-1">
                                        <?php echo e(translate('messages.confirmed')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='processing'): ?>
                                        <span class="badge badge-soft-warning mb-1">
                                        <?php echo e(translate('messages.processing')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='picked_up'): ?>
                                        <span class="badge badge-soft-warning mb-1">
                                        <?php echo e(translate('messages.out_for_delivery')); ?>

                                        </span>
                                    <?php elseif($order['order_status']=='delivered'): ?>
                                        <span class="badge badge-soft-success mb-1">
                                        <?php echo e(translate('messages.delivered')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-danger mb-1">
                                            <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                        </span>
                                    <?php endif; ?>


                                <div class="text-capitalze opacity-7">
                                    <?php if($order['order_type']=='take_away'): ?>
                                        <span>
                                            <?php echo e(translate('messages.take_away')); ?>

                                        </span>
                                        <?php else: ?>
                                        <span>
                                            <?php echo e(translate('messages.delivery')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn action-btn btn--warning btn-outline-warning" href="<?php echo e(route('vendor.order.details',['id'=>$order['id']])); ?>"><i class="tio-visible-outlined"></i></a>
                                    <a class="btn action-btn btn--primary btn-outline-primary" target="_blank" href="<?php echo e(route('vendor.order.generate-invoice',[$order['id']])); ?>"><i class="tio-print"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if(count($orders) === 0): ?>
            <div class="empty--data">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                <h5>
                    <?php echo e(translate('no_data_found')); ?>

                </h5>
            </div>
            <?php endif; ?>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            <?php echo $orders->links(); ?>

                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $(document).on('ready', function () {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3 w-7rem" src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/illustrations/sorry.svg" alt="Image Description">' +
                        '<p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>' +
                        '</div>'
                }
            });

            $('#export-copy').click(function () {
                datatable.button('.buttons-copy').trigger()
            });

            $('#export-excel').click(function () {
                datatable.button('.buttons-excel').trigger()
            });

            $('#export-csv').click(function () {
                datatable.button('.buttons-csv').trigger()
            });

            $('#export-pdf').click(function () {
                datatable.button('.buttons-pdf').trigger()
            });

            $('#export-print').click(function () {
                datatable.button('.buttons-print').trigger()
            });

            $('#toggleColumn_order').change(function (e) {
                datatable.columns(1).visible(e.target.checked)
            })

            $('#toggleColumn_date').change(function (e) {
                datatable.columns(2).visible(e.target.checked)
            })

            $('#toggleColumn_customer').change(function (e) {
                datatable.columns(3).visible(e.target.checked)
            })

            $('#toggleColumn_order_status').change(function (e) {
                datatable.columns(5).visible(e.target.checked)
            })


            $('#toggleColumn_total').change(function (e) {
                datatable.columns(4).visible(e.target.checked)
            })

            $('#toggleColumn_actions').change(function (e) {
                datatable.columns(6).visible(e.target.checked)
            })


            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                let tagify = $.HSCore.components.HSTagify.init($(this));
            });
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/order/list.blade.php ENDPATH**/ ?>