<?php ($params = session('dash_params')); ?>
<?php if($params['zone_id'] != 'all'): ?>
    <?php ($zone_name = \App\Models\Zone::where('id', $params['zone_id'])->first()->name); ?>
<?php else: ?>
<?php ($zone_name=translate('All')); ?>
<?php endif; ?>
<div class="chartjs-custom mx-auto">
    <div data-id="#user-overview" data-value="<?php echo e($data['customer'].','. $data['restaurants'].','. $data['delivery_man']); ?>"
    data-labels="<?php echo e(translate('messages.Customer')); ?>, <?php echo e(translate('messages.Restaurant')); ?>,<?php echo e(translate('messages.Delivery_man')); ?>"    id="user-overview"></div>
</div>

<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/partials/_user-overview-chart.blade.php ENDPATH**/ ?>