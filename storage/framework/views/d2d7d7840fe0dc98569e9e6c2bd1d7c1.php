<div class="row">
    <div class="col-lg-12 text-center "><h1 ><?php echo e(translate('Subscriber_List')); ?></h1></div>
    <div class="col-lg-12">



    <table>
        <thead>
        <tr>
            <th><?php echo e(translate('sl')); ?></th>
            <th><?php echo e(translate('email')); ?></th>
            <th><?php echo e(translate('subscribed_at')); ?></th>
        </thead>
        <tbody>
        <?php $__currentLoopData = $data['customers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
        <td><?php echo e($key+1); ?></td>
        <td><?php echo e($customer['email']); ?></td>
        <td><?php echo e(\App\CentralLogics\Helpers::time_date_format($customer->created_at)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    </div>
</div>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/file-exports/subscriber-list.blade.php ENDPATH**/ ?>