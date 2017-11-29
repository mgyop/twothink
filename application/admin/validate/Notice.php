<?php
 
namespace app\admin\validate;
use think\Validate; 

class Repair extends Validate{
     
    protected $rule = [ 
        ['title', 'require', '名称不能为空'],
        ['des', 'require', '描述不能为空'],
        ['content', 'require', '详情不能为空']
    ];
}