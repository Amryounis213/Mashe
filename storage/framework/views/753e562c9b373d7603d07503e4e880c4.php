<?php $__env->startSection('title', translate('Contact_Messages')); ?>
<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="card mt-2">
        <div class="card-header py-2 border-0">
            <div class="search--button-wrapper">
                <h5 class="card-title"> <?php echo e(translate('messages.Message_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($contacts->total()); ?></span></h5>

                <form id="search-form">
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input type="search" name="search" class="form-control" placeholder="<?php echo e(translate('messages.Ex:_Search_by_name_or_email')); ?>" aria-label="Search contacts" value="<?php echo e(request()?->search ?? null); ?>">
                        <button type="submit" class="btn btn--secondary">
                            <i class="tio-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive datatable-custom">
                <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"  data-hs-datatables-options='{
                    "search": "#datatableSearch",
                    "entries": "#datatableEntries",
                    "isResponsive": false,
                    "isShowPaging": false,
                    "paging":false
                        }'>
                    <thead class="thead-light">
                    <tr>
                        <th style="width: 5%"><?php echo e(translate('sl')); ?></th>
                        <th class="text-center" style="width: 15%"><?php echo e(translate('messages.name')); ?></th>
                        <th class="text-center" style="width: 15%"><?php echo e(translate('messages.email')); ?></th>
                        <th class="text-center" style="width: 50%"><?php echo e(translate('messages.message')); ?></th>
                        <th class="text-center" style="width: 7%"><?php echo e(translate('messages.status')); ?></th>
                        <th class="text-center" style="width: 8%"><?php echo e(translate('messages.action')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="width: 5%"><?php echo e($contacts->firstItem()+$k); ?></td>
                            <td style="width: 15%">
                            <span class="d-block font-size-sm text-body text-center">
                                <?php echo e(Str::limit($contact['name'],20,'...')); ?>

                            </span>
                            </td>
                            <td style="width: 15%">
                                <div class="text-right max-130px">
                                    <?php echo e($contact['email']); ?>

                                </div>
                            </td>
                            <td class="text-center" style="width: 50%;"><?php echo e(Str::limit($contact['message'],120,'...')); ?></td>
                            <td style="width: 7%;">
                                <?php if($contact->seen == 1): ?>
                                <label class="badge badge-success"><?php echo e(translate('Seen')); ?></label>
                            <?php else: ?>
                                <label class="badge badge-primary"><?php echo e(translate('Not_replied_Yet')); ?></label>
                            <?php endif; ?>
                            </td>

                        <td style="width: 8%">
                            <div class="btn--container justify-content-center">
                                <a  title="<?php echo e(translate('View')); ?>"
                                class="btn btn-sm btn--warning btn-outline-warning action-btn" style="cursor: pointer;"
                                href="<?php echo e(route('admin.contact.view',$contact->id)); ?>">
                                <i class="tio-visible"></i>
                            </a>

                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"   href="javascript:"
                                        data-id="contact-<?php echo e($contact['id']); ?>" data-message="<?php echo e(translate('messages.Want_to_delete_this_contact_message_?')); ?>" title="<?php echo e(translate('messages.delete_contact')); ?>"><i class="tio-delete-outlined"></i></a>
                                <form action="<?php echo e(route('admin.contact.delete')); ?>"
                                                method="post" id="contact-<?php echo e($contact['id']); ?>">
                                                <input type="hidden" name="id" value="<?php echo e($contact['id']); ?>">
                                        <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                            </div>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($contacts) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-footer p-0 border-0">
            <!-- Pagination -->
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">

                    <div>
                        <?php echo $contacts->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
            select: {
                style: 'multi',
                classMap: {
                checkAll: '#datatableCheckAll',
                counter: '#datatableCounter',
                counterInfo: '#datatableCounterInfo'
                }
          },
          language: {
            zeroRecords: '<div class="text-center p-4">' +
                '<img class="w-7rem mb-3" src="<?php echo e(dynamicAsset('public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description">' +
                '<p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>' +
                '</div>'
          }
        });

        });

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/contacts/list.blade.php ENDPATH**/ ?>