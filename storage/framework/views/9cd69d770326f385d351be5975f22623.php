<!-- Nav -->
        <ul class="nav nav-tabs border-0 nav--tabs nav--pills pt-3">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/header') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.header')); ?>"><?php echo e(translate('messages.Header')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/about-us') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.about_us')); ?>"><?php echo e(translate('messages.about_us')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/feature*') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.features')); ?>"><?php echo e(translate('messages.Features')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/services') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.services')); ?>"><?php echo e(translate('messages.Services')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/earn-money') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.earn_money')); ?>"><?php echo e(translate('messages.Earn_money')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/why-choose-us*') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.why_choose_us')); ?>"><?php echo e(translate('messages.why_choose_us')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/testimonial*') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.testimonial')); ?>"><?php echo e(translate('messages.Testimonials')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/fixed-data*') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.fixed_data')); ?>"><?php echo e(translate('messages.Fixed_data')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/links*') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.links')); ?>"><?php echo e(translate('messages.button_&_links')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('admin/landing-page/backgroung-color') ? 'active' : ''); ?>"
                href="<?php echo e(route('admin.landing_page.backgroung_color')); ?>"><?php echo e(translate('messages.Background_color')); ?></a>
            </li>

        </ul>
        <!-- End Nav -->

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
                                <h5 class="modal-title"><?php echo e(translate('Notice!')); ?></h5>
                                <p>
                                    <?php echo e(translate("If_you_want_to_disable_or_turn_off_any_section_please_leave_that_section_empty_don’t_make_any_changes_there!")); ?>

                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="max-349 mx-auto mb-20 text-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notice-2.png')); ?>" alt="" class="mb-20">
                                <h5 class="modal-title"><?php echo e(translate('If_You_Want_to_Change_Language')); ?></h5>
                                <p>
                                    <?php echo e(translate("Change_the_language_on_tab_bar_and_input_your_data_again!")); ?>

                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="max-349 mx-auto mb-20 text-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notice-3.png')); ?>" alt="" class="mb-20">
                                <h5 class="modal-title"><?php echo e(translate('Let’s_See_The_Changes!')); ?></h5>
                                <p>
                                    <?php echo e(translate('Visit_landing_page_to_see_the_changes_you_made_in_the_settings_option!')); ?>

                                </p>
                                <div class="btn-wrap">
                                    <a href="<?php echo e(url('/')); ?>" type="submit" class="btn btn--primary w-100" ><?php echo e(translate('Visit_Now')); ?></a>
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
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/landing_page/top_menu/admin_landing_menu.blade.php ENDPATH**/ ?>