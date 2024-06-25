<?php $__empty_1 = true; $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
    <td><?php echo e($key+$shifts->firstItem()); ?></td>

    <td>
    <span class="d-block font-size-sm text-body">
        <?php echo e($shift['name']); ?>

    </span>
    </td>
    <td>
        <?php echo e(Carbon\Carbon::parse($shift->start_time)->locale(app()->getLocale())->translatedFormat(config('timeformat'))); ?>

    </td>
    <td>
        <?php echo e(Carbon\Carbon::parse($shift->end_time)->locale(app()->getLocale())->translatedFormat(config('timeformat'))); ?>

    <td>
        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($shift->id); ?>" >
            <input class="toggle-switch-input status_change_alert" type="checkbox"  data-url="<?php echo e(route('admin.shift.status',[$shift['id'],$shift->status?0:1])); ?>" data-message="<?php echo e(translate('Want_to_change_status_for_this_shift?')); ?>"
            id="stocksCheckbox<?php echo e($shift->id); ?>" <?php echo e($shift->status?'checked':''); ?>>
            <span class="toggle-switch-label">
                <span class="toggle-switch-indicator"></span>
            </span>
        </label>

        <form action="<?php echo e(route('admin.shift.status',[$shift['id'],$shift->status?0:1])); ?>" method="get" id="stocksCheckbox-<?php echo e($shift['id']); ?>">
        </form>
    </td>
    <td >
        <div class="btn--container justify-content-center">
            <button
            data-toggle="modal"   data-target="#add_update_shift_<?php echo e($shift->id); ?>" class="btn btn-sm btn--primary btn-outline-primary action-btn edit-shift">
                <i class="tio-edit"></i>
            </button>
            <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
            data-id="shift-<?php echo e($shift['id']); ?>" data-message="<?php echo e(translate('Want_to_delete_this_shift_data._All_of_data_related_to_this_shift_will_be_gone_!!!')); ?>" title="<?php echo e(translate('messages.delete_shift')); ?>">
            <i class="tio-delete-outlined"></i>
            </a>
            <form action="<?php echo e(route('admin.shift.delete',[$shift['id']])); ?>" method="post" id="shift-<?php echo e($shift['id']); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
            </form>
        </div>
    </td>
</tr>





    <!-- Modal -->
    <div class="modal fade" id="add_update_shift_<?php echo e($shift->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('messages.shift_update')); ?>  </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form  action="javascript:" id="system-form-update"   method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('post'); ?>


                    
                    <input type="hidden" name="id" value="<?php echo e($shift->id); ?>" id="id" />

                    <?php ($shift=  \App\Models\Shift::withoutGlobalScope('translate')->with('translations')->find($shift->id)); ?>
                    <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                <?php ($language = $language->value ?? null); ?>
                <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                    <li class="nav-item">
                        <a class="nav-link lang_link add_active active"
                        href="#"
                        id="default-link"><?php echo e(translate('Default')); ?></a>
                    </li>
                    <?php if($language): ?>
                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link lang_link"
                                href="#"
                                id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>


                    <div class="form-group add_active_2  lang_form" id="default-form_<?php echo e($shift->id); ?>">
                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>  (<?php echo e(translate('messages.default')); ?>)</label>
                        <input class="form-control" name='name[]' value="<?php echo e($shift->getRawOriginal('name')); ?>"  type="text">
                        <input type="hidden" name="lang1[]" value="default">
                    </div>
                    <?php if($language): ?>
                    <?php $__empty_2 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <?php
                        if($shift?->translations){
                            $translate = [];
                            foreach($shift?->translations as $t)
                            {
                                if($t->locale == $lang && $t->key=="name"){
                                    $translate[$lang]['name'] = $t->value;
                                }
                            }
                        }

                        ?>
                        <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form_<?php echo e($shift->id); ?>">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(strtoupper($lang)); ?>) </label>
                            <input class="form-control" name='name[]' value="<?php echo e($translate[$lang]['name'] ?? null); ?>"  type="text">
                            <input type="hidden" name="lang1[]" value="<?php echo e($lang); ?>">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        <?php endif; ?>
                        <?php endif; ?>



                    <br>
                    <div class="form-group">
                        <label for="start_time" class="mb-2"><?php echo e(translate('messages.Start_Time')); ?></label>
                        <input type="time"  required   name="start_time" value="<?php echo e($shift->start_time); ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="end_time" class="mb-2"><?php echo e(translate('End_Time')); ?></label>
                        <input type="time" required   name="end_time" value="<?php echo e($shift->end_time); ?>" class="form-control" >
                    </div>
                    <br>

                </div>
                <div class="modal-footer">
                    <button id="reset_btn" type="reset" data-dismiss="modal" class="btn btn-secondary" ><?php echo e(translate('Close')); ?> </button>
                    <button class="btn btn-primary" type="submit"><?php echo e(translate('Submit')); ?></button>
                </form>
            </div>
        </div>
        </div>
    </div>








<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<?php endif; ?>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/shift/partials/_table.blade.php ENDPATH**/ ?>