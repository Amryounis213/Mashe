
<?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php ($user= $conv->sender_type == 'vendor' ? $conv->receiver :  $conv->sender); ?>
<?php if($user): ?>
    <?php ($unchecked=($conv->last_message?->sender_id == $user->id) ? $conv->unread_message_count : 0); ?>
    <div
        class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list <?php echo e($unchecked ? 'conv-active' : ''); ?>"
        onclick="viewConvs('<?php echo e(route('vendor.message.view',['conversation_id'=>$conv->id,'user_id'=>$user->id])); ?>','customer-<?php echo e($user->id); ?>','<?php echo e($conv->id); ?>','<?php echo e($user->id); ?>')"
        id="customer-<?php echo e($user->id); ?>">
        <div class="chat-user-info-img d-none d-md-block">
            <img class="avatar-img onerror-image"
                 data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/160x160/img1.jpg')); ?>"
                 src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($user['image'], dynamicStorage('storage/app/public/profile/').'/'.$user['image'], dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'profile/')); ?>"
                 alt="Image Description">
        </div>
        <div class="chat-user-info-content">
            <h5 class="mb-0 d-flex justify-content-between">
                <span class=" mr-3"><?php echo e($user['f_name'].' '.$user['l_name']); ?></span> <span
                    class="<?php echo e($unchecked ? 'badge badge-info' : ''); ?>"><?php echo e($unchecked ? $unchecked : ''); ?></span>
            </h5>
            <span><?php echo e($user['phone']); ?></span>
        </div>
    </div>
<?php else: ?>
    <div
        class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list">
        <div class="chat-user-info-img d-none d-md-block">
            <img class="avatar-img"
                    src='<?php echo e(dynamicAsset('public/assets/admin')); ?>/img/160x160/img1.jpg'
                    alt="Image Description">
        </div>
        <div class="chat-user-info-content">
            <h5 class="mb-0 d-flex justify-content-between">
                <span class=" mr-3"><?php echo e(translate('messages.user_not_found')); ?></span>
            </h5>
        </div>
    </div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/common.js"></script>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/messages/data.blade.php ENDPATH**/ ?>