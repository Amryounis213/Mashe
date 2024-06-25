<?php $__env->startSection('title',ucfirst(str_replace('_',' ',$status).' '.translate('messages.orders'))); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/orders.png')); ?>" alt="">
                </div>
                <?php echo e(translate('messages.'.$status)); ?> <?php echo e(translate('messages.orders')); ?> <span class="badge badge-soft-dark ml-2"><?php echo e($total); ?></span>
            </h1>
        </div>

        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"></h5>
                    <form method="GET">
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input id="" type="search" name="search" class="form-control"
                                    placeholder="<?php echo e(translate('search_by_order_id')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>" value="<?php echo e(request()->search ?? null); ?>">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                        </div>
                        <!-- End Search -->
                    </form>
                    <div class="d-sm-flex justify-content-sm-end align-items-sm-center">
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:"
                                data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                            </a>

                            <div id="usersExportDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                                <a id="export-excel" class="dropdown-item" href="<?php echo e(route("admin.order.export",['status'=>$status,'type'=>'excel' , request()->getQueryString() ])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.excel')); ?>

                                </a>
                                <a id="export-csv" class="dropdown-item" href="<?php echo e(route("admin.order.export",['status'=>$status,'type'=>'csv' , request()->getQueryString() ])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.csv')); ?>

                                </a>
                            </div>
                        </div>
                        <!-- End Unfold -->
                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white filter-show" href="javascript:">
                                <i class="tio-filter-list mr-1"></i> <?php echo e(translate('messages.filters')); ?> <span class="badge badge-success badge-pill ml-1" id="filter_count"></span>
                            </a>
                        </div>
                        <!-- End Unfold -->
                        <!-- Unfold -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-sm btn-white" href="javascript:"
                                data-hs-unfold-options='{
                                    "target": "#showHideDropdown",
                                    "type": "css-animation"
                                }'>
                                <i class="tio-table mr-1"></i> <?php echo e(translate('messages.columns')); ?>

                            </a>

                            <div id="showHideDropdown"
                                    class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"><?php echo e(translate('messages.order')); ?></span>

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
                                            <span class="mr-2"><?php echo e(translate('messages.restaurant')); ?></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm"
                                                    for="toggleColumn_restaurant">
                                                <input type="checkbox" class="toggle-switch-input"
                                                        id="toggleColumn_restaurant" checked>
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
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom fz--14px">
                <table id="datatable"
                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "paging": false
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="">
                            <?php echo e(translate('messages.sl')); ?>

                        </th>
                        <th class="table-column-pl-0"><?php echo e(translate('messages.order')); ?></th>
                        <th><?php echo e(translate('messages.date')); ?></th>
                        <th class="w-140px"><?php echo e(translate('messages.customer')); ?></th>
                        <th><?php echo e(translate('messages.restaurant')); ?></th>
                        <th><?php echo e(translate('messages.total_amount')); ?></th>
                        <th class="text-center"><?php echo e(translate('messages.order_status')); ?></th>
                        <th class="text-center"><?php echo e(translate('messages.actions')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                            <td class="">
                                <?php echo e($key+$orders->firstItem()); ?>

                            </td>
                            <td class="table-column-pl-0">
                                <a href="<?php echo e(route('admin.order.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                            </td>
                            <td class="text-uppercase">
                                <div>
                                    <?php echo e(Carbon\Carbon::parse($order['created_at'])->locale(app()->getLocale())->translatedFormat('d M Y ')); ?>

                                </div>
                                <div>

                                    <?php echo e(Carbon\Carbon::parse($order['created_at'])->locale(app()->getLocale())->translatedFormat(config('timeformat'))); ?>

                                </div>
                            </td>
                            <td>
                                <?php if($order->is_guest): ?>
                                     <?php
                                        $customer_details = json_decode($order['delivery_address'],true);
                                    ?>
                                    <strong><?php echo e($customer_details['contact_person_name']); ?></strong>
                                    <div><?php echo e($customer_details['contact_person_number']); ?></div>
                                    <?php elseif($order->customer): ?>
                                    <a class="text-body text-capitalize" href="<?php echo e(route('admin.customer.view',[$order['user_id']])); ?>">
                                        <strong><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></strong>
                                        <div><?php echo e($order->customer['phone']); ?></div>
                                    </a>
                                <?php else: ?>
                                    <label class="badge badge-danger"><?php echo e(translate('messages.invalid_customer_data')); ?></label>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($order->restaurant?$order->restaurant->name:'Restaurant deleted!'); ?>

                            </td>
                            <td>
                                <div class="text-right mw-85">
                                    <div>
                                        <?php echo e(\App\CentralLogics\Helpers::format_currency($order['order_amount'])); ?>

                                    </div>
                                    <?php if($order->payment_status=='paid'): ?>
                                        <strong class="text-success"><?php echo e(translate('messages.paid')); ?></strong>
                                    <?php else: ?>
                                        <strong class="text-danger"><?php echo e(translate('messages.unpaid')); ?></strong>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="text-capitalize text-center">
                                <?php if($order['order_status']=='pending'): ?>
                                    <span class="badge badge-soft-info">
                                      <?php echo e(translate('messages.pending')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='confirmed'): ?>
                                    <span class="badge badge-soft-info">
                                      <?php echo e(translate('messages.confirmed')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='processing'): ?>
                                    <span class="badge badge-soft-warning">
                                      <?php echo e(translate('messages.processing')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='picked_up'): ?>
                                    <span class="badge badge-soft-warning">
                                      <?php echo e(translate('messages.out_for_delivery')); ?>

                                    </span>
                                <?php elseif($order['order_status']=='delivered'): ?>
                                    <span class="badge badge-soft-success">
                                      <?php echo e(translate('messages.delivered')); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger">
                                      <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                    </span>
                                <?php endif; ?>

                                <div class="mt-1 opacity-7">
                                    <?php if($order['order_type']=='take_away'): ?>
                                    <span>
                                        <?php echo e(translate('messages.take_away')); ?>

                                    </span>
                                    <?php else: ?>
                                    <span>
                                        <?php echo e(translate('messages.home_delivery')); ?>

                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn-sm btn--warning btn-outline-warning action-btn" href="<?php echo e(route('admin.order.details',['id'=>$order['id']])); ?>"><i class="tio-visible"></i></a>
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn" target="_blank" href="<?php echo e(route('admin.order.generate-invoice',[$order['id']])); ?>"><i class="tio-print"></i></a>
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

            <!-- Start Footer -->
            <div class="card-footer p-0 border-0">
                <!-- Pagination -->
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            <?php echo $orders->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer -->

        </div>
        <!-- End Card -->
        <!-- Order Filter Modal -->
        <div id="datatableFilterSidebar" class="hs-unfold-content_ sidebar sidebar-bordered sidebar-box-shadow initial-hidden">
            <div class="card card-lg sidebar-card sidebar-footer-fixed">
                <div class="card-header">
                    <h4 class="card-header-title"><?php echo e(translate('messages.order_filter')); ?></h4>

                    <!-- Toggle Button -->
                    <a class="js-hs-unfold-invoker_ btn btn-icon btn-xs btn-ghost-dark ml-2 filter-hide" href="javascript:">
                        <i class="tio-clear tio-lg"></i>
                    </a>
                    <!-- End Toggle Button -->
                </div>

                <!-- Body -->
                <form class="card-body sidebar-body sidebar-scrollbar" action="<?php echo e(route('admin.order.filter')); ?>" method="POST" id="order_filter_form">
                    <?php echo csrf_field(); ?>
                    <small class="text-cap mb-3"><?php echo e(translate('messages.zone')); ?></small>

                    <div class="mb-2 initial-36">
                        <select name="zone[]" id="zone_ids" class="form-control js-select2-custom" multiple="multiple">
                        <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($zone->id); ?>" <?php echo e(isset($zone_ids)?(in_array($zone->id, $zone_ids)?'selected':''):''); ?>><?php echo e($zone->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <hr class="my-4">
                    <small class="text-cap mb-3"><?php echo e(translate('messages.restaurant')); ?></small>
                    <div class="mb-2 initial-36">
                        <select name="vendor[]" id="vendor_ids" class="form-control js-select2-custom" multiple="multiple">
                        <?php $__currentLoopData = \App\Models\Restaurant::whereIn('id', $vendor_ids)->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($restaurant->id); ?>" selected ><?php echo e($restaurant->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <hr class="my-4">
                    <?php if($status == 'all'): ?>
                    <small class="text-cap mb-3"><?php echo e(translate('messages.order_status')); ?></small>

                    <!-- Custom Checkbox -->
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus2" name="orderStatus[]" class="custom-control-input" <?php echo e(isset($orderstatus)?(in_array('pending', $orderstatus)?'checked':''):''); ?> value="pending">
                        <label class="custom-control-label" for="orderStatus2"><?php echo e(translate('messages.pending')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus1" name="orderStatus[]" class="custom-control-input" value="confirmed" <?php echo e(isset($orderstatus)?(in_array('confirmed', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus1"><?php echo e(translate('messages.confirmed')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus3" name="orderStatus[]" class="custom-control-input" value="processing" <?php echo e(isset($orderstatus)?(in_array('processing', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus3"><?php echo e(translate('messages.processing')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus4" name="orderStatus[]" class="custom-control-input" value="picked_up" <?php echo e(isset($orderstatus)?(in_array('picked_up', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus4"><?php echo e(translate('messages.out_for_delivery')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus5" name="orderStatus[]" class="custom-control-input" value="delivered" <?php echo e(isset($orderstatus)?(in_array('delivered', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus5"><?php echo e(translate('messages.delivered')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus6" name="orderStatus[]" class="custom-control-input" value="returned" <?php echo e(isset($orderstatus)?(in_array('returned', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus6"><?php echo e(translate('messages.returned')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus7" name="orderStatus[]" class="custom-control-input" value="failed" <?php echo e(isset($orderstatus)?(in_array('failed', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus7"><?php echo e(translate('messages.failed')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus8" name="orderStatus[]" class="custom-control-input" value="canceled" <?php echo e(isset($orderstatus)?(in_array('canceled', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus8"><?php echo e(translate('messages.canceled')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus9" name="orderStatus[]" class="custom-control-input" value="refund_requested" <?php echo e(isset($orderstatus)?(in_array('refund_requested', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus9"><?php echo e(translate('messages.refundRequest')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="orderStatus10" name="orderStatus[]" class="custom-control-input" value="refunded" <?php echo e(isset($orderstatus)?(in_array('refunded', $orderstatus)?'checked':''):''); ?>>
                        <label class="custom-control-label" for="orderStatus10"><?php echo e(translate('messages.refunded')); ?></label>
                    </div>

                    <hr class="my-4">

                    <div class="custom-control custom-radio mb-2">
                        <input type="checkbox" id="scheduled" name="scheduled" class="custom-control-input" value="1" <?php echo e(isset($scheduled)?($scheduled==1?'checked':''):''); ?>>
                        <label class="custom-control-label text-uppercase" for="scheduled"><?php echo e(translate('messages.scheduled')); ?></label>
                    </div>
                    <hr class="my-4">
                    <small class="text-cap mb-3"><?php echo e(translate('messages.order_type')); ?></small>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="take_away" name="order_type" class="custom-control-input" value="take_away" <?php echo e(isset($order_type)?($order_type=='take_away'?'checked':''):''); ?>>
                        <label class="custom-control-label text-uppercase" for="take_away"><?php echo e(translate('messages.take_away')); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="delivery" name="order_type" class="custom-control-input" value="delivery" <?php echo e(isset($order_type)?($order_type=='delivery'?'checked':''):''); ?>>
                        <label class="custom-control-label text-uppercase" for="delivery"><?php echo e(translate('messages.delivery')); ?></label>
                    </div>
                    <hr class="my-4">
                    <?php endif; ?>
                    <small class="text-cap mb-3"><?php echo e(translate('messages.date_between')); ?></small>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <input type="date" name="from_date" class="form-control" id="date_from" value="<?php echo e(isset($from_date)?$from_date:''); ?>">
                            </div>
                        </div>
                        <div class="col-12 text-center"><?php echo e(translate('messages.----to----')); ?></div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="date" name="to_date" class="form-control" id="date_to" value="<?php echo e(isset($to_date)?$to_date:''); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer sidebar-footer">
                        <div class="row gx-2">
                            <div class="col">
                                <button type="reset" class="btn btn-block btn-white" id="reset"><?php echo e(translate('messages.clear_all_filters')); ?></button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-primary"><?php echo e(translate('messages.save')); ?></button>
                            </div>
                        </div>
                    </div>
                    <!-- End Footer -->
                </form>
            </div>
        </div>
        <!-- End Order Filter Modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        <?php
            $filter_count=0;
            if(isset($zone_ids) && count($zone_ids) > 0) $filter_count += 1;
            if(isset($vendor_ids) && count($vendor_ids)>0) $filter_count += 1;
            if($status=='all')
            {
                if(isset($orderstatus) && count($orderstatus) > 0) $filter_count += 1;
                if(isset($scheduled) && $scheduled == 1) $filter_count += 1;
            }

            if(isset($from_date) && isset($to_date)) $filter_count += 1;
            if(isset($order_type)) $filter_count += 1;

        ?>

            <?php if($filter_count>0): ?>
            $('#filter_count').html(<?php echo e($filter_count); ?>);
            <?php endif; ?>

        function filter_zone_orders(id) {
            location.href = '<?php echo e(url('/')); ?>/admin/order/zone-filter/' + id;
        }
        $(document).on('ready', function () {
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });

            let zone_id = [];
            $('#zone_ids').on('change', function(){
                if($(this).val())
                {
                    zone_id = $(this).val();
                }
                else
                {
                    zone_id = [];
                }
            });


            $('#vendor_ids').select2({
                ajax: {
                    url: '<?php echo e(url('/')); ?>/admin/restaurant/get-restaurants',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            zone_ids: zone_id,
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                        results: data
                        };
                    },
                    __port: function (params, success, failure) {
                        let $request = $.ajax(params);

                        $request.then(success);
                        $request.fail(failure);

                        return $request;
                    }
                }
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
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
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



            $('#datatableSearch').on('mouseup', function (e) {
                let $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function () {
                    let newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
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
            $('#toggleColumn_restaurant').change(function (e) {
                datatable.columns(4).visible(e.target.checked)
            })

            $('#toggleColumn_total').change(function (e) {
                datatable.columns(5).visible(e.target.checked)
            })

            $('#toggleColumn_order_status').change(function (e) {
                datatable.columns(6).visible(e.target.checked)
            })

            $('#toggleColumn_actions').change(function (e) {
                datatable.columns(7).visible(e.target.checked)
            })
            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                let tagify = $.HSCore.components.HSTagify.init($(this));
            });

            $("#date_from").on("change", function () {
                $('#date_to').attr('min',$(this).val());
            });

            $("#date_to").on("change", function () {
                $('#date_from').attr('max',$(this).val());
            });
        });

        $('#reset').on('click', function(){
            location.href = '<?php echo e(url('/')); ?>/admin/order/filter/reset';
        });

        $('.filter-hide').on('click', function(){
            $('#datatableFilterSidebar,.hs-unfold-overlay').hide(500);
        });

        $('.filter-show').on('click', function(){
            $('#datatableFilterSidebar,.hs-unfold-overlay').show(500);
        });
    </script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/order/distaptch_list.blade.php ENDPATH**/ ?>