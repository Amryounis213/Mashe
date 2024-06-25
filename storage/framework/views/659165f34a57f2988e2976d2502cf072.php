<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($key+$orders->firstItem()); ?></td>
    <td class="table-column-pl-0 text-center">
        <a href="<?php echo e(route('admin.order.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
    </td>
    <td class="text-capitalize text-center">
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
        <?php elseif($order['order_status']=='failed'): ?>
            <span class="badge badge-soft-danger mb-1">
                                      <?php echo e(translate('messages.payment_failed')); ?>

                                    </span>
        <?php else: ?>
            <span class="badge badge-soft-danger mb-1">
                                      <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                    </span>
        <?php endif; ?>











    </td>
    <td>
        <div class="text-center">
            <?php echo e(\App\CentralLogics\Helpers::format_currency($order['order_amount'])); ?>

        </div>
    </td>
    <td>
        <div class="btn--container justify-content-center">
        <a class="btn btn-sm btn--warning btn-outline-warning action-btn"
                    href="<?php echo e(route('admin.order.details',['id'=>$order['id']])); ?>" title="<?php echo e(translate('messages.view')); ?>"><i
                            class="tio-visible-outlined"></i></a>
        <a class="btn btn-sm btn--primary btn-outline-primary action-btn" target="_blank"
                    href="<?php echo e(route('admin.order.generate-invoice',[$order['id']])); ?>" title="<?php echo e(translate('messages.invoice')); ?>"><i
                            class="tio-print"></i> </a>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/customer/partials/_list_table.blade.php ENDPATH**/ ?>