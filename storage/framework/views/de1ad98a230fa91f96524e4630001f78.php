<?php $__env->startSection('title',translate('messages.Vehicle_List')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-car"></i> <?php echo e(translate('messages.vehicles_category_list')); ?> <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($vehicles->total()); ?></span></h1>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn--primary" href="<?php echo e(route('admin.vehicle.create')); ?>">
                        <i class="tio-add"></i> <?php echo e(translate('messages.add_vehicle_category')); ?>

                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <div class="card-header py-2 border-0">
                        <div class="search--button-wrapper">
                            <h5 class="card-title"></h5>
                            <form id="search-form">
                                <!-- Search -->
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch" type="search" value="<?php echo e(request()?->search ?? null); ?>" name="search" class="form-control" placeholder="<?php echo e(translate('Ex:_Search_by_type.')); ?>" aria-label="Search here">
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="font-size-sm table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('messages.sl')); ?></th>
                                <th ><?php echo e(translate('messages.Type')); ?></th>
                                <th ><?php echo e(translate('messages.Starting_coverage_area')); ?> (<?php echo e(translate('messages.km')); ?>) </th>
                                <th ><?php echo e(translate('messages.Maximum_coverage_area')); ?> (<?php echo e(translate('messages.km')); ?>)</th>
                                <th ><?php echo e(translate('messages.Extra_charges')); ?>  (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)</th>
                                <th><?php echo e(translate('messages.status')); ?></th>
                                <th class="text-center"><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$vehicles->firstItem()); ?></td>
                                    <td>
                                        <span class="d-block text-body"><a href="<?php echo e(route('admin.vehicle.view',[$vehicle->id])); ?>"><?php echo e(Str::limit($vehicle['type'],25, '...')); ?></a>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="bg-gradient-light text-dark">
                                            <?php echo e($vehicle->starting_coverage_area); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="bg-gradient-light text-dark">
                                            <?php echo e($vehicle->maximum_coverage_area); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="bg-gradient-light text-dark">
                                         <?php echo e(\App\CentralLogics\Helpers::format_currency($vehicle->extra_charges)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($vehicle->id); ?>">
                                            <input type="checkbox" data-url="<?php echo e(route('admin.vehicle.status',[$vehicle['id'],$vehicle->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="stocksCheckbox<?php echo e($vehicle->id); ?>" <?php echo e($vehicle->status?'checked':''); ?>>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                href="<?php echo e(route('admin.vehicle.edit',[$vehicle['id']])); ?>" title="<?php echo e(translate('messages.edit_vehicle')); ?>"><i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                                data-id="vehicle-<?php echo e($vehicle['id']); ?>" data-message="<?php echo e(translate('messages.Want_to_delete_this_item')); ?>" title="<?php echo e(translate('messages.delete_vehicle')); ?>"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.vehicle.delete',['vehicle' =>$vehicle['id']])); ?>"
                                                        method="post" id="vehicle-<?php echo e($vehicle['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($vehicles) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                        <div class="page-area px-4 pb-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div>
                                    <?php echo $vehicles->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
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
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('change', function () {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function () {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });



        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/vehicle/list.blade.php ENDPATH**/ ?>