
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')==null?'active':''); ?>"  href="<?php echo e(route('admin.restaurant.view', $restaurant->id)); ?>"><?php echo e(translate('messages.overview')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='order'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'order'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.orders')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='product'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'product'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.foods')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='reviews'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'reviews'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.reviews')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='discount'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'discount'])); ?>"  aria-disabled="true"><?php echo e(translate('discounts')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='transaction'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'transaction'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.transactions')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='settings'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'settings'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.settings')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='conversations'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'conversations'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.conversations')); ?></a>
                </li>
                <?php if($restaurant->restaurant_model != 'none' && $restaurant->restaurant_model != 'commission' ): ?>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab') =='subscriptions' || request('tab') =='subscriptions-transactions' ?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'subscriptions'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.subscription')); ?></a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='meta-data' ?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'meta-data'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.meta-data')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='qr-code' ?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'qr-code'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.QR_code')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php echo e(request('tab')=='disbursements' ?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant'=>$restaurant->id, 'tab'=> 'disbursements'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.disbursements')); ?></a>
                </li>
            </ul>
            <?php if(request('tab') =='subscriptions' || request('tab') =='subscriptions-transactions'): ?>
            <ul class="nav nav-tabs page-header-tabs mb-0 mt-3">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='subscriptions'?'active':''); ?>" href="<?php echo e(route('admin.restaurant.view', ['restaurant' => $restaurant->id, 'tab' => 'subscriptions'])); ?>"><?php echo e(translate('messages.subscription_details')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('tab')=='subscriptions-transactions'?'active':''); ?>"  href="<?php echo e(route('admin.restaurant.view', ['restaurant' => $restaurant->id, 'tab' => 'subscriptions-transactions'])); ?>"><?php echo e(translate('messages.transactions')); ?></a>
                </li>
            </ul>
            <?php endif; ?>
            <!-- End Nav -->
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/vendor/view/partials/_header.blade.php ENDPATH**/ ?>