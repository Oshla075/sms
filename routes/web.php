<?php

use App\Http\Controllers\Admin\Guardian\GuardianController;
use App\Http\Controllers\Admin\Maincontroller;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Settings\Class_FeesController;
use App\Http\Controllers\Admin\Settings\ClassController;
use App\Http\Controllers\Admin\Settings\RoomController;
use App\Http\Controllers\Admin\Settings\SectionController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Settings\SubjectsController;
use App\Http\Controllers\Admin\Settings\VehiclesController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('Admin.Layout.main');
});
Route::get('/admin/dashboard',[Maincontroller::class,'index'])->name('admin.dashboard');
Route::get('/admin/system',[Maincontroller::class,'system'])->name('admin.system');
Route::post('/admin/system/create',[SettingsController::class,'create'])->name('admin.system.create');
Route::post('/admin/system/update',[SettingsController::class,'update'])->name('admin.system.update');
Route::get('/admin/section',[Maincontroller::class,'section'])->name('admin.section');

Route::get('/admin/class',[Maincontroller::class,'class'])->name('admin.class');
Route::post('/admin/class/create',[ClassController::class,'create'])->name('admin.class.create');
Route::get('/admin/class/getclass',[ClassController::class,'getClass'])->name('getClass');
Route::post('/admin/class/update',[ClassController::class,'update'])->name('admin.class.update');

Route::get('/admin/student/getqual/{id}',[StudentController::class,'getqual'])->name('getqual','{id}');
Route::get('/admin/room',[Maincontroller::class,'room'])->name('admin.room');
Route::post('/admin/room/create',[RoomController::class,'create'])->name('admin.room.create');
Route::get('/admin/room/getroom',[RoomController::class,'getRoom'])->name('getRoom');
Route::post('/admin/room/update',[RoomController::class,'update'])->name('admin.room.update');
Route::get('/admin/chk_any',[Maincontroller::class,'chk_any'])->name('admin.chk_any');
Route::get('/admin/chk_any2',[Maincontroller::class,'chk_any2'])->name('admin.chk_any2');
Route::get('/admin/get_any2',[Maincontroller::class,'get_any2'])->name('admin.get_any2');
Route::get('/admin/get_any2_order',[Maincontroller::class,'get_any2_order'])->name('admin.get_any2_order');

Route::post('/admin/section/create',[SectionController::class,'create'])->name('admin.section.create');
Route::post('/admin/section/update',[SectionController::class,'update'])->name('admin.section.update');
Route::post('/admin/section/update_room',[SectionController::class,'update_room'])->name('admin.section.room.update');
Route::get('/admin/guardian',[Maincontroller::class,'guardian'])->name('admin.guardian');
Route::get('/admin/guardian/edit/{id}',[GuardianController::class,'edit'])->name('admin.guardian.edit','{id}');
Route::post('/admin/guardian/create',[GuardianController::class,'create'])->name('admin.guardian.create');
Route::post('/admin/guardian/id_update',[GuardianController::class,'id_update'])->name('admin.guardian.id_update');
// Route::get('/admin/guardian/delete/{id}',[GuardianController::class,'delete'])->name('admin.guardian.delete','{id}');
Route::get('/admin/guardian/delete',[GuardianController::class,'delete'])->name('admin.guardian.delete');
Route::post('/admin/guardian/update',[GuardianController::class,'update'])->name('admin.guardian.update');
Route::get('/admin/student',[Maincontroller::class,'student'])->name('admin.student');
Route::post('/admin/student/create',[StudentController::class,'create'])->name('admin.student.create');
Route::get('/admin/student/edit/{id}/{data}',[StudentController::class,'edit'])->name('admin.student.edit','{id}','{data}');
// Route::get('/admin/student/delete/{id}/',[StudentController::class,'delete'])->name('admin.student.delete','{id}');
Route::get('/admin/student/delete/',[StudentController::class,'delete'])->name('admin.student.delete');
Route::post('/admin/student/update',[StudentController::class,'update'])->name('admin.student.update');
Route::post('/admin/student/update_class',[StudentController::class,'update_class'])->name('admin.student.update_class');
Route::get('/admin/test',[Maincontroller::class,'test'])->name('admin.test');
Route::post('/admin/test1',[Maincontroller::class,'test1'])->name('admin.test1');
Route::get('/admin/class_fees',[Maincontroller::class,'class_fees'])->name('admin.class_fees');
Route::post('/admin/class_fees/create',[Class_FeesController::class,'class_fees'])->name('admin.class_fees.create');
Route::get('/admin/student/view',[StudentController::class,'student_view'])->name('admin.student_view');
Route::get('/admin/student/list',[StudentController::class,'student_list'])->name('admin.student_list');
Route::get('/upload_image',[Maincontroller::class,'upload_image'])->name('upload_image');
Route::post('/insert_image',[Maincontroller::class,'insert_image'])->name('insert_image');
Route::post('/edit_multi_docs',[Maincontroller::class,'edit_multi_docs'])->name('edit_multi_docs');
Route::post('/edit_multi_docs_2',[Maincontroller::class,'edit_multi_docs_2'])->name('edit_multi_docs_2');
Route::post('/edit_multi_docs_3',[Maincontroller::class,'edit_multi_docs_3'])->name('edit_multi_docs_3');
Route::get('/admin/guardian/getgurdetails',[GuardianController::class,'getgurdetails'])->name('admin.guardian.getgurdetails');
Route::get('/admin/data_fetch',[Maincontroller::class,'data_fetch'])->name('admin.data_fetch');
Route::get('/admin/subjects',[Maincontroller::class,'subjects'])->name('admin.subjects');
Route::post('/admin/subjects/create',[SubjectsController::class,'create'])->name('admin.subjects.create');
Route::get('/admin/vehicles',[Maincontroller::class,'vehicles'])->name('admin.vehicles');
Route::post('/admin/vehicles/create',[VehiclesController::class,'create'])->name('admin.vehicles.create');
Route::get('/admin/multi_data_remove/{id}/{all_doc}/{g_id}/{chk_id}/{up_field}/{tb}/{dir}',[Maincontroller::class,'multi_data_remove']);
Route::get('/admin/teacher',[Maincontroller::class,'teacher'])->name('admin.teacher');
Route::post('/admin/teacher/create',[TeacherController::class,'create'])->name('admin.teacher.create');
Route::get('/admin/teacher/view',[TeacherController::class,'view'])->name('admin.teacher.view');

Route::get('/admin/subject_categories',[Maincontroller::class,'subject_categories'])->name('admin.subject_categories');
Route::post('/admin/subject_categories/create',[SubjectsController::class,'subject_categories_create'])->name('admin.subject_categories.create');
Route::get('/admin/subject_categories/getsubject_categories',[SubjectsController::class,'getsubject_categories'])->name('getsubject_categories');
Route::post('/admin/subject_categories/update',[SubjectsController::class,'subject_categories_update'])->name('admin.subject_categories.update');

Route::get('/admin/assign_teacher',[SubjectsController::class,'assign_teacher'])->name('admin.assign_teacher');
Route::post('/admin/assign_teacher',[SubjectsController::class,'assign_teacher_insert'])->name('admin.assign_teacher_insert');
Route::post('/admin/assign_cls_teacher',[TeacherController::class,'assign_cls_teacher'])->name('admin.assign_cls_teacher');
Route::get('/admin/get_subject',[SubjectsController::class,'get_subject'])->name('admin.get_subject');
Route::get('/admin/get_other_subject',[SubjectsController::class,'get_other_subject'])->name('admin.get_other_subject');
Route::get('/admin/get_other_subject_2',[SubjectsController::class,'get_other_subject_2'])->name('admin.get_other_subject_2');

Route::get('/admin/teacher/edit/{id}',[TeacherController::class,'edit'])->name('admin.teacher.edit','{id}');
Route::post('/admin/teacher/update',[TeacherController::class,'update'])->name('admin.teacher.update');
Route::post('/admin/teacher/other_sub_assign',[TeacherController::class,'other_sub_assign'])->name('admin.teacher.other_sub_assign');

Route::get('/admin/generate_stu_roll',[Maincontroller::class,'generate_stu_roll'])->name('admin.generate_stu_roll');
Route::get('/admin/gen_roll',[Maincontroller::class,'gen_roll'])->name('admin.gen_roll');
Route::get('/admin/student/attendance',[StudentController::class,'student_attendance'])->name('admin.student_attendance');





Route::post('/admin/add_product',[ProductsController::class,'add_product'])->name('admin.add_product');
Route::get('/admin/add_p_form',[ProductsController::class,'add_p_form'])->name('admin.add_p_form');
Route::post('/admin/insert_p_form',[ProductsController::class,'insert_p_form'])->name('admin.insert_p_form');
Route::get('/admin/add_disease',[ProductsController::class,'add_disease'])->name('admin.add_disease');
Route::post('/admin/insert_disease',[ProductsController::class,'insert_disease'])->name('admin.insert_disease');




Route::get('/admin/front/search_product',[ProductsController::class,'search_product'])->name('admin.search_product');
Route::get('/admin/front/product_details',[ProductsController::class,'product_details'])->name('admin.product_details');

Route::get('/file-import',[ProductsController::class,'importView'])->name('import-view');
Route::post('/import',[ProductsController::class,'import2'])->name('import');
Route::get('/export-users',[ProductsController::class,'exportUsers'])->name('export-users');

Route::get('/admin/addproduct2',[ProductsController::class,'addproduct2'])->name('admin.addproduct2');

Route::get('/excel_view',[Maincontroller::class,'excel_view'])->name('excel_view');

Route::post('/admin/roll_form_submit',[Maincontroller::class,'roll_form_submit'])->name('admin.roll_form_submit');



