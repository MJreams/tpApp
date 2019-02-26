noPhone接口说明文档：

## 登陆：

教师：http://tp.lovey0u.cn/teacherlogin/TEA/Name/TEA_Pass
学生： http://tp.lovey0u.cn/Studentlogin/STU_Name/STU_Pass
`STU_Name:用户名  STU_Pass:密码`

`200 成功`

`201 密码错误`

`202 用户名不存在`

## 注册：

学生： http://tp.lovey0u.cn/Studentregister/wwx/wwx/phone/vercode
教师：http://tp.lovey0u.cn/Teacherregister/wwx/wwx/phone/vercode
`vercode可选参数，不带vercode时给手机发送验证码，带验证码时检验验证码是否正确`
`300 注册成功`
`301手机号不合法或者用户名不合法`
`302 手机号已经存在或者用户名已经存在`
`303 验证码发送失败`
`304 验证码发送成功`
`305 验证码错误`

## 搜索课程：

http://tp.lovey0u.cn/search/COU_Id

`400 查找成功  data是个数据数组`
`401  课程id不存在`

## 添加课程

http://tp.lovey0u.cn/addcourse/TEA_Id/COU_Name/COU_Dep/COU_School/COU_Tel

`TEA_Id:教师id必须存在`

`500:添加成功`

`501:主表添加成功`

`502：连接表添加成功`

## 删除课程

http://tp.lovey0u.cn/delcourse/COU_Id

`COU_Id:必须存在`

`600 删除成功`

`601 主表删除失败`

`602 连接表删除失败`

## 添加课程中的模块（module）

http://tp.lovey0u.cn/addModule/COU_Id/MOD_Name

`COU_Id:课程id号，必须是已经存在的`

`MOD_Name:  module名称`

`500：添加成功`

`501：主表添加成功`

`502：连接表添加成功`

## 删除课程中的模块

http://tp.lovey0u.cn/delModule/MOD_Id

`MOD_Id：模块id`

`600 删除成功`

`601 主表删除失败`

`602 连接表删除失败`

