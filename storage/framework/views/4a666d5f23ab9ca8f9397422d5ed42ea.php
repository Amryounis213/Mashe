<?php ($non_mod = 0); ?>

<?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php ($non_mod = ( ($zone?->minimum_shipping_charge && $zone?->per_km_shipping_charge ) && $non_mod == 0) ? $non_mod:$non_mod+1 ); ?>
<tr>
    <td><?php echo e($key+ $zones?->firstItem()); ?></td>
    <td class="text-center">
        <span class="move-left">
            <?php echo e($zone->id); ?>

        </span>
    </td>
    <td class="pl-5">
        <span class="d-block font-size-sm text-body">
            <?php echo e($zone['name']); ?>

        </span>
    </td>
    <td class="text-center">
        <span class="move-left">
            <?php echo e($zone->restaurants_count); ?>

        </span>
    </td>
    <td class="text-center">
        <span class="move-left">
            <?php echo e($zone->deliverymen_count); ?>

        </span>
    </td>
    <td>
        <label class="toggle-switch toggle-switch-sm" data-toggle="modal" data-target="#status-warning-modal">
            <input type="checkbox" class="toggle-switch-input" id="stocksCheckbox<?php echo e($zone->id); ?>" <?php echo e($zone->status?'checked':''); ?>>
            <span class="toggle-switch-label">
                <span class="toggle-switch-indicator"></span>
            </span>
        </label>
        <form action="<?php echo e(route('admin.zone.status',[$zone['id'],$zone->status?0:1])); ?>" method="get" id="status-<?php echo e($zone['id']); ?>">
        </form>
    </td>
    <td>
        <div class="btn--container justify-content-center">
            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                href="<?php echo e(route('admin.zone.edit',[$zone['id']])); ?>" title="<?php echo e(translate('messages.edit_zone')); ?>"><i class="tio-edit"></i>
            </a>
            <!-- <div class="popover-wrapper active"> add active class to show -->
            <div class="popover-wrapper <?php echo e($non_mod == 1 ? 'active':''); ?>">
                <a class="btn active action-btn btn--warning btn-outline-warning" href="<?php echo e(route('admin.zone.settings',['id'=>$zone['id']])); ?>" title="<?php echo e(translate('messages.zone_settings')); ?>">
                    <i class="tio-settings"></i>
                </a>
                <div class="popover __popover  <?php echo e($non_mod == 1  ? '':'d-none'); ?>">
                    <div class="arrow"></div>
                    <h3 class="popover-header"><?php echo e(translate('Important')); ?></h3>
                    <div class="popover-body">
                        <?php echo e(translate('Must_set_the_delivery_charges_for_this_zone._Other_wise_this_zone_will_not_work_properly')); ?>

                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/zone/partials/_table.blade.php ENDPATH**/ ?>