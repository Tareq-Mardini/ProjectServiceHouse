<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSection;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\AuthLogin;
use App\Http\Controllers\AuthSupplierController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierWorkController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\SupplierPortfolioController;
use App\Http\Middleware\SupplierMiddleware;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SupplierDashboardController;

Route::get('/', function () {
    return view('welcome');
});
//=====================================================================================================================================================

// هون لتجسيل دخول الأدمن 
Route::get('admin/login', [AdminLogin::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminLogin::class, 'checkLogin'])->name('admin.check');

//======================================================================================================================================================

//هدول الاسطر يلي تحت هنن لعمليات الادمن مشان طلعن كلن بكبس على السهم (هدول للأكتور الأدمن) ^_^
Route::middleware(AdminMiddleware::class)->group(function () {




Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');




    Route::resource('admin/dashboard/section', AdminSection::class);
    Route::get('admin/dashboard/setting', [AdminController::class, 'ViewAccount'])->name('admin.setting');
    Route::put('admin/dashboard/setting', [AdminController::class, 'EditAccount'])->name('admin.edit.account');
    Route::get('admin/dashboard/service', [AdminServiceController::class, 'index'])->name('admin.view.service');
    Route::get('admin/dashboard/service/create', [AdminServiceController::class, 'create'])->name('admin.service.create');
    Route::post('admin/dashboard/service/create', [AdminServiceController::class, 'store'])->name('admin.service.store');
    Route::get('admin/dashboard/service/{id}/update', [AdminServiceController::class, 'edit'])->name('admin.service.edit');
    Route::put('admin/dashboard/service/{id}/update', [AdminServiceController::class, 'update'])->name('admin.service.update');
    Route::delete('admin/dashboard/service/{id}/delete', [AdminServiceController::class, 'delete'])->name('admin.service.delete');
    Route::get('admin/dashboard/section/Archive', [AdminSection::class, 'show'])->name('admin.show.archive');
    Route::get('admin/dashboard/service/Archive', [AdminServiceController::class, 'show'])->name('admin.service.show.archive');
    Route::get('admin/dashboard/section/Archive/Restore/{id}', [AdminSection::class, 'Restore'])->name('admin.section.Archive.Restore');
    Route::get('admin/dashboard/service/Archive/Restore/{id}', [AdminServiceController::class, 'Restore'])->name('admin.service.Archive.Restore');
    Route::get('admin/dashboard/section/Archive/Delete/{id}', [AdminSection::class, 'ForceDelete'])->name('admin.section.Archive.ForceDelete');
    Route::get('admin/dashboard/service/Archive/Delete/{id}', [AdminServiceController::class, 'ForceDelete'])->name('admin.service.Archive.ForceDelete');
    Route::get('adminlogout', [AdminLogin::class, 'logout'])->name('adminlogout');
    Route::get('admin/dashboard/CustomerService', [CustomerServiceController::class, 'ViewCustomerService'])->name('admin.ViewCustomerService');
    Route::get('admin/dashboard/CustomerService/Client/{clientId}', [CustomerServiceController::class, 'ViewChatClient'])->name('ViewChatClientForAdmin');
    Route::post('/send-message-admin', [CustomerServiceController::class, 'SendMessageFromAdminToClient'])->name('send.message.admin.ToClient');
    Route::get('admin/dashboard/CustomerService/Supplier/{supplierId}', [CustomerServiceController::class, 'ViewChatSupplier'])->name('ViewChatSupplierForAdmin');
    Route::post('/send-message--admin', [CustomerServiceController::class, 'SendMessageFromAdminToSupplier'])->name('send.message.admin.ToSupplier');
    Route::get('admin/dashboard/transactions', [AdminController::class, 'ViewTransactions'])->name('ViewTransactions');
    Route::get('admin/dashboard/orders', [AdminController::class, 'ViewOrders'])->name('ViewOrders');
});

//==================================================================================================================================================//

//  هلأ هون للأكتور الزائر ^_^ 
Route::get('ServiceHouse', [VisitorController::class, 'View'])->name('ServiceHouse');
Route::get('ServiceHouse/Sections', [VisitorController::class, 'ViewSections'])->name('ViewSections');
Route::get('ServiceHouse/Section/Services/{id}', [VisitorController::class, 'ViewServices'])->name('ViewServices');
Route::get('ServiceHouse/Section/Service/{id}/works', [VisitorController::class, 'ViewWorks'])->name('Works.Show.Visitor');
Route::get('ServiceHouse/Section/Service/work/info{id}', [VisitorController::class, 'ViewinfoWorks'])->name('Works.info.visitor');
Route::get('ServiceHouse/Section/Service/WorkInfo/portfolio{id}', [VisitorController::class, 'ViewPortfolio'])->name('view.portfolio.visitor');

//==========================================================================================================================================================//

//  هون ساويت واجهة للدخول للزبون والمقدم مع أنشاء الحساب ( الزبون والمقدم الخدمة )
Route::get('ServiceHouse/Login/Client', [AuthLogin::class, 'ViewClient'])->name('AuthLogin');
Route::post('ServiceHouse/Login/Client', [AuthLogin::class, 'LoginClient'])->name('LoginClient');
Route::get('ServiceHouse/Login/Supplier', [AuthLogin::class, 'ViewSupplier'])->name('AuthLoginn');
Route::post('ServiceHouse/Login/Supplier', [AuthLogin::class, 'LoginSupplier'])->name('LoginSupplier');
Route::get('ServiceHouse/Register/Supplier', [AuthSupplierController::class, 'ViewRegister'])->name('register.Supplier');
Route::post('ServiceHouse/Register/Supplier', [AuthSupplierController::class, 'Store'])->name('Store.account.Supplier');
Route::get('ServiceHouse/Register/Client', [AuthClientController::class, 'ViewRegister'])->name('register.client');
Route::post('ServiceHouse/Register/Client', [AuthClientController::class, 'Store'])->name('Store.account.client');

//===================================================================================================================================================//

// هلأ لح نشتغل على الراوتات مقدمين الخدمات ^_^
Route::middleware(SupplierMiddleware::class)->group(function () {
    Route::get('ServiceHouse/Supplier', [SupplierController::class, 'View'])->name('ServiceHouse.Home.Supplier');



    Route::get('ServiceHouse/Supplier/Dashboard', [SupplierDashboardController::class, 'ViewDashboard'])->name('ServiceHouse.Supplier.Dashboard');



    
    Route::get('ServiceHouse/Supplier/Sections', [SupplierController::class, 'ShowSections'])->name('Servicehouse.Sections.Show.Supplier');
    Route::get('ServiceHouse/Supplier/Section/Services/{id}', [SupplierController::class, 'ShowServices'])->name('Servicehouse.Services.Show.Supplier');
    Route::get('ServiceHouse/Supplier/Section/Service/{id}/works', [SupplierController::class, 'ViewWorks'])->name('Works.Show.Supplier');
    Route::get('ServiceHouse/Supplier/Dashboard/Myworks', [SupplierWorkController::class, 'ViewMyWork'])->name('Supplier.Show.Myworks');
    Route::get('ServiceHouse/Supplier/Dashboard/Myworks/InfoWork/{id}', [SupplierWorkController::class, 'ViewWorkInfo'])->name('Supplier.Work.Info');
    Route::get('ServiceHouse/Supplier/Dashboard/Myworks/Create', [SupplierWorkController::class, 'CreateWork'])->name('Works.Create.Supplier');
    Route::post('ServiceHouse/Supplier/Dashboard/Myworks/Create', [SupplierWorkController::class, 'StoreWork'])->name('Works.Store.Supplier');
    Route::post('ServiceHouse/Supplier/Dashboard/Myworks/Update', [SupplierWorkController::class, 'EditeWork'])->name('Supplier.Edite.Myworks');
    Route::put('ServiceHouse/Supplier/Dashboard/Myworks/{id}/Update', [SupplierWorkController::class, 'UpdateWork'])->name('Supplier.Update.Myworks');
    Route::delete('ServiceHouse/Supplier/Dashboard/Myworks/{id}/Delete', [SupplierWorkController::class, 'DeleteWork'])->name('Supplier.Delete.Work');
    Route::get('ServiceHouse/Supplier/Dashboard/MyPortfolio/Create', [SupplierPortfolioController::class, 'Create'])->name('Supplier.Create.Portfolio');
    Route::post('/portfolio/store', [SupplierPortfolioController::class, 'store'])->name('Supplier.Store.Portfolio');
    Route::get('ServiceHouse/Supplier/Dashboard/MyPortfolio/Update', [SupplierPortfolioController::class, 'editPortfolio'])->name('Supplier.Edit.Portfolio');
    Route::post('/update-portfolio', [SupplierPortfolioController::class, 'updatePortfolio'])->name('Supplier.Update.Portfolio');
    Route::get('ServiceHouse/Supplier/Dashboard/MyPortfolio', [SupplierPortfolioController::class, 'view'])->name('Supplier.View.Portfolio');
    Route::get('/delete-portfolio', [SupplierPortfolioController::class, 'DeletePortfolio'])->name('Supplier.Delete.Portfolio');
    Route::get('ServiceHouse/Supplier/Dashboard/MyAccount', [SupplierController::class, 'ViewAccount'])->name('Supplier.View.Account');
    Route::get('ServiceHouse/Supplier/Dashboard/MyAccount/Update', [SupplierController::class, 'UpdateAccount'])->name('Supplier.Update.Account');
    Route::post('/update-Account', [SupplierController::class, 'EditAccount'])->name('Supplier.Edit.Account');
    Route::post('/supplier/delete-account', [SupplierController::class, 'DeleteAccount'])->name('Supplier.Delete.Account');
    Route::get('ServiceHouse/logout-supplier', [AuthLogin::class, 'LogoutSupplier'])->name('Logout.supplier');
    Route::get('ServiceHouse/Supplier/Section/Service/work/info{id}', [SupplierController::class, 'ViewinfoWorks'])->name('Works.info.user');
    Route::get('ServiceHouse/Supplier/Section/Service/WorkInfo/portfolio{id}', [SupplierController::class, 'ViewPortfolio'])->name('view.portfolio.user');
    Route::get('ServiceHouse/Supplier/Dashboard/Chat/Client/{client_id}/Order/{order_id}', [ChatsController::class, 'ViewChatClient'])->name('ViewChatClient');
    Route::post('/send-message-supplier', [ChatsController::class, 'SendMessageFromSupplierToClient'])->name('send.message.supplier');
    Route::get('ServiceHouse/Supplier/Dashboard/CustomerService', [CustomerServiceController::class, 'communicationSupplier'])->name('view.communication.supplier');
    Route::post('/send-message-Supplier-To-Admin', [CustomerServiceController::class, 'SendMessageFromSupplierToAdmin'])->name('send.message.FromSupplier.To.Admin');
    Route::get('ServiceHouse/Supplier/Dashboard/MyWallet', [WalletController::class, 'ViewWalletSupplier'])->name('View.wallet.supplier');
    Route::get('ServiceHouse/Supplier/Dashboard/MyWallet/Create', [WalletController::class, 'CreateWalletSupplier'])->name('create.wallet.supplier');
    Route::post('MyWallet/Create/Supplier', [WalletController::class, 'StoreWalletSupplier'])->name('store.wallet.supplier');
    Route::get('/Supplier{wallet_id}', [WalletController::class, 'BalanceSupplier'])->name('Supplier.balance');
    Route::get('ServiceHouse/Supplier/Dashboard/MyWallet/Update', [WalletController::class, 'UpdateWalletSupplier'])->name('edit.wallet.supplier');
    Route::post('MyWallet/Update/Supplier', [WalletController::class, 'UpdateWalletPasswordSupplier'])->name('update.wallet.supplier');
    Route::get('ServiceHouse/Supplier/Dashboard/Orders', [OrderController::class, 'ViewOrdersSupplier'])->name('View.Order.supplier');

    Route::get('ServiceHouse/Supplier/Dashboard/Order/{id}', [OrderController::class, 'ViewDetailOrder'])->name('ViewOrderDetail');
    Route::get('ServiceHouse/Supplier/Dashboard/Order/Acceptance/{id}', [OrderController::class, 'AcceptanceOrder'])->name('AcceptanceOrder');
    Route::get('ServiceHouse/Supplier/Dashboard/Order/Rejection/{id}', [OrderController::class, 'RejectionOrder'])->name('RejectionOrder');
    Route::get('ServiceHouse/Supplier/Dashboard/Order/Completed/{id}', [OrderController::class, 'completedOrder'])->name('completedOrder');
    Route::post('ServiceHouse/Supplier/Dashboard/Order/Deliver', [OrderController::class, 'DeliveredOrder'])->name('DeliveredOrder');

    Route::post('ServiceHouse/Supplier/Dashboard/Order/Deliver/finall', [OrderController::class, 'DeliveredOrderFinall'])->name('DeliveredOrderFinall');
});
//===================================================================================================================================================//

// هلأ لح نشتغل على الراوتات الزبائن ^_^
Route::middleware(ClientMiddleware::class)->group(function () {
    Route::get('ServiceHouse/logout-client', [AuthLogin::class, 'LogoutClient'])->name('Logout.client');
    Route::get('ServiceHouse/Client', [ClientController::class, 'View'])->name('ServiceHouse.Home.Client');
    Route::get('ServiceHouse/Client/Sections', [ClientController::class, 'ShowSections'])->name('Servicehouse.Sections.Show.Client');
    Route::get('ServiceHouse/Client/Section/Services/{id}', [ClientController::class, 'ShowServices'])->name('Servicehouse.Services.Show.Client');
    Route::get('ServiceHouse/Client/Section/Service/{id}/works', [ClientController::class, 'ViewWorks'])->name('Works.Show.Client');
    Route::get('ServiceHouse/Client/Section/Service/work/info{id}', [ClientController::class, 'ViewinfoWorks'])->name('Works.info.Client');
    Route::get('ServiceHouse/Client/Section/Service/WorkInfo/portfolio{id}', [ClientController::class, 'ViewPortfolio'])->name('view.portfolio.Client');
    Route::get('ServiceHouse/Client/Settings', [ClientController::class, 'ViewSettings'])->name('ServiceHouse.Client.Settings');
    Route::get('ServiceHouse/Client/Settings/MyAccount', [ClientController::class, 'ViewAccount'])->name('Client.View.Account');
    Route::get('ServiceHouse/Client/Settings/MyAccount/Update', [ClientController::class, 'UpdateAccount'])->name('Client.Update.Account');
    Route::post('/update-Account-client', [ClientController::class, 'EditAccount'])->name('Client.Edit.Account');
    Route::post('/send-message', [ChatsController::class, 'SendMessageFromClientToSupplier'])->name('send.message');
    Route::get('ServiceHouse/Client/Settings/Chat/Supplier/{supplier_id}/Order/{order_id}', [ChatsController::class, 'ViewChatSupplier'])->name('view.chat.supplier');
    Route::get('ServiceHouse/Client/Settings/CustomerService', [CustomerServiceController::class, 'communication'])->name('view.communication');
    Route::post('/send-message-Client-To-Admin', [CustomerServiceController::class, 'SendMessageFromClientToAdmin'])->name('send.message.To.Admin');
    Route::get('ServiceHouse/Client/Settings/MyWallet', [WalletController::class, 'ViewWallet'])->name('View.wallet.clinet');
    Route::get('ServiceHouse/Client/Settings/MyWallet/Create', [WalletController::class, 'CreateWallet'])->name('create.wallet.clinet');
    Route::post('MyWallet/Create', [WalletController::class, 'StoreWallet'])->name('store.wallet.clinet');
    Route::get('/client{wallet_id}', [WalletController::class, 'Balance'])->name('client.balance');
    Route::get('ServiceHouse/Client/Settings/MyWallet/Update', [WalletController::class, 'Update'])->name('edit.wallet.clinet');
    Route::post('MyWallet/Update', [WalletController::class, 'UpdateWalletPassword'])->name('update.wallet.client');
    Route::get('ServiceHouse/Client/Section/Service/WorkInfo/order/{id}', [OrderController::class, 'Order'])->name('Order');
    Route::post('MyWallet/order', [OrderController::class, 'CreateOrder'])->name('CreateOrder');
    Route::get('ServiceHouse/Client/Settings/MyOrders', [OrderController::class, 'ViewOrdersClient'])->name('View.Order.clinet');
    Route::get('ServiceHouse/Client/Settings/MyOrders/OrderInfo/{id}', [OrderController::class, 'ViewOrderInfoClient'])->name('View.Order.Info.clinet');
    Route::get('ServiceHouse/Client/Settings/MyOrders/OrderInfo/Approved/{id}', [OrderController::class, 'ApprovedOrder'])->name('ApprovedOrder');
    Route::post('/favorite/{id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('ServiceHouse/Client/Settings/MyFavorite', [FavoriteController::class, 'ViewFavorite'])->name('ViewFavorite');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/client/delete-account', [ClientController::class, 'DeleteAccount'])->name('Client.Delete.Account');


    Route::post('/client/Send/Note', [OrderController::class, 'SendNoteClient'])->name('SendNoteClient');
});
//===================================================================================================================================================//
