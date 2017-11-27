<?php
 
namespace app\admin\validate;
use think\Validate; 

class Repair extends Validate{
     
    protected $rule = [ 
        ['name', 'require', '名称不能为空'],
        ['tel', 'require', '电话不能为空'],
        ['address', 'require', '地址不能为空'],
        ['question', 'require', '问题描述不能为空']
    ];
}