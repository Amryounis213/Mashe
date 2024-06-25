<div class="d-flex flex-wrap justify-content-between align-items-center mb-5 mt-4 __gap-12px">
    <div class="js-nav-scroller hs-nav-scroller-horizontal mt-2">
        <!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills">
            <li class="nav-item">
                <a class="nav-link  <?php echo e(Request::is('admin/business-settings/business-setup') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup')); ?>"   aria-disabled="true"><?php echo e(translate('messages.business_settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/priority') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'priority'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.priority_setup')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/order') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'order'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.orders')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/refund/settings') ?'active':''); ?>" href="<?php echo e(route('admin.refund.refund_settings')); ?>"  aria-disabled="true"><?php echo e(translate('messages.refund_settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/restaurant') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'restaurant'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.restaurant')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/deliveryman') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'deliveryman'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.delivery_man')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/customer') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'customer'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.customers')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/language*') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.language.index')); ?>"><?php echo e(translate('messages.Language')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/landing-page') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'landing-page'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.landing_page')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/business-settings/business-setup/disbursement') ?'active':''); ?>" href="<?php echo e(route('admin.business-settings.business-setup',  ['tab' => 'disbursement'])); ?>"  aria-disabled="true"><?php echo e(translate('messages.disbursement')); ?></a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
</div>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/partials/nav-menu.blade.php ENDPATH**/ ?>