<?php $__env->startSection('title',translate('messages.New_Restaurant_Join_Request')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title"><i class="tio-filter-list"></i> <?php echo e(translate('messages.New_Restaurant_Join_Request')); ?></h1>
            <!-- Resturent List -->
                    <!-- Resturent Card Wrapper -->
        </div>
        <!-- End Page Header -->

        <div class="d-flex flex-wrap mb-4 __gap-15px">
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('admin.restaurant.pending')); ?>"><?php echo e(translate('messages.Pending_Requests')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('admin.restaurant.denied')); ?>"  aria-disabled="true"><?php echo e(translate('messages.Rejected_Request')); ?></a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <div class="page-header-select-wrapper flex-grow-1">
                <div class="select-item">
                    <!-- Veg/NonVeg filter -->
                    <select name="type"
                            data-url="<?php echo e(url()->full()); ?>" data-filter="type"
                            data-placeholder="<?php echo e(translate('messages.select_veg/non_veg')); ?>" class="form-control js-select2-custom set-filter">
                        <option selected disabled><?php echo e(translate('messages.select_veg/non_veg')); ?></option>
                        <option value="all" <?php echo e($type=='all'?'selected':''); ?>><?php echo e(translate('messages.all')); ?></option>
                        <?php if($toggle_veg_non_veg): ?>
                        <option value="veg" <?php echo e($type=='veg'?'selected':''); ?>><?php echo e(translate('messages.veg')); ?></option>
                        <option value="non_veg" <?php echo e($type=='non_veg'?'selected':''); ?>><?php echo e(translate('messages.non_veg')); ?></option>
                        <?php endif; ?>
                    </select>

                <!-- End Veg/NonVeg filter -->
                </div>
                <div class="select-item">
                    <!-- Veg/NonVeg filter -->
                    <select name="restaurant_model"
                            data-url="<?php echo e(url()->full()); ?>" data-filter="restaurant_model"
                            data-placeholder="<?php echo e(translate('messages.Business_Model')); ?>" class="form-control js-select2-custom set-filter">
                        <option selected disabled><?php echo e(translate('messages.select_type')); ?></option>
                        <option value="all" <?php echo e($typ=='all'?'selected':''); ?>><?php echo e(translate('messages.all')); ?></option>
                        <option value="commission" <?php echo e($typ=='commission'?'selected':''); ?>><?php echo e(translate('messages.Commission')); ?></option>
                        <option value="subscribed" <?php echo e($typ=='subscribed'?'selected':''); ?>><?php echo e(translate('messages.Subscribed')); ?></option>
                        <option value="unsubscribed" <?php echo e($typ=='unsubscribed'?'selected':''); ?>><?php echo e(translate('messages.Unsubscribed')); ?></option>

                    </select>

                <!-- End Veg/NonVeg filter -->
                </div>
                <?php if(!isset(auth('admin')->user()->zone_id)): ?>
                    <div class="select-item">
                        <select name="zone_id" class="form-control js-select2-custom set-filter"
                                data-url="<?php echo e(url()->full()); ?>" data-filter="zone_id">
                            <option selected disabled><?php echo e(translate('messages.select_zone')); ?></option>
                            <option value="all"><?php echo e(translate('messages.all_zones')); ?></option>
                            <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($z['id']); ?>" <?php echo e(isset($zone) && $zone->id == $z['id']?'selected':''); ?>>
                                    <?php echo e($z['name']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row gx-2 gx-lg-3 mt-3" >
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Card Header -->

                    <div class="card-header py-2 border-0">
                        <div class="search--button-wrapper">
                            <h3 class="card-title"><?php echo e(translate('messages.restaurants_list')); ?>

                                <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($restaurants->total()); ?></span>
                            </h3>
                            <form  class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                                <!-- Search -->
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="<?php echo e(translate('Ex:_Search_by_restaurant_name_phone_or_email')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>">
                                    <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                    </div>
                    <!-- Card Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom resturant-list-table">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th class="text-uppercase w-90px"><?php echo e(translate('messages.sl')); ?></th>
                                <th class="initial-58"><?php echo e(translate('messages.restaurant_info')); ?></th>
                                <th class="w-230px text-center"><?php echo e(translate('messages.owner_info')); ?> </th>
                                <th class="w-130px"><?php echo e(translate('messages.zone')); ?></th>
                                <th class="w-100px"><?php echo e(translate('messages.Business_Model')); ?></th>
                                <th class="w-100px"><?php echo e(translate('messages.status')); ?></th>
                                <th class="text-center w-60px"><?php echo e(translate('messages.action')); ?></th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+$restaurants->firstItem()); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.restaurant.view',  ['restaurant'=>$dm->id, 'tab'=> 'pending-list'])); ?>" alt="view restaurant" class="table-rest-info">
                                        <img  class="onerror-image" data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"

                                              src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(
                                                $dm['logo'] ?? '',
                                                dynamicStorage('storage/app/public/restaurant').'/'.$dm['logo'] ?? '',
                                                dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                                                'restaurant/'
                                            )); ?>">
                                            <div class="info">
                                                <span class="d-block text-body">
                                                    <?php echo e(Str::limit($dm->name,20,'...')); ?><br>
                                                    <!-- Rating -->
                                                    <span class="rating">
                                                        <?php ($restaurant_rating = $dm['rating']==null ? 0 : (array_sum($dm['rating']))/5 ); ?>
                                                        <i class="tio-star"></i> <?php echo e($restaurant_rating); ?>

                                                    </span>
                                                    <!-- Rating -->
                                                </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="d-block owner--name text-center">
                                            <?php echo e($dm->vendor->f_name.' '.$dm->vendor->l_name); ?>

                                        </span>
                                        <span class="d-block font-size-sm text-center">
                                            <?php echo e($dm['phone']); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php echo e($dm->zone?$dm->zone->name:translate('messages.zone_deleted')); ?>

                                    </td>

                                    <td>
                                        <?php if($dm->restaurant_model == 'commission'): ?>
                                                    <div><?php echo e(translate('Commission_Base')); ?></div>
                                                <?php elseif($dm->restaurant_model == 'none'): ?>
                                                    <div><?php echo e(translate('Not_chosen')); ?></div>
                                                <?php else: ?>
                                                    <div><?php echo e(translate('Subscription_Base')); ?></div>
                                            <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($dm->vendor->status)): ?>
                                            <?php if($dm->vendor->status): ?>
                                                <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($dm->id); ?>">
                                                    <input type="checkbox" data-url="<?php echo e(route('admin.restaurant.status',[$dm->id,$dm->status?0:1])); ?>" data-message="<?php echo e(translate('messages.you_want_to_change_this_restaurant_status')); ?>" class="toggle-switch-input status_change_alert" id="stocksCheckbox<?php echo e($dm->id); ?>" <?php echo e($dm->status?'checked':''); ?>>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <?php else: ?>
                                            <span class="badge badge-soft-danger"><?php echo e(translate('messages.denied')); ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge badge-soft-danger"><?php echo e(translate('messages.pending')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn--container justify-content-center">
                                                <a class="btn btn-sm btn--primary btn-outline-primary action-btn"

                                                data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Details')); ?>"
                                                    href="<?php echo e(route('admin.restaurant.view',  ['restaurant'=>$dm->id, 'tab'=> 'pending-list'])); ?>"> <i class="tio-invisible font-weight-bold"></i> </a>


                                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn request_alert"
                                                data-url="<?php echo e(route('admin.restaurant.application',[$dm['id'],1])); ?>" data-message="<?php echo e(translate('messages.you_want_to_approve_this_application')); ?>"
                                                data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Approve')); ?>"
                                                    href="javascript:"> <i class="tio-done font-weight-bold"></i> </a>


                                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn request_alert"
                                                data-toggle="tooltip" data-placement="top" title="<?php echo e(translate('Deny')); ?>"
                                                data-url="<?php echo e(route('admin.restaurant.application',[$dm['id'],0])); ?>" data-message="<?php echo e(translate('messages.you_want_to_deny_this_application')); ?>"
                                                    href="javascript:"><i
                                                    class="tio-clear"></i></a>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($restaurants) === 0): ?>
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
                                    <?php echo $restaurants->appends(request()->all())->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- Resturent List -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $('.status_change_alert').on('click', function (event) {
            let url = $(this).data('url');
            let message = $(this).data('message');
            status_change_alert(url, message, event)
        })

        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(translate('Are_you_sure?')); ?>',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '<?php echo e(translate('no')); ?>',
                confirmButtonText: '<?php echo e(translate('yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href=url;
                }
            })
        }
        $('.request_alert').on('click', function (event) {
            let url = $(this).data('url');
            let message = $(this).data('message');
            request_alert(url, message)
        })
        function request_alert(url, message) {
            Swal.fire({
                title: "<?php echo e(translate('messages.are_you_sure_?')); ?>",
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: "<?php echo e(translate('messages.no')); ?>",
                confirmButtonText: "<?php echo e(translate('messages.yes')); ?>",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('keyup', function () {
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


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/vendor/pending_list.blade.php ENDPATH**/ ?>