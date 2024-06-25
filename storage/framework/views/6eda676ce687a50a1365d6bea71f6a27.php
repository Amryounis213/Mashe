<?php $__env->startSection('title', translate('messages.New_joining_deliverymen')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/delivery-man.png')); ?>" alt="public">
                        </div>
                        <span>
                            <?php echo e(translate('messages.New_joining_request')); ?>

                        </span>
                    </h1>
                </div>
            </div>
        </div>

        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active"
                        href="<?php echo e(route('admin.delivery-man.pending')); ?>"><?php echo e(translate('messages.Pending_delivery_man')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        aria-disabled="true"href="<?php echo e(route('admin.delivery-man.denied')); ?>"><?php echo e(translate('messages.denied_deliveryman')); ?></a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header py-2">
                        <div class="search--button-wrapper">
                            <h5 class="card-title"><?php echo e(translate('messages.deliveryman')); ?><span
                                    class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($delivery_men->total()); ?></span>
                            </h5>
                            <form>
                                <!-- Search -->
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="<?php echo e(translate('Search_by_name')); ?>" aria-label="Search">
                                    <button type="submit" class="btn btn--secondary">
                                        <i class="tio-search"></i>
                                    </button>
                                </div>
                                <!-- End Search -->
                            </form>

                            <div class="hs-unfold ">
                                <div class="select-item">
                                    <select name="zone_id" class="form-control js-select2-custom set-filter"
                                            data-url="<?php echo e(url()->full()); ?>" data-filter="zone_id">

                                        <option value="all"><?php echo e(translate('messages.all_zones')); ?></option>
                                        <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($z['id']); ?>"
                                                <?php echo e(isset($zone) && $zone->id == $z['id'] ? 'selected' : ''); ?>>
                                                <?php echo e($z['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hs-unfold ">
                                <div class="select-item">
                                    <select name="vehicle_id" class="form-control js-select2-custom set-filter"
                                            data-url="<?php echo e(url()->full()); ?>" data-filter="vehicle_id">

                                        <option value="all"><?php echo e(translate('messages.all_vehicles')); ?></option>
                                        <?php $__currentLoopData = \App\Models\Vehicle::orderBy('type')->get(['id','type']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($v['id']); ?>"
                                                <?php echo e(request()?->vehicle_id  == $v['id'] ? 'selected' : ''); ?>>
                                                <?php echo e($v['type']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hs-unfold ">
                                <div class="select-item">
                                    <select name="job_type" class="form-control js-select2-custom set-filter"
                                            data-url="<?php echo e(url()->full()); ?>" data-filter="job_type">
                                        <option  value="all"><?php echo e(translate('messages.all_job')); ?></option>
                                        <option <?php echo e(request()?->job_type ==  'salary_base' ? 'selected' : ''); ?>  value="salary_base"><?php echo e(translate('messages.Salary_Base')); ?></option>
                                        <option <?php echo e(request()?->job_type == 'freelance' ? 'selected' : ''); ?> value="freelance"><?php echo e(translate('messages.Freelance')); ?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom fz--14px">
                        <table id="columnSearchDatatable"
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                            data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-capitalize"><?php echo e(translate('messages.sl')); ?></th>
                                    <th class="text-capitalize w-20p"><?php echo e(translate('messages.name')); ?></th>
                                    <th class="text-capitalize"><?php echo e(translate('messages.contact')); ?></th>
                                    <th class="text-capitalize"><?php echo e(translate('messages.zone')); ?></th>
                                    <th class="text-capitalize "><?php echo e(translate('Jod_Type')); ?></th>
                                    <th class="text-capitalize "><?php echo e(translate('Vehicle_Type')); ?></th>
                                    <th class="text-capitalize"><?php echo e(translate('messages.availability_status')); ?></th>
                                    <th class="text-capitalize text-center w-110px"><?php echo e(translate('messages.action')); ?></th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                                <?php $__currentLoopData = $delivery_men; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + $delivery_men->firstItem()); ?></td>
                                        <td>
                                            <a class="table-rest-info"
                                                href="<?php echo e(route('admin.delivery-man.pending_dm_view', [$dm['id']])); ?>">
                                                <img class="onerror-image" data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/160x160/img1.jpg')); ?>"
                                                     src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($dm['image'], dynamicStorage('storage/app/public/delivery-man/').'/'.$dm['image'], dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'delivery-man/')); ?>"
                                                     alt="<?php echo e($dm['f_name']); ?> <?php echo e($dm['l_name']); ?>">
                                                <div class="info">
                                                    <h5 class="text-hover-primary mb-0">
                                                        <?php echo e($dm['f_name'] . ' ' . $dm['l_name']); ?></h5>
                                                    <span class="d-block text-body">
                                                        <!-- Rating -->
                                                        <span class="rating">
                                                            <i class="tio-star"></i>
                                                            <?php echo e(count($dm->rating) > 0 ? number_format($dm->rating[0]->average, 1, '.', ' ') : 0); ?>

                                                        </span>
                                                        <!-- Rating -->
                                                    </span>
                                                </div>
                                            </a>
                                        </td>
                                        <td>

                                            <div class="info">
                                                <h5 class="text-hover-primary mb-0">
                                                <?php echo e($dm->email); ?></h5>
                                                <span class="d-block text-body">
                                                    <?php echo e($dm['phone']); ?>

                                                </span>
                                            </div>

                                        </td>
                                        <td>
                                            <?php if($dm->zone): ?>
                                                <span><?php echo e($dm->zone->name); ?></span>
                                            <?php else: ?>
                                                <span><?php echo e(translate('messages.zone_deleted')); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if($dm->earning == 1): ?>
                                            <?php echo e(translate('Freelance')); ?>

                                            <?php else: ?>
                                            <?php echo e(translate('Salary_Base')); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if($dm->vehicle): ?>
                                                <span><?php echo e($dm->vehicle->type); ?></span>
                                            <?php else: ?>
                                                <span><?php echo e(translate('messages.Vehicle_not_found')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($dm->application_status == 'denied'): ?>
                                                <div>
                                                    <strong
                                                        class="text-danger text-capitalize"><?php echo e(translate('messages.denied')); ?></strong>
                                                </div>
                                            <?php else: ?>
                                                <div>
                                                    <strong
                                                        class="text-info text-capitalize"><?php echo e(translate('messages.pending')); ?></strong>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn btn-sm btn--primary btn-outline-primary action-btn request-alert"
                                                data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Approve')); ?>"
                                                    data-url="<?php echo e(route('admin.delivery-man.application', [$dm['id'], 'approved'])); ?>" data-message="<?php echo e(translate('messages.you_want_to_approve_this_application_?')); ?>"
                                                    href="javascript:"><i class="tio-done font-weight-bold"></i></a>
                                                <?php if($dm->application_status != 'denied'): ?>
                                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn request-alert" data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Deny')); ?>"
                                                        data-url="<?php echo e(route('admin.delivery-man.application', [$dm['id'], 'denied'])); ?>" data-message="<?php echo e(translate('messages.you_want_to_deny_this_application_?')); ?>"
                                                        href="javascript:"><i
                                                        class="tio-clear"></i></a>
                                                <?php endif; ?>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <?php if(count($delivery_men) === 0): ?>
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
                                    <?php echo $delivery_men->appends(request()->all())->links(); ?>

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
        $(document).on('ready', function() {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function() {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function() {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('keyup', function() {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function() {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });

        });

        $('.request-alert').on('click',function (){
            let url = $(this).data('url');
            let message = $(this).data('message');
            request_alert(url, message);
        })

        function request_alert(url, message) {
            Swal.fire({
                title: '<?php echo e(translate('messages.Are_you_sure_?')); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
                confirmButtonText: '<?php echo e(translate('messages.yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/delivery-man/pending_list.blade.php ENDPATH**/ ?>