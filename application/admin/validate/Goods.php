<?php
 
namespace app\admin\validate;
use think\Validate; 

class Goods extends Validate{
     
    protected $rule = [
        ['document_id', 'require'],
        ['tel', 'require', '电话不能为空'],
        ['price', 'require', '价格不能为空']
    ];
}