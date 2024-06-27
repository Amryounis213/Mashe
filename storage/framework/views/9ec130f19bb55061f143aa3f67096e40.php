<?php $__env->startSection('title', translate('Add_new_country')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/zone.png')); ?>" alt="" class="mr-2">
                        <?php echo e(translate('messages.Add_New_Country')); ?>

                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="javascript:" method="post" id="zone_form" class="shadow--card">
                    <?php echo csrf_field(); ?>
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <div class="zone-setup-instructions">
                                <div class="zone-setup-top">
                                    <h6 class="subtitle"><?php echo e(translate('messages.instructions')); ?></h6>
                                    <p>
                                        <?php echo e(translate('messages.Create_&_connect_dots_in_a_specific_area_on_the_map_to_add_a_new_business_zone.')); ?>

                                    </p>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="tio-hand-draw"></i>
                                    </div>
                                    <div class="info">
                                        <?php echo e(translate('messages.Use_this_‘Hand_Tool’_to_find_your_target_zone.')); ?>

                                    </div>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="tio-free-transform"></i>
                                    </div>
                                    <div class="info">
                                        <?php echo e(translate('messages.Use_this_‘Shape_Tool’_to_point_out_the_areas_and_connect_the_dots._A_minimum_of_3_points/dots_is_required.')); ?>

                                    </div>
                                </div>
                                <div class="instructions-image mt-4">
                                    <img src=<?php echo e(dynamicAsset('public/assets/admin/img/instructions.gif')); ?>

                                        alt="instructions">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-7 zone-setup">
                            <div class="pl-xl-5 pl-xxl-0">
                                <?php ($language = \App\Models\BusinessSetting::where('key', 'language')->first()); ?>
                                <?php ($language = $language?->value); ?>
                                <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                                <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link active" href="#"
                                            id="default-link"><?php echo e(translate('messages.default')); ?></a>
                                    </li>
                                    <?php if($language): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link" href="#"
                                                    id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <span class="form-label-secondary text-danger mt-2" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Choose_your_preferred_language_&_set_your_zone_name.')); ?>"><img
                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                            alt="<?php echo e(translate('messages.veg_non_veg')); ?>"></span>
                                </ul>
                                <div class="tab-content">


                                    <div class="form-group mb-3 lang_form" id="default-form">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.country_name')); ?>

                                            (<?php echo e(translate('messages.default')); ?>)</label>
                                        <input type="text" name="name[]" class="form-control"
                                            placeholder="<?php echo e(translate('messages.Type_new_zone_name_here')); ?>"
                                            maxlength="191" id="default-form-input"
                                            oninvalid="document.getElementById('default-form-input').click()">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">



                                    <?php if($language): ?>
                                        <?php $__empty_1 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="form-group mb-3 d-none lang_form" id="<?php echo e($lang); ?>-form">
                                                <label class="input-label"
                                                    for="exampleFormControlInput1"><?php echo e(translate('messages.country_name')); ?>

                                                    (<?php echo e(strtoupper($lang)); ?>)
                                                </label>
                                                <input id="name" type="text" name="name[]"
                                                    class="form-control h--45px"
                                                    placeholder="<?php echo e(translate('messages.Type_new_zone_name_here')); ?>">
                                            </div>
                                            <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>


                                <div class="d-flex justify-content-between">
                     
                                    <div class="form-group mb-6 " id="code">
                                        <label class="input-label" for="code"><?php echo e(translate('messages.country_code')); ?> </label>
                                        <input type="text" name="code"  class="form-control" placeholder="<?php echo e(translate('messages.country_code')); ?>" maxlength="191"   >
                                    </div>
                                    <div class="form-group mb-6 " id="currency">
                                        <label class="input-label" for="currency"><?php echo e(translate('messages.currency')); ?> </label>
                                        <input type="text" name="currency"  class="form-control" placeholder="<?php echo e(translate('messages.currency')); ?>" maxlength="191"   >
                                    </div>
                            
                                </div>


                                <div class="form-group mb-3 d-none">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('Coordinates')); ?><span
                                            class="form-label-secondary" data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.draw_your_zone_on_the_map')); ?>"><?php echo e(translate('messages.draw_your_zone_on_the_map')); ?></span></label>
                                    <textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly></textarea>
                                </div>

                                <div class="map-warper overflow-hidden rounded">
                                    <input id="pac-input" class="controls rounded initial-8"
                                        title="<?php echo e(translate('messages.search_your_location_here')); ?>" type="text"
                                        placeholder="<?php echo e(translate('messages.search_here')); ?>" />
                                    <div id="map-canvas" class="h-100 m-0 p-0"></div>
                                </div>
                                <div class="btn--container mt-3 justify-content-end">
                                    <button id="reset_btn" type="button"
                                        class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                                    <button type="submit"
                                        class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-12 col-lg-12 mb-3 my-lg-2">
                <div class="card">
                    <div class="card-header py-2 flex-wrap border-0 align-items-center">
                        <div class="search--button-wrapper">
                            <h5 class="card-title"><?php echo e(translate('messages.country_list')); ?><span
                                    class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($countries->total()); ?></span>
                            </h5>
                            <form class="my-2 mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                                <!-- Search -->

                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        value="<?php echo e(request()?->search ?? null); ?>"
                                        placeholder="<?php echo e(translate('messages.Search_by_name')); ?>"
                                        aria-label="<?php echo e(translate('messages.search')); ?>">
                                    <button type="submit" class="btn btn--secondary">
                                        <i class="tio-search"></i>
                                    </button>
                                </div>
                                <!-- End Search -->
                            </form>
                            <!-- Unfold -->
                            
                            <!-- End Unfold -->
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                            data-hs-datatables-options='{
                                    "order": [],
                                    "orderCellsTop": true,
                                    "paging":false
                                }'>
                            <thead class="thead-light">
                                <tr>
                                    
                                    <th class="text-center"><?php echo e(translate('messages.country_id')); ?></th>
                                    <th class="pl-5"><?php echo e(translate('messages.name')); ?></th>
                                    <th class="text-center"><?php echo e(translate('messages.code')); ?></th>
                                    <th class="text-center"><?php echo e(translate('messages.currency')); ?></th>
                                 

                                    <th><?php echo e(translate('messages.status')); ?></th>
                                    <th class="w-40px text-center"><?php echo e(translate('messages.action')); ?></th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">

                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        
                                        <td class="text-center">
                                            <span class="move-left">
                                                <?php echo e($country->id); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="move-left">
                                                <?php echo e($country->name); ?>

                                            </span>
                                        </td>
                                        <td class="pl-5">
                                            <span class="d-block font-size-sm text-body">
                                                <?php echo e($country->code ?? '--'); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="move-left">
                                                <?php echo e($country->currency ?? '--'); ?>

                                            </span>
                                        </td>
                                       

                                        <td>
                                            <label class="toggle-switch toggle-switch-sm">
                                                <input type="checkbox" class="toggle-switch-input dynamic-checkbox"
                                                    id="status-<?php echo e($country['id']); ?>"
                                                    <?php echo e($country->is_active ? 'checked' : ''); ?>

                                                    data-id="status-<?php echo e($country['id']); ?>" data-type="status"
                                                    data-image-on='<?php echo e(dynamicAsset('/public/assets/admin/img/modal')); ?>/zone-status-on.png'
                                                    data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal')); ?>/zone-status-off.png"
                                                    data-title-on="<?php echo e(translate('Want_to_activate_this_country?')); ?>"
                                                    data-title-off="<?php echo e(translate('Want_to_deactivate_this_country?')); ?>">
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <form
                                                action="<?php echo e(route('admin.country.status', [$country['id'], $country->is_active ? 0 : 1])); ?>"
                                                method="get" id="status-<?php echo e($country['id']); ?>_form">
                                            </form>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">
                                                <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                    href="<?php echo e(route('admin.country.edit', [$country['id']])); ?>"
                                                    title="<?php echo e(translate('messages.edit_country')); ?>"><i
                                                        class="tio-edit"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn--container justify-content-center">

                                                <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                                    href="javascript:" data-id="country-<?php echo e($country['id']); ?>"
                                                    data-message="<?php echo e(translate('messages.Want_to_delete_this_country')); ?>"
                                                    title="<?php echo e(translate('messages.delete_country')); ?>"><i
                                                        class="tio-delete-outlined"></i>
                                                </a>
                                                <form action="<?php echo e(route('admin.country.delete', [$country['id']])); ?>"
                                                    method="post" id="country-<?php echo e($country['id']); ?>">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                                </form>



                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($countries) === 0): ?>
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
                                    <?php echo $countries->withQueryString()->links(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

    <div class="modal fade" id="warning-modal">
        <div class="modal-dialog modal-lg warning-modal">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <h3 class="modal-title mb-3"><?php echo e(translate('messages.New_Business_Zone_Created_Successfully!')); ?>

                        </h3>
                        <p class="txt">
                            <?php echo e(translate('messages.NEXT_IMPORTANT_STEP:_You_need_to_add_‘Delivery_Charge’_with_other_details_from_the_Zone_Settings._If_you_don’t_add_a_delivery_charge,_the_Zone_you_created_won’t_function_properly.')); ?>

                        </p>
                    </div>
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/zone-instruction.png')); ?>" alt="admin/img"
                        class="w-100">
                    <div class="mt-3 d-flex flex-wrap align-items-center justify-content-between">
                        <label class="form-check form--check m-0">
                        </label>
                        <div class="btn--container justify-content-end">
                            <button id="reset_btn" type="reset" class="btn btn--reset"
                                data-dismiss="modal"><?php echo e(translate('messages.I_Will_Do_It_Later')); ?></button>
                            <a href="<?php echo e(route('admin.zone.latest-settings')); ?>"
                                class="btn btn--primary"><?php echo e(translate('messages.Go_to_Zone_Settings')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&libraries=drawing,places&v=3.45.8">
    </script>
    <script>
        "use strict";

        $('.hide-data').click(function() {
            $(".hide_data").removeClass('active');
        })

        function status_form_alert(id, message, e) {
            e.preventDefault();
            Swal.fire({
                title: "<?php echo e(translate('messages.are_you_sure_?')); ?>",
                text: message,
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonColor: 'var(--secondary-clr)',
                confirmButtonColor: 'var(--primary-clr)',
                cancelButtonText: '<?php echo e(translate('Cancel')); ?>',
                confirmButtonText: '<?php echo e(translate('yes')); ?>',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#' + id).submit()
                }
            })
        }
        // auto_grow();
        // function auto_grow() {
        //     let element = document.getElementById("coordinates");
        //     element.style.height = "5px";
        //     element.style.height = (element.scrollHeight)+"px";
        // }


        // $(document).on('ready', function () {
        //     // INITIALIZATION OF DATATABLES
        //     // =======================================================
        //     let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

        //     $('#column1_search').on('keyup', function () {
        //         datatable
        //             .columns(1)
        //             .search(this.value)
        //             .draw();
        //     });


        //     $('#column3_search').on('change', function () {
        //         datatable
        //             .columns(2)
        //             .search(this.value)
        //             .draw();
        //     });


        //     // INITIALIZATION OF SELECT2
        //     // =======================================================
        //     $('.js-select2-custom').each(function () {
        //         let select2 = $.HSCore.components.HSSelect2.init($(this));
        //     });

        //     $("#country_form").on('keydown', function(e){
        //         if (e.keyCode === 13) {
        //             e.preventDefault();
        //         }
        //     })
        // });

        let map; // Global declaration of the map
        let drawingManager;
        let lastpolygon = null;
        let polygons = [];

        function resetMap(controlDiv) {
            // Set CSS for the control border.
            const controlUI = document.createElement("div");
            controlUI.style.backgroundColor = "#fff";
            controlUI.style.border = "2px solid #fff";
            controlUI.style.borderRadius = "3px";
            controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
            controlUI.style.cursor = "pointer";
            controlUI.style.marginTop = "8px";
            controlUI.style.marginBottom = "22px";
            controlUI.style.textAlign = "center";
            controlUI.title = "Reset map";
            controlDiv.appendChild(controlUI);
            // Set CSS for the control interior.
            const controlText = document.createElement("div");
            controlText.style.color = "rgb(25,25,25)";
            controlText.style.fontFamily = "Roboto,Arial,sans-serif";
            controlText.style.fontSize = "10px";
            controlText.style.lineHeight = "16px";
            controlText.style.paddingLeft = "2px";
            controlText.style.paddingRight = "2px";
            controlText.innerHTML = "X";
            controlUI.appendChild(controlText);
            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener("click", () => {
                lastpolygon.setMap(null);
                $('#coordinates').val('');

            });
        }

        function initialize() {
            <?php ($default_location = \App\Models\BusinessSetting::where('key', 'default_location')->first()); ?>
            <?php ($default_location = $default_location->value ? json_decode($default_location->value, true) : 0); ?>
            let myLatlng = {
                lat: <?php echo e($default_location ? $default_location['lat'] : '23.757989'); ?>,
                lng: <?php echo e($default_location ? $default_location['lng'] : '90.360587'); ?>

            };


            let myOptions = {
                zoom: 5,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                    editable: true
                }
            });
            drawingManager.setMap(map);


            //get current location block
            // infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(pos);
                    });
            }

            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                if (lastpolygon) {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
            });

            const resetDiv = document.createElement("div");
            resetMap(resetDiv, lastpolygon);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        auto_grow();

        function auto_grow() {
            let element = document.getElementById("coordinates");
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }


        $(document).on('ready', function() {
            set_all_zones();
        });


        $('#reset_btn').click(function() {
            $('.tab-content').find('input:text').val('');
            // lastpolygon.setMap(null);
            // $('#coordinates').val(null);
        })



        $(document).on('ready', function() {

            $("#maximum_shipping_charge_status").on('change', function() {
                if ($("#maximum_shipping_charge_status").is(':checked')) {
                    $('#maximum_shipping_charge').removeAttr('readonly');
                } else {
                    $('#maximum_shipping_charge').attr('readonly', true);
                    $('#maximum_shipping_charge').val('Ex : 0');
                }
            });
            $("#max_cod_order_amount_status").on('change', function() {
                if ($("#max_cod_order_amount_status").is(':checked')) {
                    $('#max_cod_order_amount').removeAttr('readonly');
                } else {
                    $('#max_cod_order_amount').attr('readonly', true);
                    $('#max_cod_order_amount').val('Ex : 0');
                }
            });



        });



        $('#zone_form').on('submit', function() {
            // alert('hi');
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.country.store')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    if (data.errors) {
                        for (let i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        $('.tab-content').find('input:text').val('');
                        $('input[name="name"]').val(null);
                        // lastpolygon.setMap(null);
                        $('#coordinates').val(null);
                        toastr.success(
                        "<?php echo e(translate('messages.New_country_Created_Successfully!')); ?>", {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        $('#set-rows').html(data.view);
                        $('#itemCount').html(data.total);
                        // $("#warning-modal").modal("show");
                    }
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/country/index.blade.php ENDPATH**/ ?>