<?php
use App\CentralLogics\Helpers;
use App\Models\AddOn;
use App\Scopes\RestaurantScope;
?>
<div class="initial-49">
    <div class="modal-header p-0">
        <h4 class="modal-title product-title">
        </h4>
        <button class="close call-when-done" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="d-flex flex-row align-items-center">
            <?php if(config('toggle_veg_non_veg')): ?>
            <span class="badge badge-<?php echo e($product->veg ? 'success' : 'danger'); ?> position-absolute"><?php echo e($product->veg ?
                translate('messages.veg') : translate('messages.non_veg')); ?></span>
            <?php endif; ?>
            <?php if($product?->stock_type !=='unlimited' && $product->item_stock <= 0): ?>
            <span class="badge badge-danger position-absolute"><?php echo e(translate('messages.Out_of_Stock')); ?></span>
            <?php endif; ?>

            <div class="d-flex align-items-center justify-content-center active h-9rem">
                <img class="img-responsive mr-3 img--100 onerror-image" src="<?php echo e(Helpers::onerror_image_helper(
                        data_get($product, 'image'),
                        dynamicStorage('storage/app/public/product') . '/' . data_get($product, 'image'),
                        dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                        'product/',
                    )); ?>"
                    data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"
                    data-zoom="<?php echo e(dynamicStorage('storage/app/public/product')); ?>/<?php echo e(data_get($product, 'image')); ?>"
                    alt="Product image">

                <div class="cz-image-zoom-pane"></div>
            </div>
            <div class="details pl-2">
                <a href="<?php echo e(route('admin.food.view', $product->id)); ?>"
                    class="h3 mb-2 product-title text-capitalize text-break"><?php echo e($product->name); ?></a>

                <div class="mb-3 text-dark">
                    <span class="h3 font-weight-normal text-accent mr-1">
                        <?php echo e(Helpers::get_price_range($product, true)); ?>

                    </span>
                    <?php if($product->discount > 0 || Helpers::get_restaurant_discount($product->restaurant)): ?>
                    <span class="fz-12px line-through">
                        <?php echo e(Helpers::get_price_range($product)); ?>

                    </span>
                    <?php endif; ?>
                </div>
                <?php if($product->discount > 0): ?>
                <div class="mb-3 text-dark">
                    <strong><?php echo e(translate('messages.discount')); ?> : </strong>
                    <strong id="set-discount-amount"><?php echo e(Helpers::get_product_discount($product)); ?></strong>
                </div>
                <?php endif; ?>

            </div>
        </div>

        <div class="row pt-2">
            <div class="col-12">
                    <?php
                        $cart = false;
                        if (session()->has('cart')) {
                            foreach (session()->get('cart') as $key => $cartItem) {
                                if (is_array($cartItem) && $cartItem['id'] == $product['id']) {
                                    $cart = $cartItem;
                                }
                            }
                        }
                    ?>
                <h2><?php echo e(translate('messages.description')); ?></h2>
                <span class="d-block text-dark text-break">
                    <?php echo $product->description; ?>

                </span>
                <form id="add-to-cart-form" class="mb-2">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">

                    <?php $__currentLoopData = json_decode($product->variations); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($choice->price) == false): ?>
                    <div class="h3 p-0 pt-2"><?php echo e($choice->name); ?> <small class="text-muted fs-12">
                            (<?php echo e($choice->required == 'on' ? translate('messages.Required') :
                            translate('messages.optional')); ?>

                            ) </small>
                    </div>
                    <?php if($choice->min != 0 && $choice->max != 0): ?>
                    <small class="d-block mb-3">
                        <?php echo e(translate('You_need_to_select_minimum_ ')); ?> <?php echo e($choice->min); ?>

                        <?php echo e(translate('to_maximum_ ')); ?> <?php echo e($choice->max); ?> <?php echo e(translate('options')); ?>

                    </small>
                    <?php endif; ?>

                    <div>
                        <input type="hidden" name="variations[<?php echo e($key); ?>][min]" value="<?php echo e($choice->min); ?>">
                        <input type="hidden" name="variations[<?php echo e($key); ?>][max]" value="<?php echo e($choice->max); ?>">
                        <input type="hidden" name="variations[<?php echo e($key); ?>][required]" value="<?php echo e($choice->required); ?>">
                        <input type="hidden" name="variations[<?php echo e($key); ?>][name]" value="<?php echo e($choice->name); ?>">
                        <?php $__currentLoopData = $choice->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check form--check d-flex pr-5 mr-6">
                            <input
                                class="form-check-input input-element <?php echo e(data_get($option, 'stock_type') && data_get($option, 'stock_type') !== 'unlimited' && data_get($option, 'current_stock') <= 0? 'stock_out' : ''); ?>"
                                type="<?php echo e($choice->type == 'multi' ? 'checkbox' : 'radio'); ?>"
                                id="choice-option-<?php echo e($key); ?>-<?php echo e($k); ?>"
                                data-option_id="<?php echo e(data_get($option, 'option_id')); ?>"
                                name="variations[<?php echo e($key); ?>][values][label][]" value="<?php echo e($option->label); ?>"
                                <?php echo e(data_get($option, 'stock_type') && data_get($option, 'stock_type') !== 'unlimited' && data_get($option, 'current_stock') <= 0? 'disabled' : ''); ?> autocomplete="off">

                            <label
                                class="form-check-label  <?php echo e(data_get($option, 'stock_type') && data_get($option, 'stock_type') !== 'unlimited' && data_get($option, 'current_stock') <= 0? 'stock_out text-muted' : 'text-dark'); ?>"
                                for="choice-option-<?php echo e($key); ?>-<?php echo e($k); ?>"><?php echo e(Str::limit($option->label, 20, '...')); ?>

                                &nbsp;
                                <span
                                    class="input-label-secondary text--title text--warning <?php echo e(data_get($option, 'stock_type') && data_get($option, 'stock_type') !== 'unlimited' && data_get($option, 'current_stock') <= 0? '' : 'd-none'); ?>"
                                    title="<?php echo e(translate('Currently_you_need_to_manage_discount_with_the_Restaurant.')); ?>">
                                    <i class="tio-info-outined"></i>
                                    <small><?php echo e(translate('stock_out')); ?></small>
                                </span>
                            </label>
                            <span class="ml-auto"><?php echo e(Helpers::format_currency($option->optionPrice)); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <input type="hidden" hidden name="option_ids" id="option_ids" >
                    <div class="d-flex justify-content-between mt-4">
                        <div class="product-description-label mt-2 text-dark h3"><?php echo e(translate('messages.quantity')); ?>:
                        </div>
                        <div class="product-quantity d-flex align-items-center">
                            <div class="input-group input-group--style-2 pr-3 w-160px">
                                <span class="input-group-btn">
                                    <button class="btn btn-number text-dark p--10px" type="button" data-type="minus"
                                        data-field="quantity" disabled="disabled">
                                        <i class="tio-remove  font-weight-bold"></i>
                                    </button>
                                </span>
                                <input type="text" name="quantity"  id="add_new_product_quantity"
                                    class="form-control input-number text-center cart-qty-field" placeholder="1"
                                    value="1" min="1" data-maximum_cart_quantity='<?php echo e(min( $product?->maximum_cart_quantity ?? '9999999999',$product?->stock_type =='unlimited' ? '999999999' : $product?->item_stock)); ?>' max="<?php echo e($product->maximum_cart_quantity ?? '9999999999'); ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-number text-dark p--10px" id="quantity_increase_button" type="button" data-type="plus"
                                        data-field="quantity">
                                        <i class="tio-add  font-weight-bold"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php ($add_ons = json_decode($product->add_ons)); ?>
                    <?php if(count($add_ons) > 0 && $add_ons[0]): ?>
                    <div class="h3 p-0 pt-2"><?php echo e(translate('messages.addon')); ?></div>

                    <div class="d-flex justify-content-left flex-wrap">
                        <?php $__currentLoopData = AddOn::withoutGlobalScope(RestaurantScope::class)->whereIn('id',
                        $add_ons)->active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $add_on): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex-column pb-2">
                            <input type="hidden" name="addon-price<?php echo e($add_on->id); ?>" value="<?php echo e($add_on->price); ?>">
                            <input class="btn-check addon-chek addon-quantity-input-toggle" type="checkbox"
                                id="addon<?php echo e($key); ?>" name="addon_id[]" value="<?php echo e($add_on->id); ?>" autocomplete="off">
                            <label class="d-flex align-items-center btn btn-sm check-label mx-1 addon-input text-break"
                                for="addon<?php echo e($key); ?>"><?php echo e(Str::limit($add_on->name, 20, '...')); ?>

                                <br>
                                <?php echo e(Helpers::format_currency($add_on->price)); ?></label>
                            <label class="input-group addon-quantity-input mx-1 shadow bg-white rounded px-1"
                                for="addon<?php echo e($key); ?>">
                                <button class="btn btn-sm h-100 text-dark px-0 decrease-button"
                                    data-id="<?php echo e($add_on->id); ?>" type="button"><i
                                        class="tio-remove  font-weight-bold"></i></button>
                                <input type="number" name="addon-quantity<?php echo e($add_on->id); ?>"
                                    id="addon_quantity_input<?php echo e($add_on->id); ?>"
                                    class="form-control text-center border-0 h-100" placeholder="1" value="1" min="1"
                                    max="9999999999" readonly>
                                <button class="btn btn-sm h-100 text-dark px-0 increase-button" id="addon_quantity_button<?php echo e($add_on->id); ?>"
                                    data-id="<?php echo e($add_on->id); ?>" type="button"><i
                                        class="tio-add  font-weight-bold"></i></button>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="row no-gutters d-none mt-2 text-dark" id="chosen_price_div">
                        <div class="col-2">
                            <div class="product-description-label"><?php echo e(translate('messages.Total_Price')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <?php if($product?->stock_type !=='unlimited' && $product->item_stock <= 0): ?>
                            <button class="btn btn-secondary h--45px w-40p " type="button">
                                <i class="tio-shopping-cart"></i>
                                <?php echo e(translate('messages.Out_Of_Stock')); ?>

                            </button>
                        <?php else: ?>
                            <button class="btn btn--primary h--45px w-40p add-To-Cart" type="button">
                                <i class="tio-shopping-cart"></i>
                                <?php echo e(translate('messages.add_to_cart')); ?>

                            </button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    "use strict";
    cartQuantityInitialize();
    getVariantPrice();
    $('#add-to-cart-form input').on('change', function() {
        getVariantPrice();
    });


    function getCheckedInputs() {
        var checkedInputs = [];
    var checkedElements = document.querySelectorAll('.input-element:checked');
    checkedElements.forEach(function(element) {
        checkedInputs.push(element.getAttribute('data-option_id'));
    });

    $('#option_ids').val(checkedInputs.join(','));

    }
    var inputElements = document.querySelectorAll('.input-element');
    inputElements.forEach(function(element) {
        element.addEventListener('change', getCheckedInputs);
    });
</script>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/pos/_quick-view-data.blade.php ENDPATH**/ ?>