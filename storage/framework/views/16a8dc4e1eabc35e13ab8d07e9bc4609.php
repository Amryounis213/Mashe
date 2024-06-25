<?php $__env->startSection('title', translate('messages.withdraw_method_list')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <div class="page-title-wrap d-flex justify-content-between flex-wrap align-items-center gap-3 mb-3">
                <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                    <?php echo e(translate('messages.withdraw_method_list')); ?>

                </h2>
                <a href="<?php echo e(route('admin.business-settings.withdraw-method.create')); ?>" class="btn btn--primary">+ <?php echo e(translate('messages.Add_method')); ?></a>
            </div>
        </div>
        <!-- End Page Title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="p-3">
                        <div class="row gy-1 align-items-center justify-content-between">
                            <div class="col-auto">
                                <h5>
                                <?php echo e(translate('messages.methods')); ?>

                                    <span class="badge badge-soft-dark radius-50 fz-12 ml-1"> <?php echo e($withdrawal_methods->total()); ?></span>
                                </h5>
                            </div>
                            <div class="col-auto">
                                <form  class="search-form">
                                    <!-- Search -->
                                    <div class="input-group input--group">
                                        <input id="datatableSearch" name="search" type="search" value="<?php echo e($search); ?>" class="form-control h--40px" placeholder="<?php echo e(translate('messages.Search_Method_Name')); ?>" aria-label="<?php echo e(translate('messages.search_here')); ?>">
                                        <button type="submit" class="btn btn--secondary h--40px"><i class="tio-search"></i></button>
                                    </div>
                                    <!-- End Search -->
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th><?php echo e(translate('messages.sl')); ?></th>
                                <th><?php echo e(translate('messages.method_name')); ?></th>
                                <th><?php echo e(translate('messages.method_fields')); ?></th>
                                <th><?php echo e(translate('messages.active_status')); ?></th>
                                <th ><?php echo e(translate('messages.default_method')); ?></th>
                                <th class="text-center"><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $withdrawal_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$withdrawal_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($withdrawal_methods->firstitem()+$key); ?></td>
                                    <td><?php echo e($withdrawal_method['method_name']); ?></td>


                                    <td>
                                        <?php $__currentLoopData = $withdrawal_method['method_fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$method_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge badge-secondary opacity-75 fz-12 border border-white">
                                                <b><?php echo e(translate('messages.Name')); ?>:</b> <?php echo e(translate($method_field['input_name'])); ?> |
                                                <b><?php echo e(translate('messages.Type')); ?>:</b> <?php echo e(translate($method_field['input_type'])); ?> |
                                                <b><?php echo e(translate('messages.Placeholder')); ?>:</b> <?php echo e($method_field['placeholder']); ?> |
                                                <?php echo e($method_field['is_required'] ? translate('messages.Required') :  translate('messages.Optional')); ?>

                                            </span><br/>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>



                                    <td>
                                        <label class="toggle-switch toggle-switch-sm">
                                            <input class="toggle-switch-input status featured-status"
                                                   data-id="<?php echo e($withdrawal_method->id); ?>"
                                                   type="checkbox" <?php echo e($withdrawal_method->is_active?'checked':''); ?>>
                                                   <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm">
                                            <input type="checkbox" class="default-method toggle-switch-input"
                                            id="<?php echo e($withdrawal_method->id); ?>" <?php echo e($withdrawal_method->is_default == 1?'checked':''); ?>>
                                                   <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                        </label>
                                    </td>



                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a href="<?php echo e(route('admin.business-settings.withdraw-method.edit',[$withdrawal_method->id])); ?>"
                                               class="btn btn-sm btn--primary btn-outline-primary action-btn">
                                                <i class="tio-edit"></i>
                                            </a>

                                            <?php if(!$withdrawal_method->is_default): ?>
                                                <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                                   title="<?php echo e(translate('messages.Delete')); ?>"
                                                   data-id="delete-<?php echo e($withdrawal_method->id); ?>" data-message="<?php echo e(translate('Want to delete this item')); ?>">
                                                    <i class="tio-delete-outlined"></i>
                                                </a>
                                                <form action="<?php echo e(route('admin.business-settings.withdraw-method.delete',[$withdrawal_method->id])); ?>"
                                                      method="post" id="delete-<?php echo e($withdrawal_method->id); ?>">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($withdrawal_methods)==0): ?>
                            <div class="empty--data">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                        <h5>
                            <?php echo e(translate('no_data_found')); ?>

                        </h5>
                            </div>
                       <?php endif; ?>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-center justify-content-md-end">
                            <!-- Pagination -->
                            <?php echo e($withdrawal_methods->links()); ?>

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
      $(document).on('change', '.default-method', function () {
          let id = $(this).attr("id");
          let status = $(this).prop("checked") === true ? 1:0;

          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
          });
          $.ajax({
              url: "<?php echo e(route('admin.business-settings.withdraw-method.default-status-update')); ?>",
              method: 'POST',
              data: {
                  id: id,
                  status: status
              },
              success: function (data) {
                  if(data.success == true) {
                      toastr.success('<?php echo e(translate('messages.Default_Method_updated_successfully')); ?>');
                      setTimeout(function(){
                          location.reload();
                      }, 1000);
                  }
                  else if(data.success == false) {
                      toastr.error('<?php echo e(translate('messages.Default_Method_updated_failed.')); ?>');
                      setTimeout(function(){
                          location.reload();
                      }, 1000);
                  }
              }
          });
      });

      $(document).on('click', '.featured-status', function() {
          let id = $(this).data('id');
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url: "<?php echo e(route('admin.business-settings.withdraw-method.status-update')); ?>",
              method: 'POST',
              data: {
                  id: id
              },
              success: function (data) {
                  toastr.success('<?php echo e(translate('messages.status_updated_successfully')); ?>');
              }
          });
      })
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/withdraw-method/withdraw-methods-list.blade.php ENDPATH**/ ?>