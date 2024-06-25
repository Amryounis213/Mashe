<?php $__env->startSection('title',translate('FCM Settings')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/firebase.png')); ?>" class="w--26" alt="">
                </span>
                <span><?php echo e(translate('messages.firebase_push_notification_setup')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-header card-header-shadow pb-0">
                <div class="d-flex flex-wrap justify-content-between w-100 row-gap-1">
                    <ul class="nav nav-tabs nav--tabs border-0 gap-2">
                        <li class="nav-item mr-2 mr-md-4">
                            <a href="<?php echo e(route('admin.business-settings.fcm-index')); ?>" class="nav-link pb-2 px-0 pb-sm-3 active" data-slide="1">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notify.png')); ?>" alt="">
                                <span><?php echo e(translate('Push Notification')); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.business-settings.fcm-config')); ?>" class="nav-link pb-2 px-0 pb-sm-3" data-slide="2">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/firebase2.png')); ?>" alt="">
                                <span><?php echo e(translate('Firebase Configuration')); ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <div class="tab--content">
                            <div class="item show text--primary-2 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#push-notify-modal">
                                <strong class="mr-2"><?php echo e(translate('Read Documentation')); ?></strong>
                                <div class="blinkings">
                                    <i class="tio-info-outined"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane fade show active"id="push-notify">
                        <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                        <?php ($language = $language->value ?? null); ?>
                        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>

                        <form action="<?php echo e(route('admin.business-settings.update-fcm-messages')); ?>" method="post"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-8 mb-5">
                                    <?php if($language): ?>
                                        <ul class="nav nav-tabs border-0">
                                            <li class="nav-item">
                                                <a class="nav-link lang_link active" href="#" id="default-link"><?php echo e(translate('Default')); ?></a>
                                            </li>
                                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#" id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'); ?></a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <?php endif; ?>
                                </div>
                            </div>

                            <div class="lang_form" id="default-form">
                                <input type="hidden" name="lang[]" value="default">

                                <div class="row" >
                                    <?php ($opm=\App\Models\NotificationMessage::where('key','order_pending_message')->first()); ?>
                                    <?php ($opm=$opm?$opm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_pending_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" >
                                                    <input type="checkbox"
                                                    name="pending_status"
                                                        value="1" id="pending_status" <?php echo e($opm?($opm['status']==1?'checked':''):''); ?>

                                                           data-id="pending_status"
                                                           data-type="toggle"
                                                           data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                           data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                           data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('pending Message')); ?></strong>"
                                                           data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('pending Message')); ?></strong>"
                                                           data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is pending')); ?></p>"
                                                           data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is pending or not')); ?></p>"
                                                           class="toggle-switch-input dynamic-checkbox-toggle"

                                                    >
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="pending_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex : Your order is successfully placed')); ?>"><?php echo e($opm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($ocm=\App\Models\NotificationMessage::where('key','order_confirmation_msg')->first()); ?>
                                        <?php ($ocm=$ocm?$ocm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_confirmation_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="confirm_status">
                                                        <input type="checkbox" name="confirm_status"
                                                        data-id="confirm_status"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('confirmation Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('confirmation Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is confirmed')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is confirmed or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"


                                                            value="1" id="confirm_status" <?php echo e($ocm?($ocm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>

                                                <textarea name="confirm_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Your order is confirmed')); ?>"><?php echo e($ocm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($oprm=\App\Models\NotificationMessage::where('key','order_processing_message')->first()); ?>
                                        <?php ($oprm=$oprm?$oprm:null); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_processing_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="processing_status">
                                                    <input type="checkbox" name="processing_status"
                                                        data-id="processing_status"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('processing Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('processing Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is processing')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is processing or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"


                                                        value="1" id="processing_status" <?php echo e($oprm?($oprm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>

                                                <textarea name="processing_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex : Your order is started for cooking')); ?>"><?php echo e($oprm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($ohm=\App\Models\NotificationMessage::where('key','order_handover_message')->first()); ?>
                                        <?php ($ohm=$ohm?$ohm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.restaurant_handover_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="order_handover_message_status">
                                                    <input type="checkbox" name="order_handover_message_status"


                                                        data-id="order_handover_message_status"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('Order Handover Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('Order Handover Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is handovered')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is handovered or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"



                                                        value="1"
                                                        id="order_handover_message_status" <?php echo e($ohm?($ohm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>

                                                <textarea name="order_handover_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex : Delivery man is on the way')); ?>"><?php echo e($ohm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($ofdm=\App\Models\NotificationMessage::where('key','out_for_delivery_message')->first()); ?>
                                        <?php ($ofdm=$ofdm?$ofdm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_out_for_delivery_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="out_for_delivery">
                                                    <input type="checkbox" name="out_for_delivery_status"
                                                        data-id="out_for_delivery"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('Out For Delivery Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('Out For Delivery Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is out for delivery')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is out for delivery or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"

                                                        value="1" id="out_for_delivery" <?php echo e($ofdm?($ofdm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>

                                                <textarea name="out_for_delivery_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex : Your food is ready for delivery')); ?>"><?php echo e($ofdm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($odm=\App\Models\NotificationMessage::where('key','order_delivered_message')->first()); ?>
                                        <?php ($odm=$odm?$odm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_delivered_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="delivered_status">
                                                    <input type="checkbox" name="delivered_status"
                                                        data-id="delivered_status"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('delivered Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('delivered Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is delivered')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is delivered or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"


                                                        value="1" id="delivered_status" <?php echo e($odm?($odm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="delivered_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex : Your order is delivered')); ?>"><?php echo e($odm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($dbam=\App\Models\NotificationMessage::where('key','delivery_boy_assign_message')->first()); ?>
                                        <?php ($dbam=$dbam?$dbam:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.deliveryman_assign_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="delivery_boy_assign">
                                                    <input type="checkbox" name="delivery_boy_assign_status"
                                                    value="1"
                                                        data-id="delivery_boy_assign"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('Delivery Man Assigned Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('Delivery Man Assigned Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is assigned to delivery man')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is assigned to delivery man or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"


                                                        id="delivery_boy_assign" <?php echo e($dbam?($dbam['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>

                                                <textarea name="delivery_boy_assign_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Your order has been assigned to a delivery man')); ?>"><?php echo e($dbam['message']??''); ?></textarea>
                                            </div>
                                        </div>



                                        <?php ($dbcm=\App\Models\NotificationMessage::where('key','delivery_boy_delivered_message')->first()); ?>
                                        <?php ($dbcm=$dbcm?$dbcm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">

                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.deliveryman_delivered_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="delivery_boy_delivered">
                                                    <input type="checkbox" name="delivery_boy_delivered_status"

                                                        value="1"

                                                        data-id="delivery_boy_delivered"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('Delivery Man Delivered Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('Delivery Man Delivered Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is delivered by delivery man')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is delivered by delivery man or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"


                                                        id="delivery_boy_delivered" <?php echo e($dbcm?($dbcm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>

                                                <textarea name="delivery_boy_delivered_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex : Order delivered successfully')); ?>"><?php echo e($dbcm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($ocam=\App\Models\NotificationMessage::where('key','order_cancled_message')->first()); ?>
                                        <?php ($ocam=$ocam?$ocam:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_canceled_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="order_cancled_message">
                                                    <input type="checkbox" name="order_cancled_message_status"
                                                    value="1"
                                                        data-id="order_cancled_message"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('canceled Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('canceled Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is canceled')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is canceled or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"


                                                        id="order_cancled_message" <?php echo e($ocam?($ocam['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="order_cancled_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('Ex :  Order is canceled by your request')); ?>"><?php echo e($ocam['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($orm=\App\Models\NotificationMessage::where('key','order_refunded_message')->first()); ?>
                                        <?php ($orm=$orm?$orm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">

                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_refunded_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="order_refunded_message">
                                                    <input type="checkbox" name="order_refunded_message_status"
                                                    value="1"



                                                        data-id="order_refunded_message"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('Order Refund Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('Order Refund Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that order is refunded')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that order is refunded or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"



                                                        id="order_refunded_message" <?php echo e($orm?($orm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="order_refunded_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your refund request is successful')); ?>"><?php echo e($orm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($orcm=\App\Models\NotificationMessage::where('key','refund_request_canceled')->first()); ?>
                                        <?php ($orcm=$orcm?$orcm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.order_Refund_cancel_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="refund_request_canceled">
                                                    <input type="checkbox" name="refund_request_canceled_status"
                                                    value="1"

                                                        data-id="refund_request_canceled"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON Order ')); ?> <strong><?php echo e(translate('Refund Request Cancel Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF Order ')); ?> <strong><?php echo e(translate('Refund Request Cancel Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that orders refund request canceled')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that orders refund request canceled or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"



                                                        id="refund_request_canceled" <?php echo e($orcm?($orcm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="refund_request_canceled[]"
                                                        class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your_order_refund_request_is_canceled')); ?>"><?php echo e($orcm['message']??''); ?></textarea>
                                            </div>
                                        </div>


                                        <?php ($ofrcm=\App\Models\NotificationMessage::where('key','offline_order_accept_message')->first()); ?>
                                        <?php ($ofrcm=$ofrcm?$ofrcm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.Offline_order_accept_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="offline_order_accept_message">
                                                    <input type="checkbox" name="offline_order_accept_message_status"
                                                    value="1"
                                                        data-id="offline_order_accept_message"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON')); ?> <strong><?php echo e(translate('Offline_Order_Accept_Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF')); ?> <strong><?php echo e(translate('Offline_Order_Accept_Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that orders has been accepted')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that orders has been accepted or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"
                                                        id="offline_order_accept_message" <?php echo e($ofrcm?($ofrcm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="offline_order_accept_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your_offline_payment_is_accepted')); ?>"><?php echo e($ofrcm['message']??''); ?></textarea>
                                            </div>
                                        </div>

                                        <?php ($ofpdm=\App\Models\NotificationMessage::where('key','offline_order_deny_message')->first()); ?>
                                        <?php ($ofpdm=$ofpdm?$ofpdm:''); ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <div class="d-flex flex-wrap justify-content-between mb-3">
                                                    <span class="d-block text--semititle">
                                                        <?php echo e(translate('messages.Offline_order_deny_message')); ?>

                                                    </span>
                                                    <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex checked" for="offline_order_deny_message">
                                                    <input type="checkbox" name="offline_order_deny_message_status"
                                                    value="1"



                                                        data-id="offline_order_deny_message"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/pending-order-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('By Turning ON')); ?> <strong><?php echo e(translate('Offline_Order_Deny_Message')); ?></strong>"
                                                        data-title-off="<?php echo e(translate('By Turning OFF')); ?> <strong><?php echo e(translate('Offline_Order_Deny_Message')); ?></strong>"
                                                        data-text-on="<p><?php echo e(translate('User will get a clear message to know that Offline Order payment request denied')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('User can not get a clear message to know that Offline Order payment request denied or not')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"

                                                        id="offline_order_deny_message" <?php echo e($ofpdm?($ofpdm['status']==1?'checked':''):''); ?>>
                                                        <span class="toggle-switch-label text">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                        <span class="pl-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('messages.on')); ?></span>
                                                        <span class="pl-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('messages.off')); ?></span>
                                                    </label>
                                                </div>
                                                <textarea name="offline_order_deny_message[]"
                                                        class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your_offline_payment_is_denided')); ?>"><?php echo e($ofpdm['message']??''); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                        
                        <?php if($language): ?>
                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="lang_form d-none" id="<?php echo e($lang); ?>-form">
                            <div class="row" >
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <?php
                                if(isset($opm->translations) && count($opm->translations)){
                                    $translate = [];
                                    foreach($opm->translations as $t)
                                    {
                                        if($t->locale == $lang && $t->key=='order_pending_message'){
                                            $translate[$lang]['message'] = $t->value;
                                        }
                                    }
                                }
                                ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_pending_message')); ?>

                                                </span>

                                            </div>
                                            <textarea name="pending_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Your order is successfully placed')); ?>"><?php echo (isset($translate) && isset($translate[$lang]))?$translate[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($ocm->translations)&&count($ocm->translations)){
                                            $translate_2 = [];
                                            foreach($ocm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='order_confirmation_msg'){
                                                    $translate_2[$lang]['message'] = $t->value;
                                                }
                                            }

                                        }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_confirmation_message')); ?>

                                                </span>
                                            </div>
                                            <textarea name="confirm_message[]"
                                            class="form-control" placeholder="<?php echo e(translate('Ex : Your order is confirmed')); ?>"><?php echo (isset($translate_2) && isset($translate_2[$lang]))?$translate_2[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($oprm->translations) && count($oprm->translations)){
                                            $translate_3 = [];
                                            foreach($oprm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='order_processing_message'){
                                                    $translate_3[$lang]['message'] = $t->value;
                                                }
                                            }
                                        }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_processing_message')); ?>

                                                </span>
                                            </div>

                                            <textarea name="processing_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Your order is started for cooking')); ?>"><?php echo (isset($translate_3) && isset($translate_3[$lang]))?$translate_3[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($ohm->translations) && count($ohm->translations)){
                                            $translate_4 = [];
                                            foreach($ohm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='order_handover_message'){
                                                    $translate_4[$lang]['message'] = $t->value;
                                                }
                                            }

                                            }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.restaurant_handover_message')); ?>

                                                </span>

                                            </div>

                                            <textarea name="order_handover_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Delivery man is on the way')); ?>"><?php echo (isset($translate_4) && isset($translate_4[$lang]))?$translate_4[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($ofdm->translations) && count($ofdm->translations)){
                                            $translate_5 = [];
                                            foreach($ofdm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='out_for_delivery_message'){
                                                    $translate_5[$lang]['message'] = $t->value;
                                                }
                                            }

                                            }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">

                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_out_for_delivery_message')); ?>

                                                </span>
                                            </div>

                                            <textarea name="out_for_delivery_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Your food is ready for delivery')); ?>"><?php echo (isset($translate_5) && isset($translate_5[$lang]))?$translate_5[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                        if(isset($odm->translations)&&count($odm->translations)){
                                                $translate_6 = [];
                                                foreach($odm->translations as $t)
                                                {
                                                    if($t->locale == $lang && $t->key=='order_delivered_message'){
                                                        $translate_6[$lang]['message'] = $t->value;
                                                    }
                                                }

                                                }

                                        ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">

                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_delivered_message')); ?>

                                                </span>

                                            </div>

                                            <textarea name="delivered_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Your order is delivered')); ?>"><?php echo (isset($translate_6) && isset($translate_6[$lang]))?$translate_6[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($dbam->translations) && count($dbam->translations)){
                                            $translate_7 = [];
                                            foreach($dbam->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='delivery_boy_assign_message'){
                                                    $translate_7[$lang]['message'] = $t->value;
                                                }
                                            }

                                            }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.deliveryman_assign_message')); ?>

                                                </span>

                                            </div>

                                            <textarea name="delivery_boy_assign_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Your order has been assigned to a delivery man')); ?>"><?php echo (isset($translate_7) && isset($translate_7[$lang]))?$translate_7[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($dbcm->translations) && count($dbcm->translations)){
                                            $translate_8 = [];
                                            foreach($dbcm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='delivery_boy_delivered_message'){
                                                    $translate_8[$lang]['message'] = $t->value;
                                                }
                                            }

                                            }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">

                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.deliveryman_delivered_message')); ?>

                                                </span>

                                            </div>

                                            <textarea name="delivery_boy_delivered_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex : Order delivered successfully')); ?>"><?php echo (isset($translate_8) && isset($translate_8[$lang]))?$translate_8[$lang]['message']:' '; ?></textarea>
                                                </div></textarea>
                                        </div>

                                    <?php
                                    if(isset($ocam->translations) && count($ocam->translations)){

                                            $translate_9 = [];
                                            foreach($ocam->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='order_cancled_message'){
                                                    $translate_9[$lang]['message'] = $t->value;
                                                }
                                            }

                                            }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">

                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_canceled_message')); ?>

                                                </span>

                                            </div>
                                            <textarea name="order_cancled_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('Ex :  Order is canceled by your request')); ?>"><?php echo (isset($translate_9) && isset($translate_9[$lang]))?$translate_9[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>


                                    <?php
                                    if(isset($orm->translations)&&count($orm->translations)){
                                            $translate_10 = [];
                                            foreach($orm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='order_refunded_message'){
                                                    $translate_10[$lang]['message'] = $t->value;
                                                }
                                            }

                                            }

                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">

                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_refunded_message')); ?>

                                                </span>

                                            </div>
                                            <textarea name="order_refunded_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your refund request is successful')); ?>"><?php echo (isset($translate_10) && isset($translate_10[$lang]))?$translate_10[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($orcm->translations) && count($orcm->translations)){
                                            $translate_11 = [];
                                            foreach($orcm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='refund_request_canceled'){
                                                    $translate_11[$lang]['message'] = $t->value;
                                                }
                                            }
                                            }
                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.order_Refund_cancel_message')); ?>

                                                </span>

                                            </div>
                                            <textarea name="refund_request_canceled[]"
                                                    class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your_order_refund_request_is_canceled')); ?>"><?php echo (isset($translate_11) && isset($translate_11[$lang]))?$translate_11[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>




                                    <?php
                                    if(isset($ofrcm->translations) && count($ofrcm->translations)){
                                            $translate_12 = [];
                                            foreach($ofrcm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='offline_order_accept_message'){
                                                    $translate_12[$lang]['message'] = $t->value;
                                                }
                                            }
                                            }
                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.Offline_order_accept_message')); ?>

                                                </span>

                                            </div>
                                            <textarea name="offline_order_accept_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your_offline_payment_is_accepted')); ?>"><?php echo (isset($translate_12) && isset($translate_12[$lang]))?$translate_12[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($ofpdm->translations) && count($ofpdm->translations)){
                                            $translate_13 = [];
                                            foreach($ofpdm->translations as $t)
                                            {
                                                if($t->locale == $lang && $t->key=='offline_order_deny_message'){
                                                    $translate_13[$lang]['message'] = $t->value;
                                                }
                                            }
                                            }
                                    ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between mb-3">
                                                <span class="d-block text--semititle">
                                                    <?php echo e(translate('messages.Offline_order_deny_message')); ?>

                                                </span>

                                            </div>
                                            <textarea name="offline_order_deny_message[]"
                                                    class="form-control" placeholder="<?php echo e(translate('messages.Ex : Your_offline_payment_is_dened')); ?>"><?php echo (isset($translate_13) && isset($translate_13[$lang]))?$translate_13[$lang]['message']:' '; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                            <div class="btn--container justify-content-end">
                                <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                                <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Firebase Modal -->
        <div class="modal fade" id="push-notify-modal">
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
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/firebase/slide-1.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Go_to_Firebase_Console')); ?></h5>
                                    </div>
                                    <ul>
                                        <li>
                                            <?php echo e(translate('Open_your_web_browser_and_go_to_the_Firebase_Console')); ?>

                                            <a href="#" class="text--underline">
                                                <?php echo e(translate('(https://console.firebase.google.com/)')); ?>

                                            </a>
                                        </li>
                                        <li>
                                            <?php echo e(translate("Select_the_project_for_which_you_want_to_configure_FCM_from_the_Firebase_Console_dashboard.")); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/firebase/slide-2.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Navigate_to_Project_Settings')); ?></h5>
                                    </div>
                                    <ul>
                                        <li>
                                            <?php echo e(translate('In_the_left-hand_menu,_click_on_the_"Settings"_gear_icon,_and_then_select_"Project_settings"_from_the_dropdown.')); ?>

                                        </li>
                                        <li>
                                            <?php echo e(translate('In_the_Project_settings_page,_click_on_the_"Cloud_Messaging"_tab_from_the_top_menu.')); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/firebase/slide-3.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Obtain_All_The_Information_Asked!')); ?></h5>
                                    </div>
                                    <ul>
                                        <li>
                                            <?php echo e(translate('In_the_Firebase_Project_settings_page,_click_on_the_"General"_tab_from_the_top_menu.')); ?>

                                        </li>
                                        <li>
                                            <?php echo e(translate('Under_the_"Your_apps"_section,_click_on_the_"Web"_app_for_which_you_want_to_configure_FCM.')); ?>

                                        </li>
                                        <li>
                                            <?php echo e(translate('Then_Obtain_API_Key,_FCM_Project_ID,_Auth_Domain,_Storage_Bucket,_Messaging_Sender_ID.')); ?>

                                        </li>
                                    </ul>
                                    <p>
                                        <?php echo e(translate('Note:_Please_make_sure_to_use_the_obtained_information_securely_and_in_accordance_with_Firebase_and_FCM_documentation,_terms_of_service,_and_any_applicable_laws_and_regulations.')); ?>

                                    </p>

                                </div>
                            </div>

                            <div class="item">
                                <div class="mb-20">
                                    <div class="text-center">
                                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/email-templates/3.png')); ?>" alt="" class="mb-20">
                                        <h5 class="modal-title"><?php echo e(translate('Write_a_message_in_the_Notification_Body')); ?></h5>
                                    </div>
                                    <p>
                                        <?php echo e(translate('you_can_add_your_message_using_placeholders_to_include_dynamic_content._Here_are_some_examples_of_placeholders_you_can_use:')); ?>

                                    </p>
                                    <ul>
                                        <li>
                                            {userName}: <?php echo e(translate('the_name_of_the_user.')); ?>

                                        </li>
                                        <li>
                                            {restaurantName}: <?php echo e(translate('the_name_of_the_restaurant.')); ?>

                                        </li>
                                        <li>
                                            {orderId}: <?php echo e(translate('the_order_id.')); ?>

                                        </li>
                                    </ul>
                                    <div class="btn-wrap">
                                        <button type="submit" class="btn btn--primary w-100" data-dismiss="modal" data-toggle="modal" data-target="#firebase-modal-2"><?php echo e(translate('Got It')); ?></button>
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
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('script_2'); ?>
<script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/business-settings-fcm.js')); ?>"></script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/fcm-index.blade.php ENDPATH**/ ?>