<?php use App\CentralLogics\Helpers; ?>
<div class="product-card cursor-pointer card quick-View" data-id="<?php echo e($product->id); ?>">
    <div class="card-header inline_product clickable p-0 initial-50">
        <div class="d-flex align-items-center justify-content-center d-block">
            <img class="w-100 rounded onerror-image"
                 src="<?php echo e(Helpers::onerror_image_helper(
                        data_get($product,'image'),
                        dynamicStorage('storage/app/public/product').'/'.data_get($product,'image'),
                        dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                        'product/'
                    )); ?>"
                 data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"
                 data-zoom="<?php echo e(dynamicStorage('storage/app/public/product')); ?>/<?php echo e(data_get($product,'image')); ?>"
                 alt="Product image">
        </div>
    </div>

    <div class="card-body inline_product text-center py-2 px-2 clickable">
        <div class="position-relative product-title1 text-dark font-weight-bold text-capitalize">
            <?php echo e(Str::limit($product['name'], 12, '...')); ?>

        </div>
        <div class="justify-content-between text-center">
            <div class="product-price text-center">
                <span class="text-accent font-weight-bold text-yellow">
                    <?php echo e(Helpers::format_currency($product['price'] - Helpers::product_discount_calculate($product, $product['price'], $restaurant_data))); ?>

                </span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/pos/_single_product.blade.php ENDPATH**/ ?>