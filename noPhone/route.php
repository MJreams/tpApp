<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//学生登陆路由
Route::rule('Studentlogin/:STU_Name/:STU_Pass','login/StudentLoginController/login');
//教师登陆路由
Route::rule('teacherlogin/:TEA_Name/:TEA_Pass','login/TeacherLogincontroller/login');
//学生注册路由
Route::rule('studentregister/:STU_Name/:STU_Pass/:STU_Phone/[:STU_Vercode]','register/StudentregisterController/register');
//教师注册路由
Route::rule('teacherregister/:TEA_Name/:TEA_Pass/:TEA_Phone/[:TEA_Vercode]','register/TeacherregisterController/register');
//课程号查询课程
Route::rule('search/:COU_Id','search/SearchcourseController/searchCourseID');
//老师添加课程
Route::rule('addcourse/:TEA_Id/:COU_Name/:COU_Dep/:COU_School/:COU_Tel','addcourse/AddCourseController/addCourse');
//删除课程
Route::rule('delcourse/:COU_Id','addcourse/AddCourseController/delCourse');
//添加课程内的单元
Route::rule('addmodule/:COU_Id/:MOD_Name','addmodule/AddModuleController/addmodule');
//删除课程内的单元
Route::rule('delmodule/:MOD_Id','addmodule/AddModuleController/delmodule');
//上传文件
Route::rule('uploadFile','upload/UploadFileController/uploadFile');

//接收图片
//Route::rule('receiveImage','upload/UploadImageController/receiveImage');