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
Route::rule('Studentlogin/:STU_Name/:STU_Pass','login/StudentloginController/login');
//教师登陆路由
Route::rule('teacherlogin/:TEA_Name/:TEA_Pass','login/Teacherlogincontroller/login');
//学生注册路由
Route::rule('studentregister/:STU_Name/:STU_Pass/:STU_Phone/[:STU_Vercode]','register/StudentregisterController/register');
//教师注册路由
Route::rule('teacherregister/:TEA_Name/:TEA_Pass/:TEA_Phone/[:TEA_Vercode]','register/TeacherregisterController/register');
//课程号查询课程
Route::rule('search/:COU_Id','search/SearchcourseController/searchCourseID');
//老师添加课程
Route::rule('addcourse/:TEA_Id/:COU_Name/:COU_Dep/:COU_School/:COU_Tel','addcourse/AddCourseController/addCourse');