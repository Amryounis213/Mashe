<?php $__env->startSection('title',translate('messages.bonus')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mr-3">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/money.png')); ?>" class="w--26" alt="">
                </span>
                <span>
                     <?php echo e(translate("messages.bonus")); ?>

                </span>
            </h1>
        </div>
        <!-- Page Header -->
        <div class="card gx-2 gx-lg-3">
            <div class="card-body">
                <form action="<?php echo e(route('admin.delivery-man.bonus')); ?>" method="post" enctype="multipart/form-data" id="add_fund">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="customer"><?php echo e(translate('messages.DeliveryMan')); ?></label>
                                <select id='customer' name="delivery_man_id" data-placeholder="<?php echo e(translate('messages.select_delivery_man')); ?>" class="js-data-example-ajax form-control" required>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="amount"><?php echo e(translate("messages.amount")); ?></label>

                                <input type="number" class="form-control" name="amount" id="amount" step=".01" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-label" for="referance"><?php echo e(translate('messages.reference')); ?> <small>(<?php echo e(translate('messages.optional')); ?>)</small></label>

                                <input type="text" class="form-control" name="referance" id="referance">
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="submit" id="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </form>
            </div>
            <!-- End Table -->
        </div>

        <!-- Card -->
        <div class="card mt-3">
            <!-- Header -->
            <div class="card-header border-0">
                <h4 class="card-title">
                    <span class="card-header-icon">
                    </span>
                    <span><?php echo e(translate('messages.transactions')); ?></span>
                    <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($data->total()); ?></span>
                </h4>
                <form>
                    <!-- Search -->
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search"  value="<?php echo e(request()->search ?? null); ?>"  class="form-control"
                            placeholder="<?php echo e(translate('Search_by_name_or_transaction_id')); ?>" aria-label="Search">
                        <button type="submit" class="btn btn--secondary">
                            <i class="tio-search"></i>
                        </button>
                    </div>
                    <!-- End Search -->
                </form>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-thead-bordered table-align-middle card-table table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0"><?php echo e(translate('messages.sl')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.transaction_id')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.DeliveryMan')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.bonus')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.reference')); ?></th>
                                <th class="border-0"><?php echo e(translate('messages.created_at')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$wt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td ><?php echo e($k+$data->firstItem()); ?></td>
                                <td><?php echo e($wt->transaction_id); ?></td>
                                <td>
                                    <?php if($wt->delivery_man): ?>
                                    <a href="<?php echo e(route('admin.delivery-man.preview',[$wt['delivery_man_id']])); ?>"><?php echo e(Str::limit($wt->delivery_man->f_name.' '.$wt->delivery_man->l_name ,20,'...')); ?></a>
                                    <?php else: ?>
                                    <?php echo e(translate(('messages.not_found'))); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(\App\CentralLogics\Helpers::format_currency($wt->credit)); ?></td>
                                <td><?php echo e($wt->reference); ?></td>
                                <td>
                                    <span class="d-block">
                                        <?php echo e(\App\CentralLogics\Helpers::date_format($wt['created_at'])); ?> </span>
                                    <span class="d-block"> <?php echo e(\App\CentralLogics\Helpers::time_format($wt['created_at'])); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Body -->
            <?php if(count($data) !== 0): ?>
            <hr>
            <?php endif; ?>
            <div class="page-area">
                <?php echo $data->withQueryString()->links(); ?>

            </div>
            <?php if(count($data) === 0): ?>
            <div class="empty--data">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                <h5>
                    <?php echo e(translate('no_data_found')); ?>

                </h5>
            </div>
            <?php endif; ?>
        </div>
        <!-- End Card -->
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
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });


        $('#add_fund').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);

            Swal.fire({
                title: '<?php echo e(translate('messages.Are_you_sure_?')); ?>',
                text: '<?php echo e(translate('messages.you_want_to_add_bonus')); ?>'+$('#amount').val()+' <?php echo e(\App\CentralLogics\Helpers::currency_code().' '.translate('messages.to')); ?> '+$('#customer option:selected').text(),
                type: 'info',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: 'primary',
                cancelButtonText: '<?php echo e(translate('messages.no')); ?>',
                confirmButtonText: '<?php echo e(translate('messages.add')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post({
                        url: '<?php echo e(route('admin.delivery-man.bonus')); ?>',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#loading').show();
                        },
                        success: function (data) {
                            $('#loading').hide();
                            if (data.errors) {
                                for (let i = 0; i < data.errors.length; i++) {
                                    toastr.error(data.errors[i].message, {
                                        CloseButton: true,
                                        ProgressBar: true
                                    });
                                }
                            } else {
                                toastr.success('<?php echo e(translate("messages.bonus_added_successfulley")); ?>', {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);

                            }
                        },
                    });
                }
            })
        })

        $('.js-data-example-ajax').select2({
            ajax: {
                url: '<?php echo e(url('/')); ?>/admin/delivery-man/get-deliverymen',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                    results: data
                    };
                },
                __port: function (params, success, failure) {
                    let $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/delivery-man/bonus.blade.php ENDPATH**/ ?>