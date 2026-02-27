<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewUserLeadsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// test api
Route::get('/test', function () {
    return 'New Api works!';
});

Route::get('/test-user-lead', function () {
    return 'user lead is working';
});

Route::post('user-lead', [NewUserLeadsController::class, 'save_email']);
Route::get('user-leads', [NewUserLeadsController::class, 'get_user_leads']);

// test notification
Route::group(['prefix' => 'notification'], function () {
    Route::group(['prefix' => 'test'], function () {
        Route::post('', [\App\Http\Controllers\AuthController::class, 'testEmail']);
    });
});

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('sign-up', [\App\Http\Controllers\AuthController::class, 'signUp']);
Route::post('verify', [\App\Http\Controllers\AuthController::class, 'verifyUser']);
Route::post('forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword']);
Route::post('set-forgot-password', [\App\Http\Controllers\AuthController::class, 'setNewPassword']);
Route::post('resend-verification', [\App\Http\Controllers\AuthController::class, 'resendVerificationCode']);

// WebHook
Route::post('webhook/mamopay', [\App\Http\Controllers\MamoPayWebHookController::class, 'handle']);

// with auth api to access
Route::group(['middleware' => 'auth:auth-api'], function () {

    Route::group(['prefix' => 'auth'], function () {

        #Items
        Route::group(['prefix' => 'items'], function () {
            Route::get('', [\App\Http\Controllers\ItemController::class, 'index']);
            Route::post('', [\App\Http\Controllers\ItemController::class, 'store']);
            Route::get('{item}', [\App\Http\Controllers\ItemController::class, 'show']);
            Route::delete('{item}', [\App\Http\Controllers\ItemController::class, 'delete']);
            Route::put('{item}', [\App\Http\Controllers\ItemController::class, 'update']);
        });

        #Bidding
        Route::group(['prefix' => 'item-bid'], function () {
            Route::get('', [\App\Http\Controllers\ItemBiddingController::class, 'index']);
            Route::post('', [\App\Http\Controllers\ItemBiddingController::class, 'store']);
            Route::patch('{bid}', [\App\Http\Controllers\ItemBiddingController::class, 'status']);
        });

        #Comment
        Route::group(['prefix' => 'item-comment'], function () {
            Route::get('', [\App\Http\Controllers\ItemCommentController::class, 'index']);
            Route::post('', [\App\Http\Controllers\ItemCommentController::class, 'store']);
        });

        #Transaction
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('', [\App\Http\Controllers\TransactionController::class, 'index']);
            Route::post('', [\App\Http\Controllers\TransactionController::class, 'store']);
        });

        #Me
        Route::group(['prefix' => 'me'], function () {
            #Profile
            Route::get('profile', [\App\Http\Controllers\MeController::class, 'profile']);
            Route::put('profile', [\App\Http\Controllers\MeController::class, 'updatePersonalInfo']);
            Route::post('profile/vendor', [\App\Http\Controllers\MeController::class, 'updateVendor']);
            #Items
            Route::get('items', [\App\Http\Controllers\MeController::class, 'items']);
            #Payments
            Route::get('bank-payment', [\App\Http\Controllers\MeController::class, 'userBankList']);
            Route::post('bank-payment', [\App\Http\Controllers\MeController::class, 'addUserBank']);

            #Chagnge Password
            Route::put('change-password', [\App\Http\Controllers\AuthController::class, 'changePassword']);

            #Upload User Photo
            Route::post('upload-photo', [\App\Http\Controllers\MeController::class, 'uploadUserPhoto']);
            #Upload Vendor Photo
            Route::post('upload-vendor', [\App\Http\Controllers\MeController::class, 'uploadVendorPhoto']);

            #Offers (bidding)
            Route::get('my-offers', [\App\Http\Controllers\MeController::class, 'myOffers']);
            Route::get('offers-to-me', [\App\Http\Controllers\MeController::class, 'offersToMe']);
            Route::get('offers-to-me/{item}', [\App\Http\Controllers\MeController::class, 'offersToMeByUuid']);
            Route::put('offers-to-me/accept/{bid}', [\App\Http\Controllers\MeController::class, 'acceptOffer']);
            Route::put('offers-to-me/reject/{bid}', [\App\Http\Controllers\MeController::class, 'rejectOffer']);

            #
            Route::get('my-purchased', [\App\Http\Controllers\MeController::class, 'myPurchased']);
        });

        #Payment Mamopay
        Route::group(['prefix' => 'payment'], function () {
            //accounts
            Route::post('mamopay/account', [\App\Http\Controllers\PaymentController::class, 'createMamoPayAccount']);
            //checkout
            Route::post('mamopay/checkout/{item}', [\App\Http\Controllers\PaymentController::class, 'checkout']);
            Route::post('mamopay/checkout/featured-product/{item}', [\App\Http\Controllers\PaymentController::class, 'payFeaturedProduct']);

            // payment transaction
            Route::post('mamopay/transaction/success', [\App\Http\Controllers\PaymentController::class, 'saveSuccessTransaction']);
            Route::post('mamopay/transaction/featured-product/success', [\App\Http\Controllers\PaymentController::class, 'saveFeaturedProductSuccessTransaction']);
            // payouts
            Route::get('mamopay/payouts', [\App\Http\Controllers\PaymentController::class, 'payoutsList']);
            
        });

        #Discount
        Route::group(['prefix' => 'discount'], function () {
            Route::post('validate', [\App\Http\Controllers\DiscountController::class, 'validateDiscount']);
        });

        

    });
});

// for non auth api
Route::group(['prefix' => 'global'], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('', [\App\Http\Controllers\CategoryController::class, 'index']);
    });
    Route::group(['prefix' => 'sub-category'], function () {
        Route::get('', [\App\Http\Controllers\SubCategoryController::class, 'index']);
        Route::get('properties', [\App\Http\Controllers\SubCategoryController::class, 'properties']);
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('', [\App\Http\Controllers\ItemController::class, 'index']);
        Route::get('{item}', [\App\Http\Controllers\ItemController::class, 'show']);
    });

    Route::group(['prefix' => 'featured'], function () {
        Route::get('', [\App\Http\Controllers\ItemController::class, 'featured']);
    });

    Route::group(['prefix' => 'payment'], function () {
        Route::post('mamopay/checkout/{item}', [\App\Http\Controllers\PaymentController::class, 'checkoutNonAuth']);
        Route::post('mamopay/transaction/success', [\App\Http\Controllers\PaymentController::class, 'saveSuccessTransactionNonAuth']);
    });

    
 });



