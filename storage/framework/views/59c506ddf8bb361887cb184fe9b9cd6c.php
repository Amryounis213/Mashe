<?php $__env->startSection('title',\App\Models\BusinessSetting::where(['key'=>'business_name'])->first()->value??'Dashboard'); ?>
<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <?php if(auth('admin')->user()->role_id == 1): ?>
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="page--header-title">
                    <h1 class="page-header-title"><?php echo e(translate('messages.welcome')); ?>, <?php echo e(auth('admin')->user()->f_name); ?>.</h1>
                    <p class="page-header-text"><?php echo e(translate('messages.Hello,_here_you_can_manage_your_orders_by_zone.')); ?></p>
                </div>

                <div class="page--header-select">
                    <select name="zone_id" class="form-control js-select2-custom fetch-data-zone-wise">
                        <option value="all"><?php echo e(translate('all_zones')); ?></option>
                        <?php $__currentLoopData = \App\Models\Zone::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($zone['id']); ?>" <?php echo e($params['zone_id'] == $zone['id']?'selected':''); ?>>
                                <?php echo e($zone['name']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- End Page Header -->


        <!-- Stats -->
        <div class="card mb-3">
            <div class="card-body pt-0">
                <div id="order_stats_top">
                    <?php echo $__env->make('admin-views.partials._order-statics',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="row g-2 mt-2" id="order_stats">
                    <?php echo $__env->make('admin-views.partials._dashboard-order-stats',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>

        <!-- End Stats -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Card -->
                <div class="card h-100" id="monthly-earning-graph">
                    <!-- Body -->

                <?php echo $__env->make('admin-views.partials._monthly-earning-graph',['total_sell'=>$total_sell,'total_subs' =>$total_subs,'commission'=>$commission], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->

        <div class="row g-2 mt-2">
            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header align-items-center">
                        <h5 class="card-title">
                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/dashboard/statistics.png')); ?>" alt="dashboard" class="card-header-icon">
                            <span><?php echo e(translate('user_statistics')); ?></span>
                        </h5>
                        <div id="stat_zone">
                            <?php echo $__env->make('admin-views.partials._zone-change',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <div class="col-sm-6 col-md-4">
                                <div class="ml-auto mb-2 pb-xl-5">
                                <select class="custom-select user-overview-stats-update" name="user_overview">
                                    <option
                                        value="this_month" <?php echo e($params['user_overview'] == 'this_month'?'selected':''); ?>>
                                        <?php echo e(translate('This_month')); ?>

                                    </option>
                                    <option
                                        value="overall" <?php echo e($params['user_overview'] == 'overall'?'selected':''); ?>>
                                        <?php echo e(translate('messages.Overall')); ?>

                                    </option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="position-relative" >
                            <div id="user-overview-board">
                                <?php ($params = session('dash_params')); ?>
                                <?php if($params['zone_id'] != 'all'): ?>
                                    <?php ($zone_name = \App\Models\Zone::where('id', $params['zone_id'])->first()->name); ?>
                                <?php else: ?>
                                <?php ($zone_name=translate('All')); ?>
                                <?php endif; ?>
                                <div class="chartjs-custom mx-auto">
                                    <div data-id="#user-overview" data-value="<?php echo e($data['customer'].','. $data['restaurants'].','. $data['delivery_man']); ?>"
                                    data-labels="<?php echo e(translate('messages.Customer')); ?>, <?php echo e(translate('messages.Restaurant')); ?>,<?php echo e(translate('messages.Delivery_man')); ?>" id="user-overview"></div>
                                </div>
                            </div>
                        </div>

                        <!-- End Chart -->
                    </div>
                    <!-- End Body -->
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="popular-restaurants-view">
                    <?php echo $__env->make('admin-views.partials._popular-restaurants',['popular'=>$data['popular']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-deliveryman-view">
                    <?php echo $__env->make('admin-views.partials._top-deliveryman',['top_deliveryman'=>$data['top_deliveryman']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-restaurants-view">
                    <?php echo $__env->make('admin-views.partials._top-restaurants',['top_restaurants'=>$data['top_restaurants']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-rated-foods-view">
                    <?php echo $__env->make('admin-views.partials._top-rated-foods',['top_rated_foods'=>$data['top_rated_foods']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>


            <div class="col-lg-6">
                <!-- Card -->
                <div class="card h-100" id="top-selling-foods-view">
                    <?php echo $__env->make('admin-views.partials._top-selling-foods',['top_sell'=>$data['top_sell']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <?php else: ?>
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(translate('messages.welcome')); ?>, <?php echo e(auth('admin')->user()->f_name); ?>.</h1>
                    <p class="page-header-text"><?php echo e(translate('messages.Hello,_here_you_can_manage_your_restaurants.')); ?></p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(dynamicAsset('public/assets/admin/apexcharts/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
<script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/apex-charts.js')); ?>"></script>
<script>

    "use strict";
    loadchart();
    function loadchart(){
        var id = $('#user-overview').data('id');
        var value = $('#user-overview').data('value').split(',').map(Number);
        var labels = $('#user-overview').data('labels').split(',');

        var commission = $('#updatingData').data('commission').split(',').map(Number);
        var subscription = $('#updatingData').data('subscription').split(',').map(Number);
        var total_sell = $('#updatingData').data('total_sell').split(',').map(Number);

    newdonutChart(id,value,labels)

    var options = {
            series: [{
                name: '<?php echo e(translate('messages.admin_commission')); ?>',
                data: commission,
                },  {
                name: '<?php echo e(translate('messages.total_sell')); ?>',
                data: total_sell,
                }
                <?php if(\App\CentralLogics\Helpers::subscription_check()): ?>
                ,{
                name: '<?php echo e(translate('messages.Subscription')); ?>',
                data: subscription,
                }
                <?php endif; ?>

                ],
            chart: {
                    toolbar:{
                        show: false
                    },
                type: 'bar',
                height: 380
            },
            plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 0,
                borderRadiusApplication: 'around',
                borderRadiusWhenStacked: 'last',
                columnWidth: '70%',
                barHeight: '70%',
                distributed: false,
                rangeBarOverlap: true,
                rangeBarGroupRows: false,
                hideZeroBarsWhenGrouped: false,
                isDumbbell: false,
                dumbbellColors: undefined,
                isFunnel: false,
                isFunnel3d: true,
                    colors: {
                        ranges: [{
                            from: 0,
                            to: 0,
                            color: undefined
                        }],
                        backgroundBarColors: [],
                        backgroundBarOpacity: 1,
                        backgroundBarRadius: 0,
                    }
                }
            },
            dataLabels: {
            enabled: false,
                position: 'top',
                maxItems: 1,
                hideOverflowingLabels: true,
                    total: {
                    enabled: false,
                    formatter: undefined,
                    offsetX: 0,
                    offsetY: 0,
                        style: {
                            color: '#373d3f',
                            fontSize: '12px',
                            fontFamily: undefined,
                            fontWeight: 600
                        }
                    }
            },
            stroke: {
                show: true,
                curve: 'smooth',
                lineCap: 'butt',
                width: 2,
                dashArray: 0,
                colors: ['transparent']
            },
            xaxis: {
                categories: ["<?php echo e(translate('messages.Jan')); ?>","<?php echo e(translate('messages.Feb')); ?>","<?php echo e(translate('messages.Mar')); ?>","<?php echo e(translate('messages.April')); ?>","<?php echo e(translate('messages.May')); ?>","<?php echo e(translate('messages.Jun')); ?>","<?php echo e(translate('messages.Jul')); ?>","<?php echo e(translate('messages.Aug')); ?>","<?php echo e(translate('messages.Sep')); ?>","<?php echo e(translate('messages.Oct')); ?>","<?php echo e(translate('messages.Nov')); ?>","<?php echo e(translate('messages.Dec')); ?>"],
            },
            yaxis: {
                title: {
                    text: '<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>. (<?php echo e(\App\CentralLogics\Helpers::currency_code()); ?>)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?> " + val + " <?php echo e(\App\CentralLogics\Helpers::currency_code()); ?>"
                    }
                }
            }
        };

        var commissionchart = new ApexCharts(document.querySelector("#updatingData"), options);
        commissionchart.render();
    }
    $(document).on('change', '.order-stats-update', function () {
        let type = $(this).val();
            order_stats_update(type);
        });


        function order_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.dashboard-stats.order')); ?>',
                data: {
                    statistics_type: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('statistics_type',type);
                    $('#order_stats').html(data.view)
                    $('#order_stats_top').html(data.order_stats_top)
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        $('.fetch-data-zone-wise').on('change',function (){
            let zone_id = $(this).val();
            fetch_data_zone_wise(zone_id)
        })

        function fetch_data_zone_wise(zone_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.dashboard-stats.zone')); ?>',
                data: {
                    zone_id: zone_id
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('zone_id', zone_id);
                    $('#order_stats_top').html(data.order_stats_top);
                    $('#order_stats').html(data.order_stats);
                    $('#stat_zone').html(data.stat_zone);
                    $('#user-overview-board').html(data.user_overview);
                    $('#monthly-earning-graph').html(data.monthly_graph);
                    $('#popular-restaurants-view').html(data.popular_restaurants);
                    $('#top-deliveryman-view').html(data.top_deliveryman);
                    $('#top-rated-foods-view').html(data.top_rated_foods);
                    $('#top-restaurants-view').html(data.top_restaurants);
                    $('#top-selling-foods-view').html(data.top_selling_foods);
                    loadchart();
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        $('.user-overview-stats-update').on('change',function (){
            let type = $(this).val();
            user_overview_stats_update(type)
        })

        function user_overview_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.dashboard-stats.user-overview')); ?>',
                data: {
                    user_overview: type
                },
                beforeSend: function () {
                    $('#loading').show()
                },
                success: function (data) {
                    insert_param('user_overview',type);
                    $('#user-overview-board').html(data.view)
                    loadchart();
                },
                complete: function () {
                    $('#loading').hide()
                }
            });
        }

        function insert_param(key, value) {
            key = encodeURIComponent(key);
            value = encodeURIComponent(value);
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/dashboard.blade.php ENDPATH**/ ?>