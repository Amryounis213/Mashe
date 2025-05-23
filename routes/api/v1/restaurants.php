<?php

use App\Http\Controllers\Api\App\FavouriteController;
use Illuminate\Support\Facades\Route;
use App\WebSockets\Handler\DMLocationSocketHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api\Restaurant', 'middleware'=>['localization']], function () {
   
    Route::post('/login', 'AuthController@login');

    Route::group(['prefix' => 'vendor', 'namespace' => 'Vendor', 'middleware'=>['vendor.api']], function () {
        Route::get('notifications', 'VendorController@get_notifications');
        Route::get('profile', 'VendorController@get_profile');
        Route::post('update-active-status', 'VendorController@active_status');
        Route::get('earning-info', 'VendorController@get_earning_data');
        Route::put('update-profile', 'VendorController@update_profile');
        Route::get('current-orders', 'VendorController@get_current_orders');
        Route::get('completed-orders', 'VendorController@get_completed_orders');
        Route::get('all-orders', 'VendorController@get_all_orders');
        Route::put('update-order-status', 'VendorController@update_order_status');
        Route::get('order-details', 'VendorController@get_order_details');
        Route::get('order', 'VendorController@get_order');
        Route::put('update-fcm-token', 'VendorController@update_fcm_token');
        Route::get('get-basic-campaigns', 'VendorController@get_basic_campaigns');
        Route::put('campaign-leave', 'VendorController@remove_restaurant');
        Route::put('campaign-join', 'VendorController@addrestaurant');
        Route::get('get-withdraw-list', 'VendorController@withdraw_list');
        Route::get('get-products-list', 'VendorController@get_products');
        Route::put('update-bank-info', 'VendorController@update_bank_info');
        Route::post('request-withdraw', 'VendorController@request_withdraw');

        Route::put('update-announcment', 'VendorController@update_announcment');

        Route::post('make-collected-cash-payment', 'VendorController@make_payment')->name('make_payment');
        Route::post('make-wallet-adjustment', 'VendorController@make_wallet_adjustment')->name('make_wallet_adjustment');

        Route::get('wallet-payment-list', 'VendorController@wallet_payment_list')->name('wallet_payment_list');

        //Report
        Route::get('get-expense', 'ReportController@expense_report');
        Route::get('get-transaction-report', 'ReportController@day_wise_report');
        Route::get('get-order-report', 'ReportController@order_report');
        Route::get('get-campaign-order-report', 'ReportController@campaign_order_report');
        Route::get('get-food-wise-report', 'ReportController@food_wise_report');
        Route::get('get-disbursement-report', 'ReportController@disbursement_report');


        Route::get('get-withdraw-method-list', 'VendorController@withdraw_method_list');

        Route::group(['prefix' => 'withdraw-method'], function () {
            Route::get('list', 'WithdrawMethodController@get_disbursement_withdrawal_methods');
            Route::post('store', 'WithdrawMethodController@disbursement_withdrawal_method_store');
            Route::post('make-default', 'WithdrawMethodController@disbursement_withdrawal_method_default');
            Route::delete('delete', 'WithdrawMethodController@disbursement_withdrawal_method_delete');
        });

        Route::get('coupon-list', 'CouponController@list');
        Route::get('coupon-view', 'CouponController@view');
        Route::post('coupon-store', 'CouponController@store')->name('store');
        Route::post('coupon-update', 'CouponController@update');
        Route::post('coupon-status', 'CouponController@status')->name('status');
        Route::post('coupon-delete', 'CouponController@delete')->name('delete');
        Route::post('coupon-search', 'CouponController@search')->name('search');
        Route::get('coupon/view-without-translate', 'CouponController@view_without_translate');



        //remove account
        Route::delete('remove-account', 'VendorController@remove_account');

        // Business setup
        Route::put('update-business-setup', 'BusinessSettingsController@update_restaurant_setup');
        Route::get('get-characteristic-suggestion', 'BusinessSettingsController@suggestion_list');

        // Reataurant schedule
        Route::post('schedule/store', 'BusinessSettingsController@add_schedule');
        Route::delete('schedule/{restaurant_schedule}', 'BusinessSettingsController@remove_schedule');

        // Attributes
        Route::get('attributes', 'AttributeController@list');

        // Addon
        Route::group(['prefix'=>'addon'], function(){
            Route::get('/', 'AddOnController@list');
            Route::post('store', 'AddOnController@store');
            Route::put('update', 'AddOnController@update');
            Route::get('status', 'AddOnController@status');
            Route::delete('delete', 'AddOnController@delete');
        });

        Route::group(['prefix' => 'delivery-man'], function () {
            Route::post('store', 'DeliveryManController@store');
            Route::get('list', 'DeliveryManController@list');
            Route::get('preview', 'DeliveryManController@preview');
            Route::get('status', 'DeliveryManController@status');
            Route::post('update/{id}', 'DeliveryManController@update');
            Route::delete('delete', 'DeliveryManController@delete');
            Route::post('search', 'DeliveryManController@search');

            Route::get('get-delivery-man-list', 'DeliveryManController@get_delivery_man_list');
            Route::get('assign-deliveryman', 'DeliveryManController@assign_deliveryman');
        });
        // Food
        Route::group(['prefix'=>'product'], function(){
            Route::post('store', 'FoodController@store');
            Route::put('update', 'FoodController@update');
            Route::delete('delete', 'FoodController@delete');
            Route::get('status', 'FoodController@status');
            Route::get('recommended', 'FoodController@recommended');
            Route::POST('search', 'FoodController@search');
            Route::get('reviews', 'FoodController@reviews');
            Route::put('reply-update', 'FoodController@update_reply');
            Route::get('details/{id}', 'FoodController@get_product');


        });

        // POS
        Route::group(['prefix'=>'pos'], function(){
            Route::get('orders', 'POSController@order_list');
            Route::post('place-order', 'POSController@place_order');
            Route::get('customers', 'POSController@get_customers');
        });

        // Chatting
        Route::group(['prefix' => 'message'], function () {
            Route::get('list', 'ConversationController@conversations');
            Route::get('search-list', 'ConversationController@search_conversations');
            Route::get('details', 'ConversationController@messages');
            Route::post('send', 'ConversationController@messages_store');
        });
        Route::put('send-order-otp', 'VendorController@send_order_otp');
    });




    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@configuration');
        Route::get('/get-zone-id', 'ConfigController@get_zone');
        Route::get('place-api-autocomplete', 'ConfigController@place_api_autocomplete');
        Route::get('distance-api', 'ConfigController@distance_api');
        Route::get('place-api-details', 'ConfigController@place_api_details');
        Route::get('geocode-api', 'ConfigController@geocode_api');
    });
    Route::get('customer/order/cancellation-reasons', 'OrderController@cancellation_reason');
    Route::get('customer/order/send-notification/{order_id}', 'OrderController@order_notification')->middleware('apiGuestCheck');

    Route::group(['prefix' => 'products'], function () {
        Route::get('latest', 'ProductController@get_latest_products');
        Route::get('popular', 'ProductController@get_popular_products');
        Route::get('restaurant-popular-products', 'ProductController@get_restaurant_popular_products');
        Route::get('recommended', 'ProductController@get_recommended');
        Route::get('most-reviewed', 'ProductController@get_most_reviewed_products');
        Route::get('set-menu', 'ProductController@get_set_menus');
        Route::get('search', 'ProductController@get_searched_products');
        Route::get('details/{id}', 'ProductController@get_product');
        Route::get('related-products/{food_id}', 'ProductController@get_related_products');
        Route::get('reviews/{food_id}', 'ProductController@get_product_reviews');
        Route::get('rating/{food_id}', 'ProductController@get_product_rating');
        Route::post('reviews/submit', 'ProductController@submit_product_review')->middleware('auth:api');
        Route::get('food-or-restaurant-search', 'ProductController@food_or_restaurant_search');
        Route::get('recommended/most-reviewed', 'ProductController@recommended_most_reviewed');
    });

    Route::group(['prefix' => 'restaurants'], function () {
        Route::get('get-restaurants/{filter_data}', 'RestaurantController@get_restaurants');
        Route::get('latest', 'RestaurantController@get_latest_restaurants');
        Route::get('popular', 'RestaurantController@get_popular_restaurants');
        Route::get('details/{id}', 'RestaurantController@get_details');  // visitor logs
        Route::get('reviews', 'RestaurantController@reviews');
        Route::get('search', 'RestaurantController@get_searched_restaurants');
        Route::get('recently-viewed-restaurants', 'RestaurantController@recently_viewed_restaurants');
        Route::get('get-coupon', 'RestaurantController@get_coupons');

        Route::get('recommended', 'RestaurantController@get_recommended_restaurants');
        Route::get('visit-again', 'RestaurantController@get_visited_restaurants')->middleware('apiGuestCheck');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@get_categories');
        Route::get('childes/{category_id}', 'CategoryController@get_childes');
        Route::get('products/{category_id}', 'CategoryController@get_products');   // visitor logs
        Route::get('products/{category_id}/all', 'CategoryController@get_all_products');
        Route::get('restaurants/{category_id}', 'CategoryController@get_restaurants');
    });

    Route::group(['prefix' => 'cuisine'], function () {
        Route::get('/', 'CuisineController@get_all_cuisines');
        Route::get('get_restaurants/', 'CuisineController@get_restaurants');
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'auth:api'], function () {
        Route::get('notifications', 'NotificationController@get_notifications');
        Route::get('info', 'CustomerController@info');
        Route::get('update-zone', 'CustomerController@update_zone');
        Route::post('update-profile', 'CustomerController@update_profile');
        Route::post('update-interest', 'CustomerController@update_interest');
        Route::put('cm-firebase-token', 'CustomerController@update_cm_firebase_token');
        Route::get('suggested-foods', 'CustomerController@get_suggested_food');
        //Remove account
        Route::delete('remove-account', 'CustomerController@remove_account');

        Route::group(['prefix'=>'loyalty-point'], function() {
            Route::post('point-transfer', 'LoyaltyPointController@point_transfer');
            Route::get('transactions', 'LoyaltyPointController@transactions');
        });

        Route::group(['prefix'=>'wallet'], function() {
            Route::get('transactions', 'WalletController@transactions');
            Route::get('bonuses', 'WalletController@get_bonus');
            Route::post('add-fund', 'WalletController@add_fund');
        });

        Route::group(['prefix' => 'address'], function () {
            Route::get('list', 'CustomerController@address_list');
            Route::post('add', 'CustomerController@add_new_address');
            Route::put('update/{id}', 'CustomerController@update_address');
            Route::delete('delete', 'CustomerController@delete_address');
        });


        // Chatting
        Route::group(['prefix' => 'message'], function () {
            Route::get('list', 'ConversationController@conversations');
            Route::get('search-list', 'ConversationController@get_searched_conversations');
            Route::get('details', 'ConversationController@messages');
            Route::post('send', 'ConversationController@messages_store');
            Route::post('chat-image', 'ConversationController@chat_image');
        });

        Route::group(['prefix' => 'wish-list'], function () {
            Route::get('/', 'WishlistController@wish_list');
            Route::post('add', 'WishlistController@add_to_wishlist');
            Route::delete('remove', 'WishlistController@remove_from_wishlist');
        });


        Route::put('subscription/update_schedule/{subscription}','OrderSubscriptionController@update_schedule');
        Route::get('subscription/{id}/{tab?}','OrderSubscriptionController@show');
        Route::resource('subscription','OrderSubscriptionController');

    });

    Route::group(['prefix' => 'customer', 'middleware' => 'apiGuestCheck'], function () {
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'OrderController@get_order_list');
            Route::get('order-subscription-list', 'OrderController@get_order_subscription_list');
            Route::get('running-orders', 'OrderController@get_running_orders');
            Route::get('details', 'OrderController@get_order_details');
            Route::post('place', 'OrderController@place_order');  // visitor logs
            Route::put('cancel', 'OrderController@cancel_order');
            Route::post('refund-request', 'OrderController@refund_request');
            Route::get('refund-reasons', 'OrderController@refund_reasons');
            Route::get('track', 'OrderController@track_order');
            Route::put('payment-method', 'OrderController@update_payment_method');
            Route::put('offline-payment', 'OrderController@offline_payment');
            Route::put('offline-payment-update', 'OrderController@update_offline_payment_info');
        });
        Route::get('getPendingReviews', 'OrderController@getPendingReviews');

        Route::post('food-list','OrderController@food_list');
        Route::get('order-again', 'OrderController@order_again');

        Route::group(['prefix'=>'cart'], function() {
            Route::get('list', 'CartController@get_carts');
            Route::post('add', 'CartController@add_to_cart');
            Route::post('update', 'CartController@update_cart');
            Route::delete('remove-item', 'CartController@remove_cart_item');
            Route::delete('remove', 'CartController@remove_cart');
            Route::post('add-multiple', 'CartController@add_to_cart_multiple');
        });

    });


    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'campaigns'], function () {
        Route::get('basic', 'CampaignController@get_basic_campaigns');
        Route::get('basic-campaign-details', 'CampaignController@basic_campaign_details');
        Route::get('item', 'CampaignController@get_item_campaigns');
    });

    Route::group(['prefix' => 'coupon', 'middleware' => 'auth:api'], function () {
        Route::get('list', 'CouponController@list');
        Route::get('apply', 'CouponController@apply');
    });

    Route::group(['prefix' => 'cashback', 'middleware' => 'auth:api'], function () {
        Route::get('list', 'CashBackController@list');
        Route::get('getCashback', 'CashBackController@getCashback');
    });


    Route::get('coupon/restaurant-wise-coupon', 'CouponController@restaurant_wise_coupon');

    Route::post('newsletter/subscribe','NewsletterController@index');
    Route::get('landing-page', 'ConfigController@landing_page');
    Route::get('react-landing-page', 'ConfigController@react_landing_page');

    Route::get('vehicle/extra_charge', 'ConfigController@extra_charge');
    Route::get('most-tips', 'OrderController@most_tips');
    Route::get('get-vehicles', 'ConfigController@get_vehicles');
    Route::get('get-PaymentMethods', 'ConfigController@getPaymentMethods');
    Route::get('offline_payment_method_list', 'ConfigController@offline_payment_method_list');


    
});

WebSocketsRouter::webSocket('/delivery-man/live-location', DMLocationSocketHandler::class);


/*****************App************************
 * ******** Authintication Routes ******
 * *****************AMR DEV***************
 */
Route::group(['namespace' => 'Api\V1\Auth', 'prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/verify_phone' , 'AuthController@verify_phone');

});




Route::group(['namespace' => 'Api\App', 'prefix' => 'app' ,'middleware'=>['localization']], function () {
    Route::get('/config', 'AppConfigController@CustomerApp');

    //Address
    Route::group(['prefix' => 'address' ,'middleware'=>['localization' , 'auth:api']], function () {
        Route::get('/list', 'AddressController@address_list');
        Route::post('/new', 'AddressController@add_new_address');
        Route::put('update/{id}', 'AddressController@update_address');
        Route::post('delete', 'AddressController@delete_address');
    });
    

    //Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::post('/update', 'ProfileController@update_profile');
        Route::post('/update_image', 'ProfileController@update_image');
        Route::get('/', 'ProfileController@profile');

    });

    Route::group(['prefix' => 'home' ,'middleware'=>['localization' , 'auth:api']], function () {
        Route::get('/', 'HomeController@home_page');
        Route::get('/restaurant/{id}', 'HomeController@show_restaurant');

       
    });

    Route::group(['prefix' => 'wallet' ,'middleware'=>['localization' , 'auth:api']], function () {
        Route::get('/', 'WalletController@WalletPage');
        Route::post('/send', 'WalletController@SendMoney');
        
        //favorite 
        Route::get('favorite' , [FavouriteController::class, 'index']);
        Route::post('favorite' , [FavouriteController::class, 'store']);

       
    });


    Route::group(['prefix'=>'cart'], function() {
        Route::get('list', 'CartController@get_carts');
        Route::post('add', 'CartController@add_to_cart');
        Route::post('update', 'CartController@update_cart');
        Route::delete('remove-item', 'CartController@remove_cart_item');
        Route::delete('remove', 'CartController@remove_cart');
        Route::post('add-multiple', 'CartController@add_to_cart_multiple');
    });

    



});




Route::group(['namespace' => 'Api\App', 'prefix' => 'customer' ,'middleware'=>['localization' , 'auth:api']], function () {
});



