<?php

use App\Events\NotificationCreated;
use App\Helpers\PortalHelpers;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestingController;
use App\Http\Livewire\Attendance\UserAttendance;
use App\Http\Livewire\Attendance\ViewAll;
use App\Http\Livewire\Auth\ForgetPassword;
use App\Http\Livewire\Auth\LoginForm;
use App\Http\Livewire\Auth\RecoverPassword;
use App\Http\Livewire\Auth\ViewLoginHistory;
use App\Http\Livewire\Clients\ClientsList;
use App\Http\Livewire\Content\ContentCompletedOrders;
use App\Http\Livewire\Content\ContentCreateOrder;
use App\Http\Livewire\Content\ContentEditOrder;
use App\Http\Livewire\LeaveEntitlements\MarkUsersLeave;
use App\Http\Livewire\Content\ContentOrdersList;
use App\Http\Livewire\Content\ContentOrderView;

// Design Orders
use App\Http\Livewire\DesignOrder\DesignOrderCreate;
use App\Http\Livewire\DesignOrder\DesignOrderEdit;
use App\Http\Livewire\DesignOrder\DesignOrderList;
use App\Http\Livewire\DesignOrder\DesignOrderView;
// Development Orders
use App\Http\Livewire\DevelopmentOrders\DevelopmentOrderCreate;
use App\Http\Livewire\DevelopmentOrders\DevelopmentOrderEdit;
use App\Http\Livewire\DevelopmentOrders\DevelopmentOrderList;
use App\Http\Livewire\DevelopmentOrders\DevelopmentOrderView;



use App\Http\Livewire\CustomErrors\ErrorsList;
use App\Http\Livewire\CustomErrors\ExceptionMessage;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Employees\AllEmployees;
use App\Http\Livewire\Employees\NewEmployee;
use App\Http\Livewire\Employees\ViewEmployee;
use App\Http\Livewire\HR\AssignedTargets;
use App\Http\Livewire\LeaveEntitlements\LeaveSettings;
use App\Http\Livewire\LeaveEntitlements\MarkUserAttendance;
use App\Http\Livewire\LeaveEntitlements\ReceivedLeaveRequest;
use App\Http\Livewire\LeaveEntitlements\UserLeaveQuotaView;
use App\Http\Livewire\LeaveEntitlements\UserLeaveRequest;
use App\Http\Livewire\Notice\NoticeBoards;
use App\Http\Livewire\Notice\ViewNoticeAnswers;
use App\Http\Livewire\Notification\UserPortalNotifications;
use App\Http\Livewire\Other\SearchingQueries;
use App\Http\Livewire\Performance\EmployeePerformance;
use App\Http\Livewire\Performance\UserPerformance;
use App\Http\Livewire\Permissions\AddPermissions;
use App\Http\Livewire\Portal\ImportDeadlines;
use App\Http\Livewire\PreVillages\AllDepartments;
use App\Http\Livewire\PreVillages\AllDesignations;
use App\Http\Livewire\PreVillages\AllGenericType;
use App\Http\Livewire\PreVillages\AllIndustries;
use App\Http\Livewire\PreVillages\AllOrderServices;
use App\Http\Livewire\PreVillages\AllOrderVoices;
use App\Http\Livewire\PreVillages\AllOrderWebsites;
use App\Http\Livewire\PreVillages\AllWritingStyles;
use App\Http\Livewire\Research\ReasearchOrdersList;
use App\Http\Livewire\Research\ReasearchOrdersView;
use App\Http\Livewire\Research\ResearchCompletedOrders;
use App\Http\Livewire\Research\ResearchCreateOrder;
use App\Http\Livewire\Research\ResearchEditOrder;
use App\Http\Livewire\Trash\ContentDeletedOrders;
use App\Http\Livewire\Trash\DeletedUsers;
use App\Http\Livewire\Trash\ResearchDeletedOrders;
use App\Models\BasicModels\OrderServices;
use App\Models\ErrorLog;
use App\Services\ContentOrderService;
use App\Services\CreateUpdatePortalPermissions;
use App\Services\OrdersService;
use App\Services\ResearchOrderService;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Livewire\Employees\TrashEmployee;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Research\ResearchCanceldOrdersList;
use App\Http\Livewire\Content\ContentCanceldOrdersList;
use App\Services\DesignOrderService;
use App\Services\DevelopmentOrderService;
use App\Http\Livewire\Holiday\MarkHoliday;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\Auth\UserLeaveInfo;
use App\Models\LeaveEntitlements\UserLeaveQuota;


use App\Http\Livewire\Payroll\AllowanceSetting;
use App\Http\Livewire\Payroll\DetactionSetting;
use App\Http\Livewire\Payroll\Payslip;
use App\Http\Livewire\PreVillages\PreferredLanguage;

use App\Http\Livewire\Policy;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ================ Cache Clear Routes
Route::get('/clear-cache', static function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('event:clear');
    Artisan::call('optimize:clear');
    Debugbar::clear();
    return redirect()->route('Main.Dashboard')->with('Success!', 'Cache cleared Successfully!!');
})->name('Clear.Cache');

// ================ Clear Exceptions Routes
Route::get('/clear-error', static function () {
    ErrorLog::truncate();
    return redirect()->route('Main.Dashboard')->with('Success!', 'Cache cleared Successfully!!');
})->name('Clear.Error.Logs');

// ================ Portal Maintenance
Route::get('/portal-down', static function () {
    Artisan::call('down');
})->name('Portal.Down');

Route::get('/portal-up', static function () {
    Artisan::call('up');
})->name('Portal.Up');

// ===================== User Auth Routes ==================================

Route::get('/', function () {
    return redirect('/Authentication/Login-Form');
});

// Route::get('/Add', function () {

//     $PermentUsers = User::with(['timing', 'basic_info' => function ($q) {
//         $q->where('EMP_Status', 2);
//     }])->whereHas('basic_info', function ($q) {
//         $q->where('EMP_Status', 2);
//     })->get();

//     $ProbationUsers = User::with(['timing', 'basic_info' => function ($q) {
//         $q->where('EMP_Status', 1);
//     }])->whereHas('basic_info', function ($q) {
//         $q->where('EMP_Status', 1);
//     })->get();

//     foreach ($ProbationUsers as $ProbationUser) {

//         $dates = [

//             '2024-03-01 09:00:00',


//         ];
//         foreach ($dates as $date) {

//             $userAttendance = Attendance::create([
//                 'check_in' => $ProbationUser->timing->Start_Time,
//                 'check_out' => $ProbationUser->timing->End_Time,
//                 'total_time' => '08:00:00',
//                 'status' => 0,
//                 'reason' => null,
//                 'user_id' => $ProbationUser->id,
//                 'created_at' => $date,
//             ]);
//         }

//     }
//     foreach ($PermentUsers as $PermentUser) {

//         $dates = [

//             '2024-03-01 09:00:00',


//         ];

//         foreach ($dates as $date) {

//             $userAttendance = Attendance::create([
//                 'check_in' => $PermentUser->timing->Start_Time,
//                 'check_out' => $PermentUser->timing->End_Time,
//                 'total_time' => '08:00:00',
//                 'status' => 0,
//                 'reason' => null,
//                 'user_id' => $PermentUser->id,
//                 'created_at' => $date,
//             ]);
//         }


//     }

//     return response()->json(['message' => 'Data set successfully']);
// });
Route::prefix('Authentication')->group(function () {
    Route::get('/Login-Form', LoginForm::class)->name('Auth.Forms');
    Route::post('/Login-Form', [LoginForm::class, 'UserLogin'])->name('Auth.User');

    Route::get('/Forget-Password', ForgetPassword::class,)->name('Forget.Password');
    Route::post('/Post-Forget-Password', [ForgetPassword::class, 'submitForgetPasswordForm'])->name('Post.Forget.Password');
    Route::get('/Recover-Password/{token}', RecoverPassword::class,)->name('Recover.Password');
    Route::post('/Post-Reset-Password', [RecoverPassword::class, 'submitResetPasswordForm'])->name('Post.Reset.Password');

    Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
});

Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Authorized'], static function () {
    Route::get('/', Dashboard::class,)->name('Main.Dashboard');
    
    Route::get('/Delete-Attachment/{id}' , [OrdersService::class, 'DeleteAttachment'])->name('delete.attachment');
    
    Route::get('/Delete-Chat/{id}' ,  [OrdersService::class, 'DeleteChat'])->name('delete.chat');
    Route::get('/Delete-Chat-Attachment/{id}' ,  [OrdersService::class, 'DeleteChatAttachment'])->name('delete.chat.attachment');
    
    
    
    Route::get('/Client-Orders-List', ClientsList::class,)->name('Clients.List')->middleware('Check_Role');
    Route::get('/Get-Client-Orders-List', [ClientsList::class, 'getAllClientsList'])->name('Get.All.Clients.List');
    Route::post('/Update-Client-Orders-info', [ClientsList::class, 'updateClientInfo'])->name('Update.Client.Info')->middleware('Check_Role');

    // Research Orders Routes
    Route::get('/Research-Writing-Order/{Client_ID?}', ResearchCreateOrder::class,)->name('Research.Create.Order')->middleware('Check_Permissions:Research_create');
    Route::post('/Post-Research-Writing-Order', [ResearchCreateOrder::class, 'createResearchOrder'])->name('Post.Research.Create.Order');
    Route::get('/Research-Orders', ReasearchOrdersList::class,)->name('Research.Orders')->middleware('Check_Permissions:Research_list');
    Route::get('/Research-Completed-Orders', ResearchCompletedOrders::class,)->name('Research.Completed.Orders')->middleware('Check_Permissions:Research_list');
    Route::get('/View-Research-Order/{Order_ID}', ReasearchOrdersView::class,)->name('Order.Details')->middleware('Check_Permissions:Research_detail');

    Route::get('/View-Assign-Task', [ReasearchOrdersView::class, 'ViewAssignTask'])->name('View.Assign.Task');

    Route::post('/Assign-Order', [ReasearchOrdersView::class, 'assignOrder'])->name('Assign.Order')->middleware('Check_Permissions:Research_detail');
    Route::post('/New-Order-Task', [OrdersService::class, 'newOrderTask'])->name('New.Task')->middleware('Check_Permissions:Research_detail');
    Route::post('/Edit-Order-Task', [OrdersService::class, 'EditOrderTask'])->name('Edit.Task')->middleware('Check_Permissions:Research_detail');
    Route::get('/Delete-Order-Task/{Task_ID}', [OrdersService::class, 'DeleteOrderTask'])->name('Delete.Task')->middleware('Check_Permissions:Research_detail');
    Route::post('/Cancel-Words-Task', [OrdersService::class, 'CancelWordsTask'])->name('Cancel.Words.Task')->middleware('Check_Permissions:Research_detail');
    Route::post('/Task-Submit', [OrdersService::class, 'submitUserTask'])->name('Task.Submit')->middleware('Check_Permissions:Research_detail');
    Route::post('/Task-Revision', [OrdersService::class, 'TaskRevision'])->name('Task.Revision')->middleware('Check_Permissions:Research_detail');
    Route::post('/Change-Research-Writer', [OrdersService::class, 'ChangeResearchWriter'])->name('Change.Writer')->middleware('Check_Permissions:Research_detail');
    Route::post('/Research-Final-Submission', [OrdersService::class, 'ResearchOrderSubmission'])->name('Research.Order.Final.Submit')->middleware('Check_Permissions:Research_detail');

    Route::get('/Edit-Research-Writing-Order/{Order_ID}', ResearchEditOrder::class,)->name('Research.Edit.Order')->middleware('Check_Permissions:Research_edit');
    Route::post('/Update-Research-Writing-Order', [ResearchEditOrder::class, 'updateResearchOrder'])->name('Update.Research.Order')->middleware('Check_Permissions:Research_edit');
    Route::get('/Submit-Research-Writing-Order/{Order_ID}', [OrdersService::class, 'submitResearchOrder'])->name('Submit.Research.Order')->middleware('Check_Permissions:Research_detail');
    Route::get('/Cancel-Research-Writing-Order/{Order_ID}', [OrdersService::class, 'cancelResearchOrder'])->name('Cancel.Research.Order')->middleware('Check_Permissions:Research_detail');
    Route::get('/Delete-Research-Writing-Order/{Order_ID}', [OrdersService::class, 'deleteResearchOrder'])->name('Delete.Research.Order')->middleware('Check_Permissions:Research_detail');
    Route::post('/Research-Order-Revision', [OrdersService::class, 'ResearchOrderRevision'])->name('Research.Order.Revision')->middleware('Check_Permissions:Research_detail');

    Route::post('/Submit-Order-Revision', [OrdersService::class, 'SubmitOrderRevision'])->name('Submit.Upload.Order.Revision');

    Route::get('/Content-Writing-Order/{Client_ID?}', ContentCreateOrder::class,)->name('Content.Create.Order')->middleware('Check_Permissions:Content_create');
    Route::post('/Post-Content-Writing-Order', [ContentCreateOrder::class, 'createContentOrder'])->name('Post.Content.Create.Order')->middleware('Check_Permissions:Content_create');
    Route::get('/Content-Orders', ContentOrdersList::class,)->name('Content.Orders')->middleware('Check_Permissions:Content_list');
    Route::get('/Content-Completed-Orders', ContentCompletedOrders::class,)->name('Content.Completed.Orders')->middleware('Check_Permissions:Content_list');
    Route::get('/View-Content-Order/{Order_ID}', ContentOrderView::class,)->name('Content.Order.Details');
    //    ->middleware('Check_Permissions:Content_detail')
    Route::post('/Content-Final-Submission', [OrdersService::class, 'ContentOrderSubmission'])->name('Content.Order.Final.Submit');
    Route::post('/Content-Draft-Submission', [OrdersService::class, 'ContentOrderDraftSubmission'])->name('Order.Draft.Submit');
    Route::post('/Content-Order-Revision', [OrdersService::class, 'ContentOrderRevision'])->name('Content.Order.Revision');
    Route::post('/Change-Content-Writer', [OrdersService::class, 'ChangeContentWriter'])->name('Change.Content.Writer')->middleware('Check_Permissions:Research_detail');
    Route::post('/Remove-Content-Writer', [OrdersService::class, 'removeContentWriter'])->name('Remove.Content.Writer')->middleware('Check_Permissions:Research_detail');

    Route::get('/Edit-Content-Writing-Order/{Order_ID}', ContentEditOrder::class,)->name('Content.Edit.Order')->middleware('Check_Permissions:Content_edit');
    Route::post('/Update-Content-Writing-Order', [ContentEditOrder::class, 'updateContentOrder'])->name('Update.Content.Order');
    Route::get('/Submit-Content-Writing-Order/{Order_ID}', [OrdersService::class, 'submitContentOrder'])->name('Submit.Content.Order')->middleware('Check_Permissions:Content_detail');
    Route::get('/Cancel-Content-Writing-Order/{Order_ID}', [OrdersService::class, 'cancelContentOrder'])->name('Cancel.Content.Order')->middleware('Check_Permissions:Content_detail');
    Route::get('/Delete-Content-Writing-Order/{Order_ID}', [OrdersService::class, 'deleteContentOrder'])->name('Delete.Content.Order')->middleware('Check_Permissions:Content_detail');

    Route::get('/Research-User-Performance', EmployeePerformance::class)->name('Research.Users.Performance')->middleware('Check_Permissions:Writer_Performance_list');
    Route::get('/User-Performance/{EMP_ID}/{Role_ID}', UserPerformance::class,)->name('User.Performance');

    Route::get('/Get-user-performace-details', [EmployeePerformance::class, 'getuserPermanceDetails'])->name('get.user.performance.details');

    Route::get('/Login-History', ViewLoginHistory::class,)->name('Login.History');
    Route::get('/View-All-Notification', UserPortalNotifications::class,)->name('View.All.Notification');

    Route::get('/Content-Canceled-Orders', ContentCanceldOrdersList::class,)->name('Content.Canceled.Orders');
    Route::get('/Research-Canceled-Orders', ResearchCanceldOrdersList::class,)->name('Research.Canceled.Orders');

    //Desiging Order
    Route::get('/Create-Desging-Order', DesignOrderCreate::class)->name('create.design.order');
    Route::post('/Post-Create-Desging-Order', [DesignOrderService::class, 'CreateDesignOrder'])->name('post.create.design.order');
    Route::get('/Design-Order-List', DesignOrderList::class)->name('design.order.list');
    Route::get('/Design-Order-View/{Order_ID}', DesignOrderView::class)->name('Design.Order.View');
    Route::get('/Design-Order-Edit/{Order_ID}', DesignOrderEdit::class)->name('Design.Order.edit');
    Route::post('/Design-Order-Update/{Order_ID}', [DesignOrderService::class, 'updateDesignOrder'])->name('post.update.design.order');
    Route::get('/Design-Order-Cancled/{Order_ID}', [DesignOrderService::class, 'CancaelDesignOrder'])->name('cancle.design.order');
    Route::get('/Design-Order-Delete/{Order_ID}', [DesignOrderService::class, 'DeleteDesignOrder'])->name('delete.design.order');
    Route::post('/Assign-Design-Order', [DesignOrderService::class, 'assignOrder'])->name('Design.Assign.Order');
    Route::post('/Draft-submission-Design-Order', [DesignOrderService::class, 'DesignDraftSubmission'])->name('Design.draft.Submission');
    Route::post('/Final-submission-Design-Order', [DesignOrderService::class, 'DesignOrderSubmission'])->name('Design.final.Submission');
    Route::post('/Revision-Design-Order', [DesignOrderService::class, 'DesignOrderRevision'])->name('Design.Order.Revision');
    Route::post('/Update-Design-Revision-Details', [DesignOrderService::class, 'UpdateDesignRevisionOrder'])->name('Update.Design.Revision.Order');
    Route::post('/Submit-Order-Revision-Design', [DesignOrderService::class, 'SubmitDesignOrderRevision'])->name('Submit.Upload.Order.Revision.Design');

    // Development Order Start
    Route::get('/Create-Development-Order', DevelopmentOrderCreate::class)->name('create.development.order');
    Route::post('/Post-Create-Development-Order', [DevelopmentOrderService::class, 'CreateDevelopmentOrder'])->name('post.create.development.order');
    Route::get('/Development-Order-List', DevelopmentOrderList::class)->name('development.order.list');
    Route::get('/Development-Order-View/{Order_ID}', DevelopmentOrderView::class)->name('Development.Order.View');
    Route::get('/Development-Order-Edit/{Order_ID}', DevelopmentOrderEdit::class)->name('Development.Order.edit');
    Route::post('/Development-Order-Update/{Order_ID}', [DevelopmentOrderService::class, 'updateDevelopmentOrder'])->name('post.update.development.order');
    Route::post('/Assign-Development-Order', [DevelopmentOrderService::class, 'assignOrder'])->name('Development.Assign.Order');
    Route::get('/Development-Order-Cancled/{Order_ID}', [DevelopmentOrderService::class, 'CancelOrder'])->name('cancle.development.order');
    Route::get('/Development-Order-Delete/{Order_ID}', [DevelopmentOrderService::class, 'DeleteOrder'])->name('delete.development.order');
    Route::post('/Revision-Development-Order', [DevelopmentOrderService::class, 'DevelopmentOrderRevision'])->name('Development.Order.Revision');
    Route::post('/Update-Development-Revision-Details', [DevelopmentOrderService::class, 'UpdateDevelopmentRevisionOrder'])->name('Update.Development.Revision.Order');
    Route::post('/Submit-Order-Revision-Development', [DevelopmentOrderService::class, 'SubmitDevelopmentOrderRevision'])->name('Submit.Upload.Order.Revision.Development');
    Route::post('/Draft-submission-Development-Order', [DevelopmentOrderService::class, 'DevelopmentDraftSubmission'])->name('Development.draft.Submission');
    Route::post('/Final-submission-Development-Order', [DevelopmentOrderService::class, 'DevelopmentOrderSubmission'])->name('Development.final.Submission');
    // Development Order End
    Route::get('/User-LogOut', [LoginForm::class, 'UserLogout'])->name('User.LogOut');
});

Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Employee'], static function () {
    Route::get('/Create-Registration', NewEmployee::class,)->name('New.Employee')->middleware('Check_Permissions:Employee_create');
    Route::post('/Submit-Registration', [NewEmployee::class, 'UserRegistration'])->name('Auth.Reg.User')->middleware('Check_Permissions:Employee_create');
    Route::get('/Users-List', AllEmployees::class,)->name('All.Employee')->middleware(
        'Check_Permissions:Employee_list'
    );
    Route::get('/View-User/{EMP_ID}', ViewEmployee::class,)->name('View.Employee')->middleware('Check_Permissions:Employee_detail');
    Route::post('/Update-Basic-Info', [ViewEmployee::class, 'updateEMPBasicInfo'])->name('Update.Basic.Employee.Info');
    Route::post('/Update-Leave-Info', [ViewEmployee::class, 'updateEMPLeaveInfo'])->name('Update.Leave.Employee.Info')->middleware('Check_Permissions:Employee_edit');
    Route::post('/Update-Bank-Info', [ViewEmployee::class, 'updateEMPBankInfo'])->name('Update.Bank.Employee.Info')->middleware('Check_Permissions:Employee_edit');
    Route::post('/Update-Password', [ViewEmployee::class, 'updateEMPPassword'])->name('Update.Employee.Password');
    Route::post('/Update-Image', [ViewEmployee::class, 'updateProfileImage'])->name('Update.Profile.Image');

    Route::get('/Deactivate-Employee', TrashEmployee::class)->name('employee.trashed');
    Route::get('/Permenet-Delete-Employee/{EMP_ID}', [TrashEmployee::class, 'ForceDelete'])->name('employee.force.delete');
});

Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Pre-Villages'], static function () {
    Route::get('/All-Departments', AllDepartments::class,)->name('All.Departments')->middleware('Check_Permissions:department_view');
    Route::post('/Post-Department', [AllDepartments::class, 'postDepartment'])->name('Post.Department')->middleware('Check_Permissions:department_view');
    Route::get('/Delete-Department/{Dep_ID}', [AllDepartments::class, 'deleteDepartment'])->name('Delete.Department')->middleware('Check_Permissions:department_view');

    Route::get('/Users-Designations', AllDesignations::class,)->name('All.Designations')->middleware('Check_Permissions:designation_view');
    Route::post('/Post-Designation', [AllDesignations::class, 'postDesignations'])->name('Post.Designation')->middleware('Check_Permissions:designation_view');
    Route::get('/Delete-Designation/{Role_ID}', [AllDesignations::class, 'deleteDesignation'])->name('Delete.Designation')->middleware('Check_Permissions:designation_view');

    Route::get('/Order-Services', AllOrderServices::class,)->name('All.Services')->middleware('Check_Permissions:Services_view');
    Route::post('/Post-Service', [AllOrderServices::class, 'postService'])->name('Post.Service')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Service/{Service_ID}', [AllOrderServices::class, 'deleteService'])->name('Delete.Service')->middleware('Check_Permissions:Services_view');

    Route::post('/Post-Skill', [AllOrderServices::class, 'postSkill'])->name('Post.Skill')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Skill/{Skill_ID}', [AllOrderServices::class, 'deleteSkill'])->name('Delete.Skill')->middleware('Check_Permissions:Services_view');

    Route::get('/Order-Websites', AllOrderWebsites::class,)->name('All.Websites')->middleware('Check_Permissions:Services_view');
    Route::post('/Post-Website', [AllOrderWebsites::class, 'postWebsite'])->name('Post.Website')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Website/{Web_ID}', [AllOrderWebsites::class, 'deleteWebsite'])->name('Delete.Website')->middleware('Check_Permissions:Services_view');

    Route::get('/Order-Writing-Styles', AllWritingStyles::class,)->name('All.Styles')->middleware('Check_Permissions:Services_view');
    Route::post('/Post-Style', [AllWritingStyles::class, 'postStyle'])->name('Post.Style')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Style/{Style_ID}', [AllWritingStyles::class, 'deleteStyle'])->name('Delete.Style')->middleware('Check_Permissions:Services_view');

    Route::get('/Order-Voices', AllOrderVoices::class,)->name('All.Voices')->middleware('Check_Permissions:Services_view');
    Route::post('/Post-Voice', [AllOrderVoices::class, 'postVoice'])->name('Post.Voice')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Voice/{Voice_ID}', [AllOrderVoices::class, 'deleteVoice'])->name('Delete.Voice')->middleware('Check_Permissions:Services_view');

    Route::get('/Order-Industries', AllIndustries::class,)->name('All.Industries')->middleware('Check_Permissions:Services_view');
    Route::post('/Post-Industry', [AllIndustries::class, 'postIndustry'])->name('Post.Industry')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Industry/{Industry_ID}', [AllIndustries::class, 'deleteIndustry'])->name('Delete.Industry')->middleware('Check_Permissions:Services_view');

    Route::get('/Order-Generics', AllGenericType::class,)->name('All.Generics')->middleware('Check_Permissions:Services_view');
    Route::post('/Post-Generic', [AllGenericType::class, 'postGeneric'])->name('Post.Generic')->middleware('Check_Permissions:Services_view');
    Route::get('/Delete-Generic/{Generic_ID}', [AllGenericType::class, 'deleteGeneric'])->name('Delete.Generic')->middleware('Check_Permissions:Services_view');

    Route::get('/Add-Portal-Permissions', AddPermissions::class,)->name('Add.Portal.Permissions');
    Route::post('/Post-Portal-Permissions', [CreateUpdatePortalPermissions::class, 'submitPortalPermissions'])->name('Post.Portal.Permissions')->middleware('Check_Role');

    Route::get('/Preferred-Language', PreferredLanguage::class)->name('preferred.language');
    Route::post('/Post-Preferred-Language', [PreferredLanguage::class, 'submitPreferredLanguage'])->name('post.preferred.language');
    Route::get('/Delete-Preferred-Language/{id}', [PreferredLanguage::class, 'DeletePreferredLanguage'])->name('delete.preferred.language');

    Route::get('/Get-Searching-Queries', SearchingQueries::class,)->name('Searching.Queries');
});

Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Attendance'], static function () {
    Route::get('/View-All-User-Attendance', ViewAll::class,)->name('Users.Attendance');
    Route::get('/Mark-User-Attendance', MarkUserAttendance::class,)->name('Mark.Users.Attendance');
    Route::get('/My-Attendance/{User_ID}', UserAttendance::class,)->name('My.Attendance');
    Route::post('/Mark-Check-In', [UserAttendance::class, 'markUserAttendanceIn'])->name('Mark.Check.In');
    Route::post('/Mark-Check-Out', [UserAttendance::class, 'markUserAttendanceOut'])->name('Mark.Check.Out');
});


Route::group(['prefix' => 'Notice'], function () {
    Route::get('/View-All', NoticeBoards::class)->name('Get.Notices');
    Route::post('/Submit-Notice', [NoticeBoards::class, 'postNotice'])->name('Post.Notice');
    Route::get('/Delete/{Notice_ID}', [NoticeBoards::class, 'deleteNotice'])->name('Delete.Notice');
    Route::get('/Notice-Detail', [NoticeBoards::class, 'noticeDetail'])->name('Detail.Notice');
    Route::get('/Edit-Notice-Detail', [NoticeBoards::class, 'editNoticeDetail'])->name('Edit.Detail.Notice');
    Route::post('/Edit-Notice/{Notice_ID}', [NoticeBoards::class, 'postEditNotice'])->name('Post.Edit.Notice');
    Route::get('/Delete-Notice-Image/{Notice_ID}', [NoticeBoards::class, 'deleteNoticeImage'])->name('Delete.Notice.Image');
    Route::get('/check-active-notices', [NoticeBoards::class, 'checkActiveNotices'])->name('check.active.notices');
    Route::post('/Submit-Survey-Answers', [NoticeBoards::class, 'submitSurveyAnswers'])->name('submit.survey.answers');
    Route::get('/View-Notice-Board-Answers/{Notice_ID}', ViewNoticeAnswers::class)->name('view.notice.boards.answers');
    Route::get('/View-Answer-Users', [ViewNoticeAnswers::class, 'ViewAnswerUsers'])->name('view.answer.user');
        Route::get('/Check-Session-Status', [NoticeBoards::class,'checkSessionStatus'])->name('check.session.status');
        Route::get('/Destroy-Session-Status', [NoticeBoards::class,'destroySessionStatus'])->name('reset.session.interval');
});

// Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Leave-Entitlement'], static function () {
//     Route::get('/Setting', LeaveSettings::class)->name('Leave.Setting');
//     Route::post('/Submit', [LeaveSettings::class, 'postLeaveInfo'])->name('Submit.Leave.Setting');
//     Route::post('/Update-Setting', [LeaveSettings::class, 'updateLeaveSetting'])->name('Update.Leave.Setting');
//     Route::get('/Delete-Setting/{Leave_ID}', [LeaveSettings::class, 'deleteLeaveInfo'])->name('Delete.Leave.Setting');

//     Route::get('/Leave-Request', UserLeaveRequest::class)->name('Leave.Request');
//     Route::post('/Post-Request', [UserLeaveRequest::class, 'postLeaveRequest'])->name('Post.Leave.Request');

//     Route::get('/Received-Requests', ReceivedLeaveRequest::class)->name('Received.Request');
//     Route::post('/Accept-Request', [ReceivedLeaveRequest::class, 'acceptLeaveRequest'])->name('Accept.Request');
//     Route::post('/Reject-Request', [ReceivedLeaveRequest::class, 'rejectLeaveRequest'])->name('Reject.Request');

//     Route::get('/User-Quota', UserLeaveQuotaView::class)->name('User.Leave.Quota');
// });


Route::get('/company-policy' , Policy::class)->name('company.policy');
Route::post('/update-company-policy' , [Policy::class , 'updateCompanyPolicy'])->name('update.company.policy');



Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Leave-Entitlement'], static function () {
    Route::get('/Setting', LeaveSettings::class)->name('Leave.Setting');
    Route::post('/Submit', [LeaveSettings::class, 'postLeaveInfo'])->name('Submit.Leave.Setting');
    Route::post('/Update-Setting', [LeaveSettings::class, 'updateLeaveSetting'])->name('Update.Leave.Setting');
    Route::get('/Delete-Setting/{Leave_ID}', [LeaveSettings::class, 'deleteLeaveInfo'])->name('Delete.Leave.Setting');
    Route::get('/Leave-Request', UserLeaveRequest::class)->name('Leave.Request');
    Route::post('/Post-Request', [UserLeaveRequest::class, 'postLeaveRequest'])->name('Post.Leave.Request');
    Route::get('/Received-Requests', ReceivedLeaveRequest::class)->name('Received.Request');
    Route::post('/Accept-Request', [ReceivedLeaveRequest::class, 'acceptLeaveRequest'])->name('Accept.Request');
    Route::post('/Reject-Request', [ReceivedLeaveRequest::class, 'rejectLeaveRequest'])->name('Reject.Request');
    Route::get('/User-Quota', UserLeaveQuotaView::class)->name('User.Leave.Quota');
    Route::get('/Mark-Users-Leave', MarkUsersLeave::class)->name('Mark.Users.Leave');
    Route::post('/Mark-Users-Leave', [MarkUsersLeave::class, 'markLeave'])->name('Post.Mark.Users.Leave');
});


Route::prefix('Payroll')->group(function () {
    Route::get('/Allowance-Setting', AllowanceSetting::class)->name('allowance.setting');
    Route::post('/Submit-Allowance-Setting', [AllowanceSetting::class, 'SubmitAllowanceSetting'])->name('submit.add.allowance');
    Route::get('/Delete-Allowance/{id}', [AllowanceSetting::class, 'DeleteAllowance'])->name('delete.allowance');
    Route::get('/detaction-setting', DetactionSetting::class)->name('detaction.setting');
    Route::get('/get-detaction-setting', [DetactionSetting::class, 'getDetactionSetting'])->name('get.detaction.setting');
    Route::post('/update-detact-ammount', [DetactionSetting::class, 'updateDetactAmmount'])->name('update.detact.ammount');
    Route::get('/generate-payslip', Payslip::class)->name('generate.payslip');
    Route::post('/submit-generate-payslip', [Payslip::class, 'SubmitGeneratePayslip'])->name('submit.generate.slip');
});



Route::group(['middleware' => ['Authorized', 'Encrypted_Route'], 'prefix' => 'Human-Resource'], static function () {
    // Benchmark
    Route::get('/Targets', AssignedTargets::class)->name('Assigned.Targets');
    Route::post('/Assigned-Target', [AssignedTargets::class, 'assignUserTarget'])->name('Assigned.Target');
    Route::get('/Delete-Target/{Bench_ID}', [AssignedTargets::class, 'deleteUserTarget'])->name('Delete.Target');

    Route::post('/Mark-Attendance', [MarkUserAttendance::class, 'markAttendance'])->name('Mark.Attendance');
    Route::post('/Update-Attendance', [MarkUserAttendance::class, 'updateAttendance'])->name('Update.Attendance');

    Route::get('/Get-Mark-Attendance', [MarkUserAttendance::class, 'getMarkAttendance'])->name('Get.Mark.Attendance');
    Route::get('/Mark-Holiday', MarkHoliday::class)->name('Mark.Holiday');
    Route::post('/Mark-Holiday', [MarkHoliday::class, 'markHoliday'])->name('Post.Mark.Holiday');
});

Route::group(['prefix' => 'AJAX'], static function () {


    Route::get('/Get-Clients', [AjaxController::class, 'getRegClient'])->name('Get.Clients');
    Route::get('/Get-Client-Info', [AjaxController::class, 'getClientInfo'])->name('Get.Client.Info');
    Route::get('/Get-Task-Revisions', [AjaxController::class, 'getTaskRevisions'])->name('Get.Task.Revisions');
    Route::get('/Get-Edit-Task-Info', [AjaxController::class, 'getEditTaskInfo'])->name('Get.Edit.Task.Info');
    Route::get('/Get-Order-Rev-Info', [AjaxController::class, 'getOrderInfo'])->name('Get.Order.Rev.Info');
    Route::get('/Get-Content-Writer-Info', [AjaxController::class, 'getContentWriterInfo'])->name('Get.Content.Writer.Info');

    // Re-Search Order Chat Routes
    Route::post('/Post-Message', [AjaxController::class, 'postOrderChatMessages'])->name('Post.Message');
    Route::get('/Get-Chat-Messages', [AjaxController::class, 'getOrderChatMessages'])->name('Get.Messages');
    Route::get('/Forward-To-Executive', [AjaxController::class, 'forwardToExecutive'])->name('Forward.To.Executive');

    // Portal Permissions Routes
    Route::get('/Get-Portal-Permissions', [AjaxController::class, 'getPortalPermissions'])->name('Get.Portal.Permissions')->middleware('Check_Role');
    Route::post('/Update-Portal-Permissions', [CreateUpdatePortalPermissions::class, 'updatePortalPermission'])->name('Update.Portal.Permission');

    // Portal Notifications Routes
    Route::get('/Get-Portal-Notifications', [AjaxController::class, 'getPortalNotification'])->name('Get.Portal.Notifications');
    Route::get('/Mark-Read', [AjaxController::class, 'markAsReadNotification'])->name('Mark.Read');
    Route::get('/Mark-Read-Notification/{Notify_ID}', [AjaxController::class, 'markReadNotification'])->name('Mark.Read.Notification');
    Route::get('/Mark-Read-All', [AjaxController::class, 'markAsAllReadNotification'])->name('Mark.Read.All');

    // Searching Routes
    Route::get('/Get-Search-Records', [AjaxController::class, 'getSearchingRecords'])->name('Get.Search.Records');

    // Attendance
    Route::get('/Get-Attendance-Info/{Attend_ID}', [AjaxController::class, 'getAttendInfo'])->name('Get.Attend.Info');

    // Leave Entitlements
    Route::get('/Get-Leave-Info', [AjaxController::class, 'getLeaveInfo'])->name('Get.Leave.Info');

    // Employee
    Route::get('/Get-Employee', [AjaxController::class, 'getEmpClient'])->name('Get.Employee');
    Route::get('/Get-Employee-Info', [AjaxController::class, 'getEmpInfo'])->name('Get.Emp.Info');

    //Get Attendance Data
    Route::get('/Get-Attendance-Data', [AjaxController::class, 'getAttendData'])->name('Get.Employee.Attendance');

    // Get Portal Errors
    Route::get('/Get-Portal-Errors', [AjaxController::class, 'getPortalErrorFounds'])->name('Get.Portal.Errors');

    Route::get('/Delete-Revision-Data/{id}', [OrdersService::class, 'DeleteRevisionData'])->name('Delete.Revision.Data');


    Route::post('/Update-Revision-Details', [OrdersService::class, 'UpdateRevisionOrder'])->name('Update.Revision.Order');

    Route::post('/Update-Content-Revision-Details', [OrdersService::class, 'UpdateContentRevisionOrder'])->name('Update.Content.Revision.Order');
    Route::post('/Submit-Content-Revision', [OrdersService::class, 'ContentRevisionSubmission'])->name('Submit.Upload.Content.Revision');
    Route::get('/Get-Revision-Details-Attachment', [OrdersService::class, 'GetRevisionDetailsAndAttachment'])->name('Get.Revision.Deatils.Attachment');
    Route::get('/Get-Revision-Data', [OrdersService::class, 'GetRevisionData'])->name('Get.Revision.Data');
    Route::post('/Remove-cordinator', [ReasearchOrdersView::class, 'RemoveCordinator'])->name('Remove.Cordinator');
});


Route::group(['middleware' => ['Authorized'], 'prefix' => 'Trashed'], static function () {
    Route::get('/Deleted-Research-Orders', ResearchDeletedOrders::class,)->name('Trash.Research.Orders');
    Route::get('/Restore-Research-Orders/{Order_ID}', [ResearchOrderService::class, 'restoreOrder'])->name('Restore.Research.Orders');
    Route::get('/Delete-Research-Orders/{Order_ID}', [ResearchOrderService::class, 'deleteOrder'])->name('Delete.Research.Orders');

    Route::get('/Deleted-Content-Orders', ContentDeletedOrders::class)->name('Trash.Content.Orders');
    Route::get('/Restore-Content-Orders/{Order_ID}', [ContentOrderService::class, 'restoreOrder'])->name('Restore.Content.Orders');
    Route::get('/Delete-Content-Orders/{Order_ID}', [ContentOrderService::class, 'deleteOrder'])->name('Delete.Content.Orders');

    Route::get('/Deleted-Users', DeletedUsers::class)->name('Trash.Deleted.Orders')->middleware('Check_Role');
    Route::get('/Delete-User/{EMP_ID}', [DeletedUsers::class, 'deleteEmployee'])->name('Delete.Employee')->middleware('Check_Role');
    Route::get('/Delete-All-Users', [DeletedUsers::class, 'deleteAllEmployee'])->name('Delete.All.Employee')->middleware('Check_Role');
    Route::get('/Restore-User/{EMP_ID}', [DeletedUsers::class, 'restoreEmployee'])->name('Restore.Employee')->middleware('Check_Role');
    Route::get('/Restore-All-Users', [DeletedUsers::class, 'restoreAllEmployee'])->name('Restore.All.Employee')->middleware('Check_Role');
});

Route::group(['middleware' => ['Authorized'], 'prefix' => 'Download'], static function () {
    Route::get('/Download-File/{File_Path}', [PortalHelpers::class, 'downloadFile'])->name('File.Download');
});

Route::group(['middleware' => ['Authorized'], 'prefix' => 'Error'], static function () {
    Route::get('/Portal-Error-Found/{Message}', ExceptionMessage::class)->name('Error.Response');
    Route::get('/Portal-Errors', ErrorsList::class)->name('Portal.Errors');
});

Route::get('/Testing', [TestingController::class, 'index'])->name('Testing');
Route::get('/play-notification-sound', static function () {
    event(new NotificationCreated('OC-06-2023-1'));
});

Route::get('/Import-Deadlines', ImportDeadlines::class)->name('Import.DeadLines');
Route::post('/Post-Import-Deadlines', [ImportDeadlines::class, 'import'])->name('Post.Import.DeadLines');
