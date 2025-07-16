<?php
//
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\BrokerBonusController;
//use App\Http\Controllers\BrokerMemberBonusController;
//use App\Http\Controllers\BrokerReceiptController;
//use App\Http\Controllers\CardController;
//use App\Http\Controllers\CardPaymentController;
//use App\Http\Controllers\CompanyBalanceTransactionController;
//use App\Http\Controllers\CourseController;
//use App\Http\Controllers\MemberController;
//use App\Http\Controllers\MoneyTransferCompanyController;
//use App\Http\Controllers\OurCompanyMoneyAccountController;
//use App\Http\Controllers\VideoController;
//use App\Http\Controllers\ChapterController;
//use App\Http\Controllers\UserController;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//
//Route::middleware('api')->group(function () {
//    Route::post('/auth/login', [AuthController::class, 'loginUser']);
//});
//
//
//Route::middleware('auth:sanctum')->group(function () {
//
//    Route::apiResource('users', UserController::class);
//    Route::get('users_find', [UserController::class, 'find']);
//
//    //todo:do i need the members functions?
//    Route::apiResource('members', MemberController::class);
//    Route::get('members_find', [MemberController::class, 'find']);
//
//    Route::apiResource('card_payment', CardPaymentController::class);
//    Route::apiResource('broker_bonus', BrokerBonusController::class);
//    Route::apiResource('broker_member_bonus', BrokerMemberBonusController::class);
//    Route::apiResource('broker_receipt', BrokerReceiptController::class);
//    Route::apiResource('card', CardController::class);
//    Route::apiResource('card_payment', CardPaymentController::class);
//    Route::apiResource('company_balance_transactions', CompanyBalanceTransactionController::class);
//    Route::apiResource('money_transfer_company', MoneyTransferCompanyController::class);
//    Route::apiResource('our_company_money_account', OurCompanyMoneyAccountController::class);
//
//    Route::apiResource('courses', CourseController::class);
//    Route::apiResource('chapters', ChapterController::class);
//    Route::apiResource('videos', VideoController::class);
//
//    Route::put('update_user_video_feedback/{video}', [VideoController::class, 'updateUserVideoFeedback']);
//});
