<div class="d-flex flex-row initial-47">
    <table class="table table--vertical-middle">
        <thead class="thead-light border-0 ">
        <tr>
            <th class="py-2" scope="col"><?php echo e(translate('Item')); ?></th>
            <th class="py-2" scope="col" class="text-center"><?php echo e(translate('Qty')); ?></th>
            <th class="py-2 text-center" scope="col" class="text-right"><?php echo e(translate('Price')); ?></th>
            <th class="py-2 text-center" scope="col"><?php echo e(translate('Delete')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php

        use App\CentralLogics\Helpers;

        $subtotal = 0;
        $addon_price = 0;
        $tax = isset($restaurant_data) ? $restaurant_data->tax : 0;
        $discount = 0;
        $discount_type = 'amount';
        $discount_on_product = 0;
        $variation_price = 0;
        ?>
        <?php if(session()->has('cart') && count(session()->get('cart')) > 0): ?>
                <?php
                $cart = session()->get('cart');
                if (isset($cart['tax'])) {
                    $tax = $cart['tax'];
                }
                if (isset($cart['discount'])) {
                    $discount = $cart['discount'];
                    $discount_type = $cart['discount_type'];
                }
                ?>
            <?php $__currentLoopData = session()->get('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_array($cartItem)): ?>

                        <?php
                        $variation_price += $cartItem['variation_price'];
                        $product_subtotal = ($cartItem['price'] * $cartItem['quantity']);
                        $discount_on_product += $cartItem['discount'] * $cartItem['quantity'];
                        $subtotal += $product_subtotal;
                        $addon_price += $cartItem['addon_price'];
                        $food_id= $cartItem['id'];
                        ?>
                    <tr>
                        <td class="media cart--media align-items-center cursor-pointer quick-View-Cart-Item"
                            data-product-id="<?php echo e($cartItem['id']); ?>" data-item-key="<?php echo e($key); ?>">
                            <img class="avatar avatar-sm mr-2 onerror-image"
                                 src="<?php echo e(Helpers::onerror_image_helper(
                            data_get($cartItem,'image'),
                            dynamicStorage('storage/app/public/product').'/'.data_get($cartItem,'image'),
                            dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                            'product/'
                        )); ?>"
                                 data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"
                                 alt="<?php echo e(data_get($cartItem,'image')); ?> image">
                            <div class="media-body">
                                <h5 class="text-hover-primary mb-0"><?php echo e(Str::limit($cartItem['name'], 12)); ?></h5>
                                <small><?php echo e(Str::limit($cartItem['variant'], 20)); ?></small>
                            </div>
                        </td>
                        <td class="align-items-center">
                            <label>
                                <input type="number" data-key="<?php echo e($key); ?>"  data-value="<?php echo e($cartItem['quantity']); ?>"
                                       value="<?php echo e($cartItem['quantity']); ?>"
                                       data-option_ids="<?php echo e($cartItem['variation_option_ids']); ?>"
                                       data-food_id="<?php echo e($food_id); ?>"

                                       min="1" max="<?php echo e($cartItem['maximum_cart_quantity'] ?? '9999999999'); ?>"
                                       class="rounded border border-secondary initial-48  update-Quantity">
                            </label>
                        </td>
                        <td class="px-0 py-1 text-center">
                            <div class="btn">
                                <?php echo e(Helpers::format_currency($product_subtotal)); ?>

                            </div>
                        </td>
                        <td class="align-items-center">
                            <div class="btn--container justify-content-center">
                                <a href="javascript:"
                                   data-product-id="<?php echo e($key); ?>"
                                   class="btn btn-sm btn--danger action-btn btn-outline-danger remove-From-Cart"> <i
                                        class="tio-delete-outlined"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
if (session()->get('address') && count(session()->get('address')) > 0) {
    $delivery_fee = session()->get('address')['delivery_fee'];
} else {
    $delivery_fee = 0;
}
$total = $subtotal + $addon_price;

$total = $total - $discount_on_product;
$tax_included =  Helpers::get_mail_status('tax_included')  ?? 0;
$total_tax_amount = $tax > 0 ? ($total * $tax) / 100 : 0;
$total = $total + $delivery_fee;
?>
<div class="box p-3">
    <dl class="row">

        <dt class="col-6"><?php echo e(translate('messages.addon')); ?>:</dt>
        <dd class="col-6 text-right"><?php echo e(Helpers::format_currency($addon_price)); ?></dd>

        <dt class="col-6"><?php echo e(translate('messages.subtotal')); ?>

            <?php ($tax_a=$total_tax_amount); ?>
            <?php if($tax_included ==  1): ?>
                (<?php echo e(translate('messages.TAX_Included')); ?>)
                <?php ($tax_a=0); ?>
            <?php endif; ?>
            :
        </dt>
        <dd class="col-6 text-right"><?php echo e(Helpers::format_currency($subtotal + $addon_price)); ?></dd>

        <dt class="col-6"><?php echo e(translate('messages.discount')); ?> :</dt>
        <dd class="col-6 text-right">-<?php echo e(Helpers::format_currency(round($discount_on_product, 2))); ?></dd>

        <dt class="col-6"><?php echo e(translate('messages.delivery_fee')); ?> :</dt>
        <dd class="col-6 text-right" id="delivery_price">
            <?php echo e(Helpers::format_currency($delivery_fee)); ?></dd>
        <?php if($tax_included !=  1): ?>
            <dt class="col-6"><?php echo e(translate('messages.tax')); ?> :</dt>
            <dd class="col-6 text-right">
                + <?php echo e(Helpers::format_currency(round($total_tax_amount, 2))); ?>

            </dd>

        <?php endif; ?>
        <dt class="col-6 pr-0">
            <hr class="mt-0"/>
        </dt>
        <dt class="col-6 pl-0">
            <hr class="mt-0"/>
        </dt>
        <dt class="col-6"><?php echo e(translate('Total')); ?>:</dt>
        <dd class="col-6 text-right h4 b">
            <?php echo e(Helpers::format_currency(round($total + $tax_a, 2))); ?> </dd>
    </dl>
    <form
        action="<?php echo e(route('admin.pos.order')); ?>?restaurant_id=<?php echo e($restaurant_data?->id ?? ''); ?>"
        id='order_place' method="post" >
        <?php echo csrf_field(); ?>
        <input type="hidden" name="user_id" id="customer_id">
        <input type="hidden" value="<?php echo e($food_id ?? null); ?>" id="cart_food_id">
        <div class="pos--payment-options mt-3 mb-3">
            <h5 class="mb-3"><?php echo e(translate('Payment_Method')); ?></h5>
            <ul>

                <?php ($cod=Helpers::get_business_settings('cash_on_delivery')); ?>
                <?php if($cod['status']): ?>
                    <li>
                        <label>
                            <input type="radio" <?php echo e(old('type') == 'cash' ? 'checked' :''); ?> name="type" value="cash" hidden checked>
                            <span><?php echo e(translate('Cash_On_Delivery')); ?></span>
                        </label>
                    </li>
                <?php endif; ?>
                <?php ($wallet=Helpers::get_business_settings('wallet_status')); ?>
                <?php if($wallet): ?>
                    <li>
                        <label>
                            <input type="radio" <?php echo e(old('type') == 'wallet' ? 'checked' :''); ?> name="type" value="wallet" hidden>
                            <span><?php echo e(translate('Wallet')); ?></span>
                        </label>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Static Data -->
        <div class="row button--bottom-fixed g-1 bg-white">
            <div class="col-sm-6">
                <button type="submit"
                        class="btn  btn--primary btn-sm btn-block place-order-submit"><?php echo e(translate('messages.place_order')); ?> </button>
            </div>
            <div class="col-sm-6">
                <a href="#" class="btn btn--reset btn-sm btn-block empty-Cart"><?php echo e(translate('Clear_Cart')); ?></a>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom py-3">
                <h5 class="modal-title flex-grow-1 text-center"><?php echo e(translate('Delivery_Information')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                if (session()->has('address')) {
                    $old = session()->get('address');
                } else {
                    $old = null;
                }
                $customer= session('customer') ?? null;
                ?>
                <form id='delivery_address_store'>
                    <?php echo csrf_field(); ?>

                    <div class="row g-2" id="delivery_address">
                        <div class="col-md-6">
                            <label for="contact_person_name" class="input-label"
                                   ><?php echo e(translate('messages.contact_person_name')); ?><span
                                    class="input-label-secondary text-danger">*</span></label>
                            <input  id="contact_person_name"  type="text" class="form-control" name="contact_person_name"
                                   value="<?php echo e($old ? $old['contact_person_name'] : $customer?->f_name.' '.$customer?->l_name); ?>"
                                   placeholder="<?php echo e(translate('messages.Ex:_Jhon')); ?> ">
                        </div>
                        <div class="col-md-6">
                            <label for="contact_person_number" class="input-label"
                                   ><?php echo e(translate('Contact Number')); ?><span
                                    class="input-label-secondary text-danger">*</span></label>
                            <input  id="contact_person_number"  type="tel" class="form-control" name="contact_person_number"
                                   value="<?php echo e($old ? $old['contact_person_number'] : $customer?->phone); ?>"
                                   placeholder="<?php echo e(translate('messages.Ex:_+3264124565')); ?> ">
                        </div>
                        <div class="col-md-4">
                            <label for="road" class="input-label" ><?php echo e(translate('messages.Road')); ?></label>
                            <input  id="road"  type="text" class="form-control" name="road" value="<?php echo e($old ? $old['road'] : ''); ?>"
                                   placeholder="<?php echo e(translate('messages.Ex:_4th')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="house" class="input-label" ><?php echo e(translate('messages.House')); ?></label>
                            <input  id="house"  type="text" class="form-control" name="house" value="<?php echo e($old ? $old['house'] : ''); ?>"
                                   placeholder="<?php echo e(translate('messages.Ex_:45/C')); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="floor" class="input-label" ><?php echo e(translate('messages.Floor')); ?></label>
                            <input  id="floor"  type="text" class="form-control" name="floor" value="<?php echo e($old ? $old['floor'] : ''); ?>"
                                   placeholder="<?php echo e(translate('messages.Ex:1A')); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="longitude" class="input-label" ><?php echo e(translate('messages.longitude')); ?><span
                                    class="input-label-secondary text-danger">*</span></label>
                            <input   type="text" class="form-control" id="longitude" name="longitude"
                                   value="<?php echo e($old ? $old['longitude'] : ''); ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="latitude" class="input-label" ><?php echo e(translate('messages.latitude')); ?><span
                                    class="input-label-secondary text-danger">*</span></label>
                            <input   type="text" class="form-control" id="latitude" name="latitude"
                                   value="<?php echo e($old ? $old['latitude'] : ''); ?>" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="input-label" ><?php echo e(translate('messages.address')); ?></label>
                            <textarea  id="address" name="address" class="form-control" cols="30" rows="3"
                                      placeholder="<?php echo e(translate('messages.Ex:_address')); ?> "><?php echo e($old ? $old['address'] : ''); ?></textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-primary">
                                    <?php echo e(translate('*_pin_the_address_in_the_map_to_calculate_delivery_fee')); ?>

                                </span>
                                <div>
                                    <input type="hidden" name="distance" id="distance">
                                    <span><?php echo e(translate('Delivery_fee')); ?> :</span>
                                    <input type="hidden" name="delivery_fee" id="delivery_fee"
                                           value="<?php echo e($old ? $old['delivery_fee'] : ''); ?>">
                                    <strong><?php echo e($old ? $old['delivery_fee'] : 0); ?> <?php echo e(Helpers::currency_symbol()); ?></strong>
                                </div>
                            </div>
                            <input id="pac-input" class="controls rounded initial-8"
                                   title="<?php echo e(translate('messages.search_your_location_here')); ?>" type="text"
                                   placeholder="<?php echo e(translate('messages.search_here')); ?>"/>
                            <div class="mb-2 h-200px" id="map"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="btn--container justify-content-end">
                            <button class="btn btn-sm btn--primary w-100 delivery-Address-Store" type="button">
                                <?php echo e(translate('Update_Delivery_Address')); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/pos/_cart.blade.php ENDPATH**/ ?>