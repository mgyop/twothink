<?php
 
namespace app\home\validate;
use think\Validate; 

class Confirm extends Validate{
     
    protected $rule = [ 
        ['name', 'require', '名称不能为空'],
        ['tel', 'require|^1[3458]\d{9}$', '电话不能为空|请输入正确的手机号'],
        ['address_num', 'require', '房号不能为空'],
        ['id_card', 'require', '身份证号不能为空'],
    ];
}