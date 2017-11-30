<?php
namespace app\admin\controller;


use think\Db;

class Auto extends Admin
{
    public function autoDel()
    {
        $map = [];
        $map['deadline'] = ['<',time()];
        $map['status'] = 1;
        $map['category_id'] = ['in',[49,50]];
        $document = Db::name('document');
        $res = $document->where($map)->update(['status'=>0]);
//        $sql = $document->getLastSql();
        if ($res){
            echo '操作成功\n';
        }
    }
}