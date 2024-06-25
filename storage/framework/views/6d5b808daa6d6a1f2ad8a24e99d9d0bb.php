<?php $__env->startSection('title',translate('messages.order_subscriptions')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center __gap-15px">
                <h1 class="page-header-title">
                    <img src="<?php echo e(asset('/public/assets/admin/img/orders.png')); ?>" class="mr-1" alt=""> <?php echo e(translate('messages.subscription_order_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($subscriptions->total()); ?></span>
                </h1>
                <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                    <strong class="mr-2"><?php echo e(translate('See_how_it_works')); ?></strong>
                    <div>
                        <i class="tio-info-outined"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                    <div class="search--button-wrapper">
                        <h5 class="card-title">
                        </h5>
                        <form  class="search-form">
                            <!-- Search -->
                            <div class="input-group input--group">
                                <input id="datatableSearch" name="search" type="search" class="form-control h--40px" placeholder="<?php echo e(translate('Search_by_order_Id')); ?>"  value="<?php echo e(request()->search ?? null); ?>" aria-label="<?php echo e(translate('messages.search_here')); ?>">
                                <button type="submit" class="btn btn--secondary h--40px"><i class="tio-search"></i></button>
                            </div>
                            <!-- End Search -->
                        </form>

                    </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom" id="table-div">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                "order": [],
                                "orderCellsTop": true,

                                "entries": "#datatableEntries",
                                "isResponsive": false,
                                "isShowPaging": false,
                                "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('messages.sl')); ?></th>
                                <th><?php echo e(translate('messages.subscription_ID')); ?></th>
                                <th><?php echo e(translate('messages.order_type')); ?></th>
                                <th><?php echo e(translate('messages.duration')); ?></th>
                                <th><?php echo e(translate('messages.restaurant')); ?></th>
                                <th><?php echo e(translate('messages.customer')); ?></th>
                                <th><?php echo e(translate('messages.status')); ?></th>
                                <th><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$subscriptions->firstItem()); ?></td>
                                    <td>
                                        <?php if(isset($subscription->order)): ?>
                                        <a class="text-body" href="<?php echo e(route('admin.order.subscription.show',[$subscription->id])); ?>"><?php echo e($subscription->order->id); ?></a>
                                        <?php else: ?>
                                        <span> <?php echo e(translate('Order_not_found')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(translate('messages.'.$subscription->type)); ?></td>
                                    <td>
                                        <div><?php echo e(\App\CentralLogics\Helpers::date_format($subscription->start_at)); ?></div>
                                        <div><?php echo e(\App\CentralLogics\Helpers::date_format($subscription->end_at)); ?></div>
                                    </td>
                                    <td>
                                        <?php if($subscription->restaurant): ?>
                                            <a class="text-body text-capitalize" href="<?php echo e(route('admin.restaurant.view',[$subscription['restaurant_id']])); ?>"><?php echo e(Str::limit($subscription->restaurant['name'], 20, '...')); ?></a>
                                        <?php else: ?>
                                            <label class="badge badge-danger"><?php echo e(translate('messages.Restaurant_deleted!')); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($subscription->customer): ?>
                                            <a class="text-body font-semibold text-capitalize" href="<?php echo e(route('admin.customer.view',[$subscription['user_id']])); ?>"><?php echo e($subscription->customer['f_name'].' '.$subscription->customer['l_name']); ?></a>
                                        <?php else: ?>
                                            <label class="badge badge-danger"><?php echo e(translate('messages.invalid_customer_data')); ?></label>
                                        <?php endif; ?>
                                        <div>
                                            <a class="text-body text-capitalize" href="Tel:<?php echo e($subscription->customer['phone']); ?>"><?php echo e($subscription->customer['phone']); ?></a>
                                        </div>
                                    </td>

                                    <td>
                                        <div>

                                            <?php if($subscription->status == 'active'): ?>
                                            <span class="badge badge-soft-success ">
                                                <span class="legend-indicator bg-success"></span><?php echo e(translate('messages.'.$subscription->status)); ?>

                                            </span>
                                            <?php elseif($subscription->status == 'paused'): ?>
                                            <span class="badge badge-soft-primary">
                                                <span class="legend-indicator bg-danger"></span><?php echo e(translate('messages.'.$subscription->status)); ?>

                                            </span>
                                            <?php else: ?>
                                            <span class="badge badge-soft-primary ">
                                                <span class="legend-indicator bg-info"></span><?php echo e(translate('messages.'.$subscription->status)); ?>

                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="fs-12">
                                            <span><?php echo e(translate('messages.Total_Order')); ?> : <?php echo e($subscription->quantity); ?> </span>
                                        </div>
                                        <div class="fs-12">
                                            <span><?php echo e(translate('messages.Delivered')); ?> : <?php echo e($subscription->logs()->whereIn('order_status',['delivered'])->count()); ?> </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn btn-outline-primary dropdown-toggle after-hidden" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="tio-more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?php echo e(route('admin.order.subscription.show',[$subscription->id])); ?>"><?php echo e(translate('messages.subscription_order')); ?></a>
                                                <?php if(isset($subscription->order)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('admin.order.details',['id'=>$subscription->order->id])); ?>"><?php echo e(translate('Ongoing Order')); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if(count($subscriptions) !== 0): ?>
                <hr>
                <?php endif; ?>
                <div class="page-area px-4 pb-3">
                    <?php echo $subscriptions->links(); ?>

                </div>
                <?php if(count($subscriptions) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
            </div>
            <!-- End Table -->
        </div>
    </div>
            <!-- How it Works -->
            <div class="modal fade" id="how-it-works">
                <div class="modal-dialog status-warning-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true" class="tio-clear"></span>
                            </button>
                        </div>
                        <div class="modal-body pb-5 pt-0">
                            <div class="single-item-slider owl-carousel">
                                <div class="item">
                                    <div class="max-349 mx-auto mb-20 text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/landing-how.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Receive_Order')); ?></h5>
                                        <p>
                                            <?php echo e(translate("Receive_and_see_the_requisitions_of_subscription-based_orders_from_customers.")); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="max-349 mx-auto mb-20 text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/page-loader.gif')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Prepare_Food')); ?></h5>
                                        <p>
                                            <?php echo e(translate("As_per_the_order,_prepare_food_for_customers_on_the_requested_date.")); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="max-349 mx-auto mb-20 text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notice-3.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Deliver_Food')); ?></h5>
                                        <p>
                                            <?php echo e(translate('On_the_requested_date,_ensure_home_delivery_or_takeaway_delivery_on_time')); ?>

                                        </p>
                                        <div class="btn-wrap">
                                            <button type="button" data-dismiss="modal" class="btn btn--primary w-100" ><?php echo e(translate('Got_it')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="slide-counter"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script>
    "use strict";
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'), {
                select: {
                    style: 'multi',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                    '<img class="mb-3" src="<?php echo e(dynamicAsset('public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description" style="width: 7rem;">' +
                    '<p class="mb-0">No data to show</p>' +
                    '</div>'
                }
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/order-subscription/index.blade.php ENDPATH**/ ?>