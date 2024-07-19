<?php $__env->startSection('title',translate('messages.delivery_man_incentives')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">

        <div class="card mt-2">

            <!-- Header -->
            <div class="card-header py-2 border-0">
                <h4 class="card-title">
                    <span class="page-header-icon mr-2">
                        <i class="tio-dollar-outlined"></i>
                    </span>
                    <span>
                        <?php echo e(translate('messages.delivery_man_incentives')); ?> <span
                            class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($incentives->total()); ?></span>
                    </span>
                </h4>
                <div class="search--button-wrapper justify-content-end">
                    <form   class="search-form">
                        <div class="input-group input--group">
                            <input id="datatableSearch" name="search" type="search" class="form-control h--40px" value="<?php echo e(request('search')); ?>" placeholder="<?php echo e(translate('ex_:_search_delivery_man_data')); ?>" aria-label="<?php echo e(translate('messages.search_here')); ?>">
                            <button type="submit" class="btn btn--secondary h--40px"><i class="tio-search"></i></button>
                        </div>
                    </form>

                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->
            <div class="card-body p-0">
                <form id="store-incentive-request-form" action="<?php echo e(route('admin.delivery-man.update-incentive')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="table-responsive">
                    <table id="datatable"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <?php if($is_history = !Request::is('admin/delivery-man/incentive-history')): ?>
                                <th class="border-0"></th>
                            <?php endif; ?>
                            <th class="border-0"><?php echo e(translate('sl')); ?></th>
                            <th class="border-0"><?php echo e(translate('messages.DeliveryMan')); ?></th>
                            <th class="border-0"><?php echo e(translate('messages.zone')); ?></th>
                            <th class="border-0"><?php echo e(translate('messages.Total_Earning')); ?></th>
                            <th class="border-0"><?php echo e(translate('messages.incentive')); ?></th>
                            <th class="border-0"><?php echo e(translate('messages.date')); ?></th>
                            <th class="border-0"><?php echo e(translate('messages.status')); ?></th>
                            <?php if($is_history): ?>
                                <th class="text-center border-0"><?php echo e(translate('messages.action')); ?></th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody id="set-rows">
                        <?php $__currentLoopData = $incentives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$incentive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($is_history ): ?>
                                    <td scope="row">
                                        <?php if(now()->startOfDay()->gt(\Carbon\Carbon::parse($incentive->date)) && $incentive->status=='pending' && isset($incentive?->deliveryman)): ?>
                                            <input type="checkbox" class="incentive-transaction" name="incentive_id[]" value="<?php echo e($incentive->id); ?>">
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <td scope="row"><?php echo e($k+$incentives->firstItem()); ?></td>
                                <td>
                                    <?php if(isset($incentive?->deliveryman ) ): ?>
                                    <a href="<?php echo e(route('admin.delivery-man.preview',$incentive->delivery_man_id)); ?>"><?php echo e($incentive?->deliveryman?->f_name.' '.$incentive?->deliveryman?->l_name); ?></a>
                                    <?php else: ?>
                                    <?php echo e(translate('not_found')); ?>

                                    <?php endif; ?>
                                </td>

                                <td><?php echo e($incentive->zone->name); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($incentive->today_earning)); ?></td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($incentive->incentive)); ?></td>
                                <td><?php echo e($incentive->date); ?></td>
                                <td>
                                    <?php if($incentive->status=='pending'): ?>
                                        <label class="badge badge-info"><?php echo e(translate("messages.{$incentive->status}")); ?></label>
                                    <?php elseif($incentive->status=='approved'): ?>
                                        <label class="badge badge-success"><?php echo e(translate("messages.{$incentive->status}")); ?></label>
                                    <?php else: ?>
                                        <label class="badge badge-danger"><?php echo e(translate("messages.{$incentive->status}")); ?></label>
                                    <?php endif; ?>
                                </td>
                                <?php if($is_history): ?>
                                    <td>
                                        <?php if(now()->startOfDay()->gt(\Carbon\Carbon::parse($incentive->date))): ?>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn action-btn btn--danger btn-outline-danger <?php echo e($incentive->status == 'pending' ? 'reject_request':'on_reject_alert'); ?>" href="javascript:"
                                               data-url="<?php echo e(route('admin.delivery-man.incentive',['id'=>$incentive->id,'status'=>'denied'])); ?>" data-message="<?php echo e(translate('Want to reject this request')); ?>" title="<?php echo e(translate('messages.reject')); ?>"><i class="tio-clear-circle-outlined"></i></a>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        </table>
                    </div>
                    <div class="row p-3 justify-content-md-end ">
                        <?php if(count($incentives) > 0 && $is_history): ?>
                        <button type="submit" id="submit-incentive-request" class="col-sm-6 col-md-4 col-lg-3 btn btn--primary" disabled><?php echo e(translate('messages.approve')); ?></button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <?php if(count($incentives) !== 0): ?>
            <hr>
            <?php endif; ?>
            <div class="page-area">
                <?php echo $incentives->links(); ?>

            </div>
            <?php if(count($incentives) === 0): ?>
            <div class="empty--data">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                <h5>
                    <?php echo e(translate('no_data_found')); ?>

                </h5>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $('.on_reject_alert').on('click',function ()
        {
            toastr.error("<?php echo e(translate('messages.only_the_pending_request_can_be_rejected')); ?>", {
                CloseButton: true,
                ProgressBar: true
            });
        })

        $('.incentive-transaction').on('change', function(){
            if($(".incentive-transaction:checked").length>0){
                console.log($(this).length);
                $("#submit-incentive-request").removeAttr('disabled');
            }else{
                $("#submit-incentive-request").attr('disabled', 'disabled');
            }
        })

        $('.reject_request').on('click',function (){
            let action_url = $(this).data('url');
            let message = $(this).data('message');
            reject_request(action_url, message);
        })

        function reject_request(action_url, message) {
            Swal.fire({
                title: '<?php echo e(translate('messages.Are_you_sure?')); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
                confirmButtonText: '<?php echo e(translate('messages.Yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('<form/>', { action: action_url, method: 'POST' }).append(
                        $('<input>', {type: 'hidden', name: '_token', value: '<?php echo e(csrf_token()); ?>'}),
                        $('<input>', {type: 'hidden', name: '_method', value: 'put'}),
                    ).appendTo('body').submit();
                }
            })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/delivery-man/incentive.blade.php ENDPATH**/ ?>