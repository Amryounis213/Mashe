<?php $__env->startSection('title',$restaurant->name."'s".translate('messages.Food')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(dynamicAsset('public/assets/admin/css/croppie.css')); ?>" rel="stylesheet">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">

        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h1 class="page-header-title text-break">
                <i class="tio-museum"></i> <span><?php echo e($restaurant->name); ?></span>
            </h1>
        </div>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev initial-hidden">
                <a class="hs-nav-scroller-arrow-link" href="javascript:">
                    <i class="tio-chevron-left"></i>
                </a>
            </span>

            <span class="hs-nav-scroller-arrow-next initial-hidden">
                <a class="hs-nav-scroller-arrow-link" href="javascript:">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <!-- Nav -->
            <?php echo $__env->make('admin-views.vendor.view.partials._header',['restaurant'=>$restaurant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->

    <!-- End Page Header -->

    <div class="resturant-card-navbar px-xl-4 justify-content-evenly">
        <div class="order-info-item">
            <div class="order-info-icon icon-sm">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant/foods/all.png')); ?>" alt="public">
            </div>
                <?php ($food = \App\Models\Food::withoutGlobalScope(\App\Scopes\RestaurantScope::class)
                ->where(['restaurant_id'=>$restaurant->id])->count()); ?>
                <?php ($food = ($food == null) ? 0 : $food); ?>
                <h6 class="card-subtitle"><?php echo e(translate('messages.all')); ?><span class="amount text--primary"><?php echo e($food); ?></span></h6>
        </div>
        <span class="order-info-seperator"></span>
        <div class="order-info-item">
            <div class="order-info-icon icon-sm">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant/foods/active.png')); ?>" alt="public">
            </div>
                <?php ($food = \App\Models\Food::withoutGlobalScope(\App\Scopes\RestaurantScope::class)->
                where(['restaurant_id'=>$restaurant->id, 'status'=>1])->count()); ?>
                <?php ($food = ($food == null) ? 0 : $food); ?>
                <h6 class="card-subtitle"><?php echo e(translate('Active_Food')); ?><span class="amount text--primary"><?php echo e($food); ?></span></h6>
        </div>
        <span class="order-info-seperator"></span>
        <div class="order-info-item">
            <div class="order-info-icon icon-sm">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant/foods/inactive.png')); ?>" alt="public">
            </div>
                <?php ($food = \App\Models\Food::withoutGlobalScope(\App\Scopes\RestaurantScope::class)->
                where(['restaurant_id'=>$restaurant->id, 'status'=>0])->count()); ?>
                <?php ($food = ($food == null) ? 0 : $food); ?>
                <h6 class="card-subtitle"><?php echo e(translate('Inactive_Food')); ?><span class="amount text--primary"><?php echo e($food); ?></span></h6>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Page Heading -->
    <div class="card h-100">
        <div class="card-header flex-wrap border-0 py-2">
            <div class="search--button-wrapper">
                <h3 class="card-title d-flex align-items-center"> <span class="card-header-icon mr-1"><i class="tio-restaurant"></i></span> <?php echo e(translate('messages.foods')); ?> <span class="badge badge-soft-dark ml-2 badge-circle"><?php echo e($foods->total()); ?></span></h3>
                <form class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                    <!-- Search -->
                    <input type="hidden" name="restaurant_id" value="<?php echo e($restaurant->id); ?>">
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search" class="form-control" value="<?php echo e(request()?->search ?? null); ?>"
                                placeholder="<?php echo e(translate('Search_by_name.')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>" required>
                        <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                    </div>
                    <!-- End Search -->
                </form>
                <!-- Static Export Button -->
                <div class="hs-unfold ml-3 mr-3">
                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:"
                        data-hs-unfold-options='{
                            "target": "#usersExportDropdown",
                            "type": "css-animation"
                        }'>
                        <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                    </a>

                    <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                        <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>

                        <a target="__blank" id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.food.restaurant-food-export', ['type'=>'excel', 'restaurant_id'=>$restaurant->id, request()->getQueryString()])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                            alt="Image Description">
                            <?php echo e(translate('messages.excel')); ?>

                        </a>

                        <a target="__blank" id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.food.restaurant-food-export', ['type'=>'csv', 'restaurant_id'=>$restaurant->id, request()->getQueryString()])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                            <?php echo e(translate('messages.csv')); ?>

                        </a>
                    </div>
                </div>
                <!-- Static Export Button -->
                <a href="<?php echo e(route('admin.food.add-new')); ?>" class="btn btn--primary pull-right"><i
                            class="tio-add-circle"></i> <?php echo e(translate('messages.add_new_food')); ?></a>
            </div>
        </div>
        <div class="table-responsive datatable-custom">
            <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                    data-hs-datatables-options='{
                        "order": [],
                        "orderCellsTop": true,
                        "paging": false
                    }'>
                <thead class="thead-light">
                    <tr>
                        <th class="text-center pl-4 w-100px"><?php echo e(translate('messages.sl')); ?></th>
                        <th class="w-120px"><?php echo e(translate('messages.name')); ?></th>
                        <th class="w-120px"><?php echo e(translate('messages.category')); ?></th>
                        <th class="text-center w-120px pr-80px">
                            <?php echo e(translate('messages.price')); ?>

                        </th>
                        <th class="w-100px"><?php echo e(translate('messages.status')); ?></th>
                        <th class="w-60px text-center"><?php echo e(translate('messages.action')); ?></th>
                    </tr>
                </thead>

                <tbody id="set-rows">

                <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td class="text-center">

                        <?php echo e($key+$foods->firstItem()); ?>

                    </td>
                    <td class="py-2">
                        <a class="media align-items-center" href="<?php echo e(route('admin.food.view',[$food['id']])); ?>">
                            <img class="avatar avatar-lg mr-3 onerror-image"

                                 src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(
                                                $food['image'] ?? '',
                                                dynamicStorage('storage/app/public/product').'/'.$food['image'] ?? '',
                                                dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                                                'product/'
                                            )); ?>"


                                 data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>" alt="<?php echo e($food->name); ?> image">
                            <div class="media-body">
                                <h5 class="text-hover-primary mb-0"><?php echo e(Str::limit($food['name'],20,'...')); ?></h5>
                            </div>
                        </a>
                    </td>
                    <td>
                    <div>
                        <?php echo e(Str::limit(($food?->category?->parent ? $food?->category?->parent?->name : $food?->category?->name )  ?? translate('messages.uncategorize')
                        , 20, '...')); ?>

                    </div>
                    </td>
                    <td>
                        <div class="table--food-price text-right">
                            <?php ($price = \App\CentralLogics\Helpers::format_currency($food['price'])); ?>
                            <?php echo e($price); ?>

                        </div>
                    </td>
                    <td>
                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($food->id); ?>">
                            <input type="checkbox" data-url="<?php echo e(route('admin.food.status',[$food['id'],$food->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="stocksCheckbox<?php echo e($food->id); ?>" <?php echo e($food->status?'checked':''); ?>>
                            <span class="toggle-switch-label">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                    </td>
                    <td>
                        <div class="btn--container justify-content-center">
                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                href="<?php echo e(route('admin.food.edit',[$food['id']])); ?>" title="<?php echo e(translate('messages.edit_food')); ?>"><i class="tio-edit"></i>
                            </a>
                            <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                data-id="food-<?php echo e($food['id']); ?>" data-message="<?php echo e(translate('Want to delete this item')); ?>" title="<?php echo e(translate('messages.delete_food')); ?>"><i class="tio-delete-outlined"></i>
                            </a>
                            <form action="<?php echo e(route('admin.food.delete',[$food['id']])); ?>"
                                    method="post" id="food-<?php echo e($food['id']); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="page-area px-4 pb-3">
                <div class="d-flex align-items-center justify-content-end">
                    <div>
                        <?php echo $foods->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <!-- Page level plugins -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

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


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/vendor/view/product.blade.php ENDPATH**/ ?>