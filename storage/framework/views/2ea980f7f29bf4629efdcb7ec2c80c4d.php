<div id="headerMain" class="d-none">
    <header id="header"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo -->
                <?php ($restaurant_logo=\App\Models\BusinessSetting::where(['key'=>'logo'])->first()?->value); ?>
                <a class="navbar-brand d-none d-md-block" href="<?php echo e(route('admin.dashboard')); ?>" aria-label="">
                         <img class="navbar-brand-logo brand--logo-design-2"
                         src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($restaurant_logo, dynamicStorage('storage/app/public/business/'.$restaurant_logo), dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'business/')); ?>"
                         alt="image">
                         <img class="navbar-brand-logo-mini brand--logo-design-2"
                         src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($restaurant_logo, dynamicStorage('storage/app/public/business/'.$restaurant_logo), dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'business/')); ?>"
                         alt="image">
                </a>
                <!-- End Logo -->
            </div>

            <div class="navbar-nav-wrap-content-left d--xl-none">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                       data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                       data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                       data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
                <!-- End Navbar Vertical Toggle -->
            </div>

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right">
               
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row">
                    <li class="nav-item d-sm-inline-block" style="width: 220px">
                        <div class="form-group mb-0">
                            <select name="country_id" id="country_id" class="form-control h--45px js-select2-custom">
                                <?php if(!isset(auth('admin')->user()->country_id)): ?>
                                    <option value="" <?php echo e(!isset($e->country_id)?'selected':''); ?>><?php echo e(translate('messages.all')); ?></option>
                                <?php endif; ?>
                                <?php ($countries=\App\Models\Country::active()->get(['id','name'])); ?>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country['id']); ?>" <?php if(auth('admin')->user()->country_id == $country['id']): echo 'selected'; endif; ?>><?php echo e($country['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block mr-2">
                        <div class="hs-unfold">
                            <div>
                                <?php ( $local = session()->has('local')?session('local'):null); ?>
                                <?php ($lang = \App\Models\BusinessSetting::where('key', 'system_language')->first()); ?>
                                <?php if($lang): ?>
                                <div
                                    class="topbar-text dropdown disable-autohide text-capitalize d-flex">
                                    <a class=" text-dark dropdown-toggle d-flex align-items-center nav-link "
                                    href="#" data-toggle="dropdown">
                                    <?php $__currentLoopData = json_decode($lang['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($data['code']==$local): ?>
                                            <img class="rounded mr-1"  width="20" src="<?php echo e(dynamicAsset('/public/assets/admin/img/lang.png')); ?>" alt="">
                                            <?php echo e($data['code']); ?>

                                        <?php elseif(!$local &&  $data['default'] == true): ?>
                                                <img class="rounded mr-1"  width="20" src="<?php echo e(dynamicAsset('/public/assets/admin/img/lang.png')); ?>" alt="">
                                                    <?php echo e($data['code']); ?>

                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php $__currentLoopData = json_decode($lang['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($data['status']==1): ?>
                                                <li>
                                                    <a class="dropdown-item py-1"
                                                        href="<?php echo e(route('admin.lang',[$data['code']])); ?>">
                                                        <span class="text-capitalize"><?php echo e($data['code']); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                 
                    <li class="nav-item d-none d-sm-inline-block mr-4">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-soft-secondary rounded-circle"
                                href="<?php echo e(route('admin.message.list')); ?>">
                                <i class="tio-messages-outlined"></i>
                                <?php ($message=\App\Models\Conversation::whereUserType('admin')->where('unread_message_count','>','0')->count()); ?>
                                <?php if($message!=0): ?>
                                    <span class="btn-status btn-sm-status btn-status-danger"></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>

                 
                    <li class="nav-item d-none d-sm-inline-block mr-4">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-soft-secondary rounded-circle"
                                href="<?php echo e(route('admin.order.list',['status'=>'pending'])); ?>">
                                <i class="tio-shopping-cart-outlined"></i>
                                <?php ($count=\App\Models\Order::where('order_status' ,'pending' )->count()); ?>
                                    <?php if($count > 0): ?>
                                    <span class="btn-status btn-status-danger"><?php echo e($count > 9 ? '9+' : $count); ?></span>
                                    <?php endif; ?>
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>
                    <li class="nav-item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                               data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>
                                <div class="cmn--media dropdown-toggle d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-circle">
                                            <img class="avatar-img"
                                            src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(auth('admin')?->user()?->image, dynamicStorage('storage/app/public/admin/'.auth('admin')?->user()?->image), dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'admin/')); ?>"
                                            alt="image">
                                        <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                    </div>
                                    <div class="media-body pl-2">
                                        <span class="card-title h5 text-right">
                                            <?php echo e(auth('admin')->user()->f_name); ?>

                                            <?php echo e(auth('admin')->user()->l_name); ?>

                                        </span>
                                        <span class="card-text"><?php echo e(auth('admin')->user()->email); ?></span>
                                    </div>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account w-16rem">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                            src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(auth('admin')?->user()?->image, dynamicStorage('storage/app/public/admin/'.auth('admin')?->user()?->image), dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'admin/')); ?>"
                                            alt="image">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5"><?php echo e(auth('admin')->user()->f_name); ?>

                                            <?php echo e(auth('admin')->user()->l_name); ?></span>
                                            <span class="card-text"><?php echo e(auth('admin')->user()->email); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="<?php echo e(route('admin.settings')); ?>">
                                    <span class="text-truncate pr-2" title="Settings"><?php echo e(translate('messages.settings')); ?></span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:" onclick="Swal.fire({
                                    title: `<?php echo e(translate('messages.Do_You_Want_To_Sign_Out_?')); ?>`,
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: `#FC6A57`,
                                    cancelButtonColor: `#363636`,
                                    confirmButtonText: `<?php echo e(translate('messages.Yes')); ?>`,
                                    cancelButtonText: `<?php echo e(translate('messages.cancel')); ?>`,
                                    }).then((result) => {
                                    if (result.value) {
                                    location.href=`<?php echo e(route('logout')); ?>`;
                                    } else{
                                    Swal.fire({
                                    title: `<?php echo e(translate('messages.canceled')); ?>`,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonColor: `#FC6A57`,
                                    confirmButtonText: `<?php echo e(translate('messages.ok')); ?>`,
                                    })
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out"><?php echo e(translate('messages.sign_out')); ?></span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
</div>
<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/layouts/admin/partials/_header.blade.php ENDPATH**/ ?>