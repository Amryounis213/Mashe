<?php use App\CentralLogics\Helpers;use App\Models\BusinessSetting;use App\Models\RefundReason; ?>


<?php $__env->startSection('title', translate('Refund_Settings')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
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
                            <h6><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notes.png')); ?>" alt=""> <?php echo e(translate('Note')); ?>

                            </h6>
                            <div>
                                <?php echo e(translate('Click_on_the_Add_Now_button_to_add_a_refund_reason_to_the_list')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('admin-views.business-settings.partials.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <form action="<?php echo e(route('admin.refund.refund_mode')); ?>" id="refund_mode_form" method="get"></form>
                    <div class="card-body mb-3">
                        <div
                            class="maintainance-mode-toggle-bar d-flex flex-wrap justify-content-between border blue-border rounded align-items-center">
                            <?php ($config = $refund_active_status?->value); ?>
                            <h5 class="card-title text-capitalize mr-3 m-0 text--primary">
                                <span class="card-header-icon">
                                    <i class="tio-settings-outlined"></i>
                                </span>
                                <span>
                                    <?php echo e(translate('messages.Refund_Request_Mode')); ?>

                                </span>
                            </h5>
                            <label class="switch m-0">
                                <input type="checkbox" class="status dynamic-checkbox" id="refund_mode"
                                       data-id="refund_mode"
                                       data-type="status"
                                       data-image-on='<?php echo e(dynamicAsset('/public/assets/admin/img/modal')); ?>/mail-success.png'
                                       data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal')); ?>/mail-warning.png"
                                       data-title-on="<?php echo e(translate('Important!')); ?>"
                                       data-title-off="<?php echo e(translate('Warning!')); ?>"
                                       data-text-on="<p><?php echo e(translate('By_turning_on_refund_request_mode,_customer_can_place_refund_requests.')); ?></p>"
                                       data-text-off="<p><?php echo e(translate('By_turning_off_refund_request_mode,_customer_can_not_place_refund_requests')); ?></p>"
                                    <?php echo e(isset($config) && $config ? 'checked' : ''); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <p class="mt-2 mb-0">
                            <?php echo e(translate('*_Customers_cannot_request_a_Refund_if_the_Admin_does_not_specify_a_cause_for_Refund._So_Admin_MUST_provide_a_proper_Refund_Reason.')); ?>

                        </p>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-lg-12 pt-sm-3">
            <div class="report-card-inner mb-4 pt-3 mw-100">
                <form action="<?php echo e(route('admin.refund.refund_reason')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-md-0 mb-3">
                        <div class="mx-1">
                            <h5 class="form-label mb-0">
                                <?php echo e(translate('messages.Add_a_Refund_Reason')); ?>

                            </h5>
                        </div>
                    </div>
                    <?php ($language=BusinessSetting::where('key','language')->first()); ?>
                    <?php ($language = $language->value ?? null); ?>
                    <?php if($language): ?>
                        <ul class="nav  nav--tabs ml-3 mt-3 mb-3  w-100 ">
                            <li class="nav-item">
                                <a class="nav-link lang_link1 active"
                                   href="#"
                                   id="default-link1"><?php echo e(translate('Default')); ?></a>
                            </li>
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link1"
                                       href="#"
                                       id="<?php echo e($lang); ?>-link1"><?php echo e(Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <div class="row align-items-end">


                        <div class="col-md-10 lang_form1 default-form1">
                            <label for="reason" class="form-label"><?php echo e(translate('Reason')); ?> (<?php echo e(translate('Default')); ?>

                                )</label>
                            <input id="reason" type="text" class="form-control h--45px" name="reason[]"
                                   maxlength="191" placeholder="<?php echo e(translate('Ex:_Item_is_Broken')); ?>">
                            <input type="hidden" name="lang[]" value="default">
                        </div>

                        <?php if($language): ?>
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-10 d-none lang_form1" id="<?php echo e($lang); ?>-form1">
                                    <label for="reason<?php echo e($lang); ?>" class="form-label"><?php echo e(translate('Reason')); ?>

                                        (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <input id="reason<?php echo e($lang); ?>" type="text" class="form-control h--45px" name="reason[]"
                                           maxlength="191" placeholder="<?php echo e(translate('Ex:_Item_is_Broken')); ?>">
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>


                        <div class="col-md-auto">
                            <button type="submit"
                                    class="btn btn--primary h--45px btn-block"><?php echo e(translate('messages.Add Now')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body mb-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-md-0 mb-3">
                    <div class="mx-1">
                        <h5 class="form-label mb-5">
                            <?php echo e(translate('Refund_Reason_List_Section')); ?>

                        </h5>
                    </div>
                </div>


                <!-- Table -->
                <div class="card-body p-0">
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-align-middle"
                               data-hs-datatables-options='{
                        "isResponsive": false,
                        "isShowPaging": false,
                        "paging":false,
                    }'>
                            <thead class="thead-light">
                            <tr>
                                <th class="border-0"><?php echo e(translate('messages.sl')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.Reason')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.status')); ?></th>
                                <th class="border-0 text-center"><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="table-div">
                            <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$reasons->firstItem()); ?></td>

                                    <td>
                                <span class="d-block font-size-sm text-body">
                                    <?php echo e(Str::limit($reason->reason, 25,'...')); ?>

                                </span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm"
                                               for="stocksCheckbox<?php echo e($reason->id); ?>">
                                            <input type="checkbox"
                                                   data-url="<?php echo e(route('admin.refund.reason_status',[$reason['id'],$reason->status?0:1])); ?>"
                                                   class="toggle-switch-input redirect-url"
                                                   id="stocksCheckbox<?php echo e($reason->id); ?>" <?php echo e($reason->status?'checked':''); ?>>
                                            <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                        </label>
                                    </td>

                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-reason"
                                               title="<?php echo e(translate('messages.edit')); ?>"
                                               data-toggle="modal" data-target="#add_update_reason_<?php echo e($reason->id); ?>"
                                            ><i class="tio-edit"></i>
                                            </a>

                                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                               href="javascript:"
                                               data-id="refund_reason-<?php echo e($reason['id']); ?>"
                                               data-message="<?php echo e(translate('Want to delete this refund reason ?')); ?>"

                                               title="<?php echo e(translate('messages.delete')); ?>">
                                                <i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.refund.reason_delete',[$reason['id']])); ?>"
                                                  method="post" id="refund_reason-<?php echo e($reason['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="add_update_reason_<?php echo e($reason->id); ?>" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="exampleModalLabel"><?php echo e(translate('messages.Refund_Reason_Update')); ?></label></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo e(route('admin.refund.reason_edit')); ?>" method="post">
                                                <div class="modal-body">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('put'); ?>

                                                    <?php ($reason=  RefundReason::withoutGlobalScope('translate')->with('translations')->find($reason->id)); ?>
                                                    <?php ($language=BusinessSetting::where('key','language')->first()); ?>
                                                    <?php ($language = $language->value ?? null); ?>
                                                    <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                                        <li class="nav-item">
                                                            <a class="nav-link update-lang_link add_active active"
                                                               href="#"

                                                               id="default-link"><?php echo e(translate('Default')); ?></a>
                                                        </li>
                                                        <?php if($language): ?>
                                                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link update-lang_link"
                                                                       href="#"
                                                                       data-reason-id="<?php echo e($reason->id); ?>"
                                                                       id="<?php echo e($lang); ?>-link"><?php echo e(Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <input type="hidden" name="reason_id" value="<?php echo e($reason->id); ?>"/>

                                                    <div class="form-group mb-3 add_active_2  update-lang_form"
                                                         id="default-form_<?php echo e($reason->id); ?>">
                                                        <label for="reason" class="form-label"><?php echo e(translate('Reason')); ?>

                                                            (<?php echo e(translate('messages.default')); ?>) </label>
                                                        <input id="reason" class="form-control" name='reason[]'
                                                               value="<?php echo e($reason?->getRawOriginal('reason')); ?>"
                                                               type="text">
                                                        <input type="hidden" name="lang1[]" value="default">
                                                    </div>
                                                    <?php if($language): ?>
                                                        <?php $__empty_1 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                <?php
                                                                if ($reason?->translations) {
                                                                    $translate = [];
                                                                    foreach ($reason?->translations as $t) {
                                                                        if ($t->locale == $lang && $t->key == "reason") {
                                                                            $translate[$lang]['reason'] = $t->value;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            <div class="form-group mb-3 d-none update-lang_form"
                                                                 id="<?php echo e($lang); ?>-langform_<?php echo e($reason->id); ?>">
                                                                <label for="reason<?php echo e($lang); ?>"
                                                                       class="form-label"><?php echo e(translate('Reason')); ?>

                                                                    (<?php echo e(strtoupper($lang)); ?>)</label>
                                                                <input id="reason<?php echo e($lang); ?>" class="form-control"
                                                                       name='reason[]'
                                                                       value="<?php echo e($translate[$lang]['reason'] ?? null); ?>"
                                                                       type="text">
                                                                <input type="hidden" name="lang1[]" value="<?php echo e($lang); ?>">
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal"><?php echo e(translate('Close')); ?></button>
                                                    <button type="submit"
                                                            class="btn btn-primary"><?php echo e(translate('Save_changes')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($reasons) === 0): ?>
                            <div class="empty--data">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                                <h5>
                                    <?php echo e(translate('no_data_found')); ?>

                                </h5>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="page-area px-4 pb-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div>
                                    <?php echo $reasons->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/business-settings-refund-page.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/refund/index.blade.php ENDPATH**/ ?>