<?php $__env->startSection('title', translate('messages.food_report')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <i class="tio-filter-list"></i>
                <span>
                    <?php echo e(translate('messages.food_report')); ?>

                    <?php if($from && $to): ?>
                        <span class="h6 mb-0 badge badge-soft-success ml-2">
                            ( <?php echo e($from); ?> - <?php echo e($to); ?> )</span>
                    <?php endif; ?>
                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <div class="card mb-20">
            <div class="card-body">
                <h4 class=""><?php echo e(translate('Search_Data')); ?></h4>
                <form method="get">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3">
                            <select name="zone_id" class="form-control js-select2-custom set-filter"
                                    data-url="<?php echo e(url()->full()); ?>" data-filter="zone_id" id="zone">
                                <option value="all"><?php echo e(translate('messages.All_Zones')); ?></option>
                                <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $z): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($z['id']); ?>"
                                        <?php echo e(isset($zone) && $zone->id == $z['id'] ? 'selected' : ''); ?>>
                                        <?php echo e($z['name']); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <select name="restaurant_id" data-url="<?php echo e(url()->full()); ?>" data-filter="restaurant_id"
                                    data-placeholder="<?php echo e(translate('messages.select_restaurant')); ?>"
                                    class="js-data-example-ajax form-control set-filter">
                                <?php if(isset($restaurant)): ?>
                                    <option value="<?php echo e($restaurant->id); ?>" selected><?php echo e($restaurant->name); ?></option>
                                <?php else: ?>
                                    <option value="all" selected><?php echo e(translate('messages.all_restaurants')); ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <select name="category_id" id="category_id"
                                    data-url="<?php echo e(url()->full()); ?>" data-filter="category_id"
                                class="js-select2-custom form-control set-filter">
                                <option value="all"><?php echo e(translate('messages.All Categories')); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category['id']); ?>"
                                        <?php echo e(isset($category_id) && $category_id == $category['id'] ? 'selected' : ''); ?>>
                                        <?php echo e($category['name']); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <?php ($type= request()->type); ?>
                            <!-- Veg/NonVeg filter -->
                            <select name="type"
                                    data-url="<?php echo e(url()->full()); ?>" data-filter="type"
                            data-placeholder="<?php echo e(translate('messages.select_type')); ?>" class="form-control js-select2-custom set-filter">
                                <option value="all" <?php echo e($type=='all'?'selected':''); ?>><?php echo e(translate('messages.all_types')); ?></option>
                                <?php if($toggle_veg_non_veg): ?>
                                <option value="veg" <?php echo e($type=='veg'?'selected':''); ?>><?php echo e(translate('messages.veg')); ?></option>
                                <option value="non_veg" <?php echo e($type=='non_veg'?'selected':''); ?>><?php echo e(translate('messages.non_veg')); ?></option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <select class="form-control set-filter" name="filter"
                                    data-url="<?php echo e(url()->full()); ?>" data-filter="filter">
                                <option value="all_time" <?php echo e(isset($filter) && $filter == 'all_time' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.All_Time')); ?></option>
                                <option value="this_year" <?php echo e(isset($filter) && $filter == 'this_year' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.This_Year')); ?></option>
                                <option value="previous_year"
                                    <?php echo e(isset($filter) && $filter == 'previous_year' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.Previous_Year')); ?></option>
                                <option value="this_month"
                                    <?php echo e(isset($filter) && $filter == 'this_month' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.This_Month')); ?></option>
                                <option value="this_week" <?php echo e(isset($filter) && $filter == 'this_week' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.This_Week')); ?></option>
                                <option value="custom" <?php echo e(isset($filter) && $filter == 'custom' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.Custom')); ?></option>
                            </select>
                        </div>
                        <?php if(isset($filter) && $filter == 'custom'): ?>
                            <div class="col-sm-6 col-md-3">
                                <input type="date" name="from" id="from_date" class="form-control"
                                    placeholder="<?php echo e(translate('Start_Date')); ?>" value=<?php echo e($from ? $from : ''); ?> required>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <input type="date" name="to" id="to_date" class="form-control"
                                    placeholder="<?php echo e(translate('End_Date')); ?>" value=<?php echo e($to ? $to : ''); ?> required>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-6 col-md-3 ml-auto">
                            <button type="submit"
                                class="btn btn-primary btn-block"><?php echo e(translate('Filter')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- End Stats -->


        <div class="row gx-2 gx-lg-3">
                <div class="col-lg-12 mb-3 mb-lg-12">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-header flex-wrap justify-content-evenly justify-content-lg-between border-0">
                            <h4 class="card-title my-2 my-md-0">
                                <i class="tio-chart-bar-4"></i>
                                <?php echo e(translate('messages.Sales_Statistics')); ?>

                            </h4>
                            <div class="d-flex flex-wrap my-2 my-md-0 justify-content-center align-items-center">
                            <span class="h5 m-0 fz--11 d-flex align-items-center mb-2 mb-md-0">
                                <?php if(isset($filter) &&  in_array($filter, ['this_year','previous_year','custom'])): ?>

                                <?php echo e(translate('messages.Average_Monthly_Sales_Value')); ?> :
                                <?php echo e(\App\CentralLogics\Helpers::format_currency(((array_sum($data) )  / 12) )); ?>

                                <?php elseif(isset($filter) &&  in_array($filter, ['this_week'])): ?>
                                <?php echo e(translate('messages.Average_Daily_Sales_Value')); ?> :
                                <?php echo e(\App\CentralLogics\Helpers::format_currency(((array_sum($data) )  / 7) )); ?>

                                <?php elseif(isset($filter) &&  in_array($filter, ['this_month'])): ?>
                                <?php echo e(translate('messages.Average_Monthly_Sales_Value')); ?> :
                                <?php echo e(\App\CentralLogics\Helpers::format_currency(((array_sum($data) )  / 4) )); ?>


                                <?php elseif(!$filter ||  $filter == 'all_time'): ?>
                                <?php echo e(translate('messages.Average_Yearly_Sales_Value')); ?> :
                                <?php echo e(\App\CentralLogics\Helpers::format_currency(((array_sum($data) )  / (count($data)> 0 ? count($data) : 1 )) )); ?>

                                <?php endif; ?>
                            </span>
                            </div>
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <!-- Bar Chart -->
                            <div class="d-flex align-items-center">
                                <div class="chart--extension">
                                    <?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>(<?php echo e(translate('messages.currency')); ?>)
                                </div>
                                <div class="chartjs-custom w-75 flex-grow-1 h-20rem">
                                    <canvas id="chart1">
                                    </canvas>
                                </div>
                            </div>
                            <!-- End Bar Chart -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>



            <!-- Card -->
            <div class="col-12">
                <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header border-0 py-2">
                            <div class="search--button-wrapper">
                                <h3 class="card-title">
                                    <?php echo e(translate('food_report_table')); ?><span class="badge badge-soft-secondary"
                                        id="countfoods"><?php echo e($foods->total()); ?></span>
                                </h3>
                                <form class="search-form">
                                    <!-- Search -->
                                    <div class="input--group input-group">
                                        <input id="datatableSearch" name="search" type="search" class="form-control" value="<?php echo e(request()->search ?? null); ?>"
                                            placeholder="<?php echo e(translate('Search_by_food_name')); ?>"
                                            aria-label="<?php echo e(translate('messages.search_here')); ?>">
                                        <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                                    </div>
                                    <!-- End Search -->
                                </form> <!-- Unfold -->
                                <div class="hs-unfold mr-2">
                                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40"
                                        href="javascript:;"
                                        data-hs-unfold-options='{
                                                "target": "#usersExportDropdown",
                                                "type": "css-animation"
                                            }'>
                                        <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                                    </a>

                                    <div id="usersExportDropdown"
                                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                        <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                                        <a id="export-excel" class="dropdown-item"
                                            href="<?php echo e(route('admin.report.food-wise-report-export', ['export_type' => 'excel', request()->getQueryString()])); ?>">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                                alt="Image Description">
                                            <?php echo e(translate('messages.excel')); ?>

                                        </a>
                                        <a id="export-csv" class="dropdown-item"
                                            href="<?php echo e(route('admin.report.food-wise-report-export', ['export_type' => 'csv', request()->getQueryString()])); ?>">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                                alt="Image Description">
                                            <?php echo e(translate('messages.csv')); ?>

                                        </a>
                                    </div>
                                </div>


                                <!-- End Unfold -->
                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Header -->
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive datatable-custom" id="table-div">
                            <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap card-table"
                                data-hs-datatables-options='{
                                    "columnDefs": [{
                                        "targets": [],
                                        "width": "5%",
                                        "orderable": false
                                    }],
                                    "order": [],
                                    "info": {
                                    "totalQty": "#datatableWithPaginationInfoTotalQty"
                                    },

                                    "entries": "#datatableEntries",

                                    "isResponsive": false,
                                    "isShowPaging": false,
                                    "paging":false
                                }'>
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo e(translate('sl')); ?></th>
                                        <th class="w--2"><?php echo e(translate('messages.name')); ?></th>
                                        <th class="w--2"><?php echo e(translate('messages.restaurant')); ?></th>
                                        <th><?php echo e(translate('messages.order_count')); ?></th>
                                        <th><?php echo e(translate('messages.price')); ?></th>
                                        <th><?php echo e(translate('messages.total_amount_sold')); ?></th>
                                        <th><?php echo e(translate('messages.total_discount_given')); ?></th>
                                        <th><?php echo e(translate('messages.average_sale_value')); ?></th>
                                        <th><?php echo e(translate('messages.average_ratings')); ?></th>
                                    </tr>
                                </thead>

                                <tbody id="set-rows">

                                    <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + $foods->firstItem()); ?></td>
                                            <td>
                                                <a class="media align-foods-center"
                                                    href="<?php echo e(route('admin.food.view', [$food['id']])); ?>">
                                                    <img class="avatar avatar-lg mr-3 onerror-image"
                                                         src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(
                                                            $food['image'] ?? '',
                                                            dynamicStorage('storage/app/public/product').'/'.$food['image'] ?? '',
                                                            dynamicAsset('public/assets/admin/img/160x160/img2.jpg'),
                                                            'product/'
                                                        )); ?>"
                                                         data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/160x160/img2.jpg')); ?>"
                                                        alt="<?php echo e($food->name); ?> image">
                                                    <div class="media-body">
                                                        <h5 class="text-hover-primary mb-0"><?php echo e(Str::limit($food['name'], 20, '...')); ?></h5>
                                                    </div>
                                                </a>
                                            </td>

                                            <td>
                                                <?php if($food->restaurant): ?>
                                                    <?php echo e(Str::limit($food->restaurant->name, 25, '...')); ?>

                                                <?php else: ?>
                                                    <?php echo e(translate('messages.restaurant_deleted')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($food->orders_count); ?>

                                            </td>
                                            <td>
                                                <?php echo e(\App\CentralLogics\Helpers::format_currency($food->price)); ?>

                                            </td>
                                            <td>
                                                <?php echo e(\App\CentralLogics\Helpers::format_currency($food->orders_sum_price)); ?>

                                            </td>
                                            <td>
                                                <?php echo e(\App\CentralLogics\Helpers::format_currency($food->orders_sum_discount_on_food)); ?>

                                            </td>
                                            <td>
                                                <?php echo e($food->orders_count > 0 ? \App\CentralLogics\Helpers::format_currency(($food->orders_sum_price - $food->orders_sum_discount_on_food) / $food->orders_count) : 0); ?>

                                            </td>
                                            <td>
                                                <div class="rating">
                                                    <span><i class="tio-star"></i></span><?php echo e(round($food->avg_rating, 1)); ?>

                                                    (<?php echo e($food->rating_count); ?>)
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php if(count($foods) !== 0): ?>
                                <hr>
                            <?php endif; ?>
                            <div class="page-area px-4 pb-3">
                                <?php echo $foods->links(); ?>

                            </div>
                            <?php if(count($foods) === 0): ?>
                                <div class="empty--data">
                                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                                    <h5>
                                        <?php echo e(translate('no_data_found')); ?>

                                    </h5>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- End Table -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script
        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js">
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script_2'); ?>
    <script>
        // INITIALIZATION OF CHARTJS
        // =======================================================
        Chart.plugins.unregister(ChartDataLabels);

        $('.js-chart').each(function() {
            $.HSCore.components.HSChartJS.init($(this));
        });

        let updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

        $(document).on('ready', function() {

            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '<?php echo e(url('/')); ?>/admin/restaurant/get-restaurants',
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            all:true,
                            <?php if(isset($zone)): ?>
                                zone_ids: [<?php echo e($zone->id); ?>],
                            <?php endif; ?>
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    __port: function(params, success, failure) {
                        let $request = $.ajax(params);

                        $request.then(success);
                        $request.fail(failure);

                        return $request;
                    }
                }
            });
        });

        $('#from_date,#to_date').change(function() {
            let fr = $('#from_date').val();
            let to = $('#to_date').val();
            if (fr != '' && to != '') {
                if (fr > to) {
                    $('#from_date').val('');
                    $('#to_date').val('');
                    toastr.error('Invalid date range!', Error, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            }
        })

        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        let ctx = document.getElementById('chart1').getContext("2d");
        let data = {

            labels:[<?php echo implode(',',$label); ?>],

            datasets: [
                {
                    label: "<?php echo e(translate('Total_Amount_Sold')); ?>",
                    fill: false,
                    lineTension: 0.1,
                    // backgroundColor: "rgba(75,192,192,0.4)",
                    // borderColor: "rgba(75,192,192,1)",
                    // borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    // pointBorderColor: "rgba(75,192,192,1)",
                    // pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    // pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    // pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    // data: [65, 59, 80, 81, 56, 55, 40],
                    spanGaps: false,
                    data:[<?php echo e(implode(',', $data)); ?>],
                    backgroundColor: "#7ECAFF",
                    hoverBackgroundColor: "#7ECAFF",
                    borderColor: "#7ECAFF",
                }
            ]
        };



        let options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                position: "top",
                // text: 'anything',
                fontSize: 18,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            },
            cornerRadius: 5,

            tooltips: {
                enabled: true,
                hasIndicator: true,
                // mode: 'single',
                mode: "index",
                intersect: false,

            },

            scales: {
                yAxes: [{
                    gridLines: {
                        color: "#e7eaf3",
                        drawBorder: false,
                        zeroLineColor: "#e7eaf3"
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: <?php echo e(ceil((array_sum($data)/10000))*2000); ?>,
                        fontSize: 12,
                        fontColor: "#97a4af",
                        fontFamily: "Open Sans, sans-serif",
                        padding: 10
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        fontSize: 12,
                        fontColor: "#97a4af",
                        fontFamily: "Open Sans, sans-serif",
                        padding: 5
                    },
                    categoryPercentage: 0.3,
                    maxBarThickness: "10"
                }]
            },

            hover: {
                mode: "nearest",
                intersect: true,
            },
        };

        let myLineChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/report/food-wise-report.blade.php ENDPATH**/ ?>