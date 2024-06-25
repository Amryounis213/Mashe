<?php $__env->startSection('title', translate('messages.Disbursement_settings')); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <h1 class="page-header-title mr-3">
                    <span class="page-header-icon">
                        <img src="<?php echo e(dynamicAsset('public/assets/admin/img/business.png')); ?>" class="w--20" alt="">
                    </span>
                    <span>
                        <?php echo e(translate('messages.business_setup')); ?>

                    </span>
                </h1>
                <div class="d-flex flex-wrap justify-content-end align-items-center flex-grow-1">
                    <div class="blinkings active">
                        <i class="tio-info-outined"></i>
                        <div class="business-notes">
                            <h6><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notes.png')); ?>" alt=""> <?php echo e(translate('Note')); ?></h6>
                            <div>
                                <?php echo e(translate('Don’t_forget_to_click_the_respective_‘Save_Information’_buttons_below_to_save_changes')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('admin-views.business-settings.partials.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php ($disbursement_type = \App\Models\BusinessSetting::where('key', 'disbursement_type')->first()); ?>
        <?php ($disbursement_type = $disbursement_type ? $disbursement_type->value : 'manual'); ?>
        <?php ($restaurant_disbursement_command = \App\Models\BusinessSetting::where('key', 'restaurant_disbursement_command')->first()); ?>
        <?php ($restaurant_disbursement_command = $restaurant_disbursement_command ? $restaurant_disbursement_command->value : ''); ?>
        <?php ($dm_disbursement_command = \App\Models\BusinessSetting::where('key', 'dm_disbursement_command')->first()); ?>
        <?php ($dm_disbursement_command = $dm_disbursement_command ? $dm_disbursement_command->value : ''); ?>
        <!-- Page Header -->

        <!-- End Page Header -->
        <form action="<?php echo e(route('admin.business-settings.update-disbursement')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row g-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <?php if($disbursement_type == 'automated'): ?>
                        <div class="mb-3 text-right">
                            <button type="button" class="btn btn--primary" data-toggle="modal" data-target="#myModal"><?php echo e(translate('messages.Check_Dependencies')); ?></button>
                        </div>
                        <?php endif; ?>
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label text-capitalize d-flex alig-items-center"><span
                                                class="line--limit-1"><?php echo e(translate('Disbursement_Request_Type')); ?></span>
                                            <span class="form-label-secondary"
                                                  data-toggle="tooltip" data-placement="right"
                                                  data-original-title="<?php echo e(translate('Choose_Manual_or_Automated_Disbursement_Requests._In_Automated_mode,_withdrawal_requests_for_disbursement_are_generated_automatically;_in_Manual_mode,_restaurants_need_to_request_withdrawals_manually.')); ?>"><img
                                                    src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                    alt="<?php echo e(translate('messages.Disbursement_Request_Type')); ?>"></span>
                                        </label>
                                        <div class="resturant-type-group border">
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input" type="radio" value="manual"
                                                       name="disbursement_type" id="disbursement_type"
                                                    <?php echo e($disbursement_type == 'manual' ? 'checked' : ''); ?>>
                                                <span class="form-check-label">
                                                    <?php echo e(translate('manual')); ?>

                                                </span>
                                            </label>
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input" type="radio" value="automated"
                                                       name="disbursement_type" id="disbursement_type2"
                                                    <?php echo e($disbursement_type == 'automated' ? 'checked' : ''); ?>>
                                                <span class="form-check-label">
                                                    <?php echo e(translate('automated')); ?>

                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 automated_disbursement_section <?php echo e($disbursement_type == 'manual' ? 'd-none' : ''); ?>">
                                    <?php ($system_php_path = \App\Models\BusinessSetting::where('key', 'system_php_path')->first()); ?>
                                    <?php ($system_php_path = $system_php_path ? $system_php_path->value : ''); ?>
                                    <div class="form-group lang_form default-form">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label text-capitalize m-0">
                                                <?php echo e(translate('System_PHP_Path')); ?>

                                                <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Default_location_where_the_PHP_executable_is_installed_on_server.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                            </label>
                                        </div>
                                        <input type="text" placeholder="<?php echo e(translate('Ex:_/usr/bin/php')); ?>" class="form-control h--45px" min="0" name="system_php_path" value="<?php echo e($system_php_path); ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 automated_disbursement_section <?php echo e($disbursement_type == 'manual' ? 'd-none' : ''); ?> ">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="form-label"><?php echo e(translate('Restaurant_Panel')); ?></label>
                                            <div class="__bg-F8F9FC-card">
                                                <div class="row">
                                                        <?php ($restaurant_disbursement_time_period = \App\Models\BusinessSetting::where('key', 'restaurant_disbursement_time_period')->first()); ?>
                                                        <?php ($restaurant_disbursement_time_period = $restaurant_disbursement_time_period ? $restaurant_disbursement_time_period->value : 1); ?>
                                                    <div class='<?php echo e($restaurant_disbursement_time_period=='weekly'?'col-6':'col-12'); ?>' id="restaurant_time_period_section">
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Create_Disbursements')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Choose_how_the_disbursement_request_will_be_generated:_Monthly,_Weekly_or_Daily.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <select name="restaurant_disbursement_time_period" id="restaurant_disbursement_time_period" class="form-control" required>
                                                                <option value="daily" <?php echo e($restaurant_disbursement_time_period=='daily'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.daily')); ?>

                                                                </option>
                                                                <option value="weekly" <?php echo e($restaurant_disbursement_time_period=='weekly'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.weekly')); ?>

                                                                </option>
                                                                <option value="monthly" <?php echo e($restaurant_disbursement_time_period=='monthly'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.monthly')); ?>

                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='col-6 <?php echo e($restaurant_disbursement_time_period=='weekly'?'':'d-none'); ?>' id="restaurant_week_day_section">
                                                        <?php ($restaurant_disbursement_week_start = \App\Models\BusinessSetting::where('key', 'restaurant_disbursement_week_start')->first()); ?>
                                                        <?php ($restaurant_disbursement_week_start = $restaurant_disbursement_week_start ? $restaurant_disbursement_week_start->value : 'saturday'); ?>
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Week_Start')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Choose_when_the_week_starts_for_the_new_disbursement_request._This_section_will_only_appear_when_weekly_disbursement_is_selected.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <select name="restaurant_disbursement_week_start" id="" class="form-control" required>
                                                                <option value="saturday" <?php echo e($restaurant_disbursement_week_start == 'saturday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.saturday')); ?>

                                                                </option>
                                                                <option value="sunday" <?php echo e($restaurant_disbursement_week_start == 'sunday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.sunday')); ?>

                                                                </option>
                                                                <option value="monday" <?php echo e($restaurant_disbursement_week_start == 'monday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.monday')); ?>

                                                                </option>
                                                                <option value="tuesday" <?php echo e($restaurant_disbursement_week_start == 'tuesday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.tuesday')); ?>

                                                                </option>
                                                                <option value="wednesday" <?php echo e($restaurant_disbursement_week_start == 'wednesday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.wednesday')); ?>

                                                                </option>
                                                                <option value="thursday" <?php echo e($restaurant_disbursement_week_start == 'thursday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.thursday')); ?>

                                                                </option>
                                                                <option value="friday" <?php echo e($restaurant_disbursement_week_start == 'friday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.friday')); ?>

                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='col-6'>
                                                        <?php ($restaurant_disbursement_create_time = \App\Models\BusinessSetting::where('key', 'restaurant_disbursement_create_time')->first()); ?>
                                                        <?php ($restaurant_disbursement_create_time = $restaurant_disbursement_create_time ? $restaurant_disbursement_create_time->value : 1); ?>
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Create_Time')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Define_when_the_new_disbursement_request_will_be_generated_automatically.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <input type="time" placeholder="<?php echo e(translate('Ex:_7')); ?>" class="form-control h--45px" name="restaurant_disbursement_create_time" value="<?php echo e($restaurant_disbursement_create_time); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class='col-6'>
                                                        <?php ($restaurant_disbursement_min_amount = \App\Models\BusinessSetting::where('key', 'restaurant_disbursement_min_amount')->first()); ?>
                                                        <?php ($restaurant_disbursement_min_amount = $restaurant_disbursement_min_amount ? $restaurant_disbursement_min_amount->value : 'saturday'); ?>
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Minimum_Amount')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Enter_the_minimum_amount_to_be_eligible_for_generating_an_auto-disbursement_request.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <input type="number" placeholder="<?php echo e(translate('Ex:_100')); ?>" class="form-control h--45px" min="0" name="restaurant_disbursement_min_amount" value="<?php echo e($restaurant_disbursement_min_amount); ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php ($restaurant_disbursement_waiting_time = \App\Models\BusinessSetting::where('key', 'restaurant_disbursement_waiting_time')->first()); ?>
                                                <?php ($restaurant_disbursement_waiting_time = $restaurant_disbursement_waiting_time ? $restaurant_disbursement_waiting_time->value : ''); ?>
                                                <div class="form-group lang_form default-form">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label text-capitalize m-0">
                                                            <?php echo e(translate('Days_needed_to_complete_disbursement')); ?>

                                                            <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Enter_the_number_of_days_in_which_the_disbursement_will_be_completed.')); ?>">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <input type="number" placeholder="<?php echo e(translate('Ex:_7')); ?>" min="0" class="form-control h--45px" name="restaurant_disbursement_waiting_time" value="<?php echo e($restaurant_disbursement_waiting_time); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <?php ($dm_disbursement_time_period = \App\Models\BusinessSetting::where('key', 'dm_disbursement_time_period')->first()); ?>
                                            <?php ($dm_disbursement_time_period = $dm_disbursement_time_period ? $dm_disbursement_time_period->value : ''); ?>
                                            <label class="form-label"><?php echo e(translate('Delivery_man')); ?></label>
                                            <div class="__bg-F8F9FC-card">
                                                <div class="row">
                                                    <div class='<?php echo e($dm_disbursement_time_period=='weekly'?'col-6':'col-12'); ?>' id="dm_time_period_section">
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Create_Disbursements')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Choose_how_the_disbursement_request_will_be_generated:_Monthly,_Weekly_or_Daily.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <select name="dm_disbursement_time_period" id="dm_disbursement_time_period" class="form-control" required>
                                                                <option value="daily" <?php echo e($dm_disbursement_time_period=='daily'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.daily')); ?>

                                                                </option>
                                                                <option value="weekly" <?php echo e($dm_disbursement_time_period=='weekly'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.weekly')); ?>

                                                                </option>
                                                                <option value="monthly" <?php echo e($dm_disbursement_time_period=='monthly'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.monthly')); ?>

                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                        <?php ($dm_disbursement_week_start = \App\Models\BusinessSetting::where('key', 'dm_disbursement_week_start')->first()); ?>
                                                        <?php ($dm_disbursement_week_start = $dm_disbursement_week_start ? $dm_disbursement_week_start->value : 'saturday'); ?>
                                                    <div class='col-6 <?php echo e($dm_disbursement_time_period=='weekly'?'':'d-none'); ?>' id="dm_week_day_section">
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Week_Start')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Choose_when_the_week_starts_for_the_new_disbursement_request._This_section_will_only_appear_when_weekly_disbursement_is_selected.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <select name="dm_disbursement_week_start" id="" class="form-control" required>
                                                                <option value="saturday" <?php echo e($dm_disbursement_week_start == 'saturday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.saturday')); ?>

                                                                </option>
                                                                <option value="sunday" <?php echo e($dm_disbursement_week_start == 'sunday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.sunday')); ?>

                                                                </option>
                                                                <option value="monday" <?php echo e($dm_disbursement_week_start == 'monday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.monday')); ?>

                                                                </option>
                                                                <option value="tuesday" <?php echo e($dm_disbursement_week_start == 'tuesday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.tuesday')); ?>

                                                                </option>
                                                                <option value="wednesday" <?php echo e($dm_disbursement_week_start == 'wednesday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.wednesday')); ?>

                                                                </option>
                                                                <option value="thursday" <?php echo e($dm_disbursement_week_start == 'thursday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.thursday')); ?>

                                                                </option>
                                                                <option value="friday" <?php echo e($dm_disbursement_week_start == 'friday'?'selected':''); ?>>
                                                                    <?php echo e(translate('messages.friday')); ?>

                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='col-6'>
                                                        <?php ($dm_disbursement_create_time = \App\Models\BusinessSetting::where('key', 'dm_disbursement_create_time')->first()); ?>
                                                        <?php ($dm_disbursement_create_time = $dm_disbursement_create_time ? $dm_disbursement_create_time->value : 1); ?>
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Create_Time')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Define_when_the_new_disbursement_request_will_be_generated_automatically.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <input type="time" placeholder="<?php echo e(translate('Ex:_7')); ?>" class="form-control h--45px" name="dm_disbursement_create_time" value="<?php echo e($dm_disbursement_create_time); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class='col-6'>
                                                        <?php ($dm_disbursement_min_amount = \App\Models\BusinessSetting::where('key', 'dm_disbursement_min_amount')->first()); ?>
                                                        <?php ($dm_disbursement_min_amount = $dm_disbursement_min_amount ? $dm_disbursement_min_amount->value : 'saturday'); ?>
                                                        <div class="form-group lang_form default-form">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <label class="form-label text-capitalize m-0">
                                                                    <?php echo e(translate('Minimum_Amount')); ?>

                                                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Enter_the_minimum_amount_to_be_eligible_for_generating_an_auto-disbursement_request.')); ?>">
                                                                    <i class="tio-info-outined"></i>
                                                                </span>
                                                                </label>
                                                            </div>
                                                            <input type="number" placeholder="<?php echo e(translate('Ex:_100')); ?>" class="form-control h--45px" min="0" name="dm_disbursement_min_amount" value="<?php echo e($dm_disbursement_min_amount); ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php ($dm_disbursement_waiting_time = \App\Models\BusinessSetting::where('key', 'dm_disbursement_waiting_time')->first()); ?>
                                                <?php ($dm_disbursement_waiting_time = $dm_disbursement_waiting_time ? $dm_disbursement_waiting_time->value : ''); ?>
                                                <div class="form-group lang_form default-form">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label text-capitalize m-0">
                                                            <?php echo e(translate('Days_needed_to_complete_disbursement')); ?>

                                                            <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('Enter_the_number_of_days_in_which_the_disbursement_will_be_completed.')); ?>">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <input type="number" min="0" placeholder="<?php echo e(translate('Ex:_7')); ?>" class="form-control h--45px" name="dm_disbursement_waiting_time" value="<?php echo e($dm_disbursement_waiting_time); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn--container justify-content-end">
                                <button type="reset" id="reset_btn" class="btn btn--reset location-reload"><?php echo e(translate('messages.reset')); ?></button>
                                <button type="submit" id="submit" class="btn btn--primary"><?php echo e(translate('messages.save_information')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center"><?php echo e(translate('Cron_Command_for_Disbursement')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <span class="text--base">
                                <?php echo e(translate('In_some_server_configurations,_the_exec_function_in_PHP_may_not_be_enabled,_limiting_your_ability_to_create_cron_jobs_programmatically._A_cron_job_is_a_scheduled_task_that_automates_repetitive_processes_on_your_server._However,_if_the_exec_function_is_disabled,_you_can_manually_set_up_cron_jobs_using_the_following_commands')); ?>:
                            </span>
                        </div>
                        <label class="form-label text-capitalize">
                            <?php echo e(translate('Restaurant_Cron_Command')); ?>

                        </label>
                        <div class="input--group input-group mb-3">
                            <input type="text" value="<?php echo e($restaurant_disbursement_command); ?>" class="form-control" id="restaurantDisbursementCommand" readonly>
                            <button class="btn btn-primary copy-btn restaurantDisbursementCommand"><?php echo e(translate('Copy')); ?></button>
                        </div>
                        <label class="form-label text-capitalize">
                            <?php echo e(translate('Delivery_Man_Cron_Command')); ?>

                        </label>
                        <div class="input--group input-group">
                            <input type="text" value="<?php echo e($dm_disbursement_command); ?>" class="form-control"  id="dmDisbursementCommand" readonly>
                            <button class="btn btn-primary copy-btn dmDisbursementCommand" ><?php echo e(translate('Copy')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script_2'); ?>
<?php ($flag = session('disbursement_exec')); ?>
<script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/business-settings-disbursement.js')); ?>"></script>
    <script>
        "use strict";
        $(document).on('ready', function() {
            <?php if($disbursement_type == 'manual'): ?>
            $('.automated_disbursement_section').hide();
            <?php endif; ?>

            <?php if(isset($flag) && $flag): ?>
                $('#myModal').modal('show');
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/disbursement-index.blade.php ENDPATH**/ ?>