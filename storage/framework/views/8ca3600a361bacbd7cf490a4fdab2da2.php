<?php $__env->startSection('title',translate('messages.dashboard')); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <?php if(auth('vendor')->check()): ?>
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h1 class="page-header-title my-1">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/resturant-panel/page-title/dashboard.png')); ?>" alt="public">
                    </div>
                    <span>
                        <?php echo e(translate('messages.dashboard')); ?>

                    </span>
                </h1>
                <span class="my-2 text--title d-block">
                    <?php echo e(translate('messages.followup')); ?>

                    <i class="tio-restaurant fz-30px"></i>
                </span>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-header">
                <h4 class="card-header-title">
                    <span class="card-header-icon">
                        <i class="tio-chart-bar-4"></i>
                    </span>
                    <?php echo e(translate('messages.dashboard_order_statistics')); ?>

                </h4>
                <div>
                    <select class="custom-select my-1 order_stats_update" name="statistics_type">
                        <option
                            value="overall" <?php echo e($params['statistics_type'] == 'overall'?'selected':''); ?>>
                            <?php echo e(translate('messages.Overall Statistics')); ?>

                        </option>
                        <option
                            value="today" <?php echo e($params['statistics_type'] == 'today'?'selected':''); ?>>
                            <?php echo e(translate("messages.Today’s Statistics")); ?>

                        </option>
                        <option
                            value="this_month" <?php echo e($params['statistics_type'] == 'this_month'?'selected':''); ?>>
                            <?php echo e(translate("messages.This Month’s Statistics")); ?>

                        </option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-2" id="order_stats">
                    <?php echo $__env->make('vendor-views.partials._dashboard-order-stats',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>

        <div class="row gx-2 gx-lg-3">
            <div class="col-lg-12 mb-3 mb-lg-12">
                <!-- Card -->
                <div class="card h-100">
                    <div class="card-header flex-wrap justify-content-evenly justify-content-lg-between border-0">
                        <h4 class="card-title my-2 my-md-0">
                            <i class="tio-chart-bar-4"></i>
                            <?php echo e(translate('messages.yearly_statistics')); ?>

                        </h4>
                        <div class="d-flex flex-wrap my-2 my-md-0 justify-content-center align-items-center">
                            <?php ($amount=array_sum($earning)); ?>
                            <span class="h5 m-0 mr-3 fz--11 d-flex align-items-center mb-2 mb-md-0">
                                <span class="legend-indicator bg-7ECAFF"></span>
                                <?php echo e(translate('messages.commission_given')); ?> : <?php echo e(\App\CentralLogics\Helpers::format_currency(array_sum($commission))); ?>

                            </span>
                            <span class="h5 m-0 fz--11 d-flex align-items-center mb-2 mb-md-0">
                                <span class="legend-indicator bg-0661CB"></span>
                                <?php echo e(translate('messages.total_earning')); ?> : <?php echo e(\App\CentralLogics\Helpers::format_currency(array_sum($earning))); ?>

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
                            <div class="chartjs-custom w-75 flex-grow-1">
                                <canvas id="updatingData" class="h-20rem" data-hs-chartjs-options='{
                                    "type": "bar",
                                    "data": {
                                        "labels": ["<?php echo e(translate('messages.Jan')); ?>","<?php echo e(translate('messages.Feb')); ?>","<?php echo e(translate('messages.Mar')); ?>","<?php echo e(translate('messages.April')); ?>","<?php echo e(translate('messages.May')); ?>","<?php echo e(translate('messages.Jun')); ?>","<?php echo e(translate('messages.Jul')); ?>","<?php echo e(translate('messages.Aug')); ?>","<?php echo e(translate('messages.Sep')); ?>","<?php echo e(translate('messages.Oct')); ?>","<?php echo e(translate('messages.Nov')); ?>","<?php echo e(translate('messages.Dec')); ?>"],
                                        "datasets": [{
                                        "data": [<?php echo e($earning[1]); ?>,<?php echo e($earning[2]); ?>,<?php echo e($earning[3]); ?>,<?php echo e($earning[4]); ?>,<?php echo e($earning[5]); ?>,<?php echo e($earning[6]); ?>,<?php echo e($earning[7]); ?>,<?php echo e($earning[8]); ?>,<?php echo e($earning[9]); ?>,<?php echo e($earning[10]); ?>,<?php echo e($earning[11]); ?>,<?php echo e($earning[12]); ?>],
                                        "backgroundColor": "#7ECAFF",
                                        "hoverBackgroundColor": "#7ECAFF",
                                        "borderColor": "#7ECAFF"
                                    },
                                    {
                                        "data": [<?php echo e($commission[1]); ?>,<?php echo e($commission[2]); ?>,<?php echo e($commission[3]); ?>,<?php echo e($commission[4]); ?>,<?php echo e($commission[5]); ?>,<?php echo e($commission[6]); ?>,<?php echo e($commission[7]); ?>,<?php echo e($commission[8]); ?>,<?php echo e($commission[9]); ?>,<?php echo e($commission[10]); ?>,<?php echo e($commission[11]); ?>,<?php echo e($commission[12]); ?>],
                                        "backgroundColor": "#0661CB",
                                        "borderColor": "#0661CB"
                                    }]
                                    },
                                    "options": {
                                    "scales": {
                                        "yAxes": [{
                                        "gridLines": {
                                            "color": "#e7eaf3",
                                            "drawBorder": false,
                                            "zeroLineColor": "#e7eaf3"
                                        },
                                        "ticks": {
                                            "beginAtZero": true,
                                            "stepSize": <?php echo e(ceil($amount/10000)*2000); ?>,
                                            "fontSize": 12,
                                            "fontColor": "#97a4af",
                                            "fontFamily": "Open Sans, sans-serif",
                                            "padding": 10
                                        }
                                        }],
                                        "xAxes": [{
                                        "gridLines": {
                                            "display": false,
                                            "drawBorder": false
                                        },
                                        "ticks": {
                                            "fontSize": 12,
                                            "fontColor": "#97a4af",
                                            "fontFamily": "Open Sans, sans-serif",
                                            "padding": 5
                                        },
                                        "categoryPercentage": 0.3,
                                        "maxBarThickness": "10"
                                        }]
                                    },
                                    "cornerRadius": 5,
                                    "tooltips": {
                                        "prefix": " ",
                                        "hasIndicator": true,
                                        "mode": "index",
                                        "intersect": false
                                    },
                                    "hover": {
                                        "mode": "nearest",
                                        "intersect": true
                                    }
                                    }
                                }'></canvas>
                            </div>
                        </div>
                        <!-- End Bar Chart -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6 mt-3">
                <!-- Card -->
                <div class="card h-100" id="top-selling-foods-view">
                    <?php echo $__env->make('vendor-views.partials._top-selling-foods',['top_sell'=>$data['top_sell']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6 mt-3">
                <!-- Card -->
                <div class="card h-100" id="top-rated-foods-view">
                    <?php echo $__env->make('vendor-views.partials._most-rated-foods',['most_rated_foods'=>$data['most_rated_foods']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>


        </div>
        <!-- End Row -->
        <?php else: ?>
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(translate('messages.welcome')); ?>, <?php echo e(auth('vendor_employee')->user()->f_name); ?>.</h1>
                    <p class="page-header-text"><?php echo e(translate('messages.employee_welcome_message')); ?></p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script
        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script_2'); ?>
    <script>
        // INITIALIZATION OF CHARTJS
        // =======================================================
        Chart.plugins.unregister(ChartDataLabels);

        $('.js-chart').each(function () {
            $.HSCore.components.HSChartJS.init($(this));
        });

        let updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

        $('.order_stats_update').on('change',function (){
            let type = $(this).val();
            order_stats_update(type);
        })

        function order_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('vendor.dashboard.order-stats')); ?>',
                data: {
                    statistics_type: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('statistics_type',type);
                    $('#order_stats').html(data.view)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        function insert_param(key, value) {
            key = encodeURIComponent(key);
            value = encodeURIComponent(value);
            // kvp looks like ['key1=value1', 'key2=value2', ...]
            let kvp = document.location.search.substr(1).split('&');
            let i = 0;

            for (; i < kvp.length; i++) {
                if (kvp[i].startsWith(key + '=')) {
                    let pair = kvp[i].split('=');
                    pair[1] = value;
                    kvp[i] = pair.join('=');
                    break;
                }
            }
            if (i >= kvp.length) {
                kvp[kvp.length] = [key, value].join('=');
            }
            // can return this or...
            let params = kvp.join('&');
            // change url page with new params
            window.history.pushState('page2', 'Title', '<?php echo e(url()->current()); ?>?' + params);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/dashboard.blade.php ENDPATH**/ ?>