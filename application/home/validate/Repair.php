<?php
 
namespace app\home\validate;
use think\Validate; 

class Repair extends Validate{
     
    protected $rule = [ 
        ['name', 'require', '名称不能为空'],
        ['tel', 'require|^1[3458]\d{9}$', '电话不能为空|请输入正确的手机号'],
        ['address', 'require', '地址不能为空'],
        ['question', 'require', '问题描述不能为空']
    ];
}