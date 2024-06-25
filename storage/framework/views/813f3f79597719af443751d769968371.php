<?php ($data=[]); ?>
<?php
foreach ($restaurant->schedules as $schedule)
{
    $data[$schedule->day][]=['id'=>$schedule->id,'start_time'=>$schedule->opening_time, 'end_time'=>$schedule->closing_time];
}
?>
    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.monday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['1']) && count($data['1'])): ?>
                <?php $__currentLoopData = $data['1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="1" data-day="<?php echo e(translate('messages.monday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.tuesday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['2']) && count($data['2'])): ?>
                <?php $__currentLoopData = $data['2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="2" data-day="<?php echo e(translate('messages.tuesday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.wednesday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['3']) && count($data['3'])): ?>
                <?php $__currentLoopData = $data['3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="3" data-day="<?php echo e(translate('messages.wednesday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.thirsday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['4']) && count($data['4'])): ?>
                <?php $__currentLoopData = $data['4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="4" data-day="<?php echo e(translate('messages.thirsday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.friday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['5']) && count($data['5'])): ?>
                <?php $__currentLoopData = $data['5']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="5" data-day="<?php echo e(translate('messages.friday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.saturday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['6']) && count($data['6'])): ?>
                <?php $__currentLoopData = $data['6']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="6" data-day="<?php echo e(translate('messages.saturday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>

    <div class="schedule-item">
        <span class="btn"><?php echo e(translate('messages.sunday')); ?> :</span>
        <div class="schedult-date-content">
            <?php if(isset($data['0']) && count($data['0'])): ?>
                <?php $__currentLoopData = $data['0']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="d-inline-flex align-items-center">
                        <span class="start--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Opening_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['start_time']))); ?>

                            </span>
                        </span>
                        <span class="end--time">
                            <span class="clock--icon">
                                <i class="tio-time"></i>
                            </span>
                            <span class="info">
                                <span><?php echo e(translate('Closing_Time')); ?></span>
                                <?php echo e(date(config('timeformat'), strtotime($day['end_time']))); ?>

                            </span>
                        </span>
                        <span class="dismiss--date delete-schedule" data-url="<?php echo e(route('vendor.business-settings.remove-schedule',['restaurant_schedule'=>$day['id']])); ?>"><i class="tio-clear-circle-outlined"></i></span></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span class="btn btn-sm btn-outline-danger m-1 disabled"><?php echo e(translate('messages.Offday')); ?></span>
            <?php endif; ?>
            <span class="btn add--primary" data-toggle="modal" data-target="#exampleModal" data-dayid="0" data-day="<?php echo e(translate('messages.sunday')); ?>"><i class="tio-add"></i></span>
        </div>
    </div>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/business-settings/partials/_schedule.blade.php ENDPATH**/ ?>