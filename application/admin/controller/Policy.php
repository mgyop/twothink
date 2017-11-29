<?php
namespace app\admin\controller;

class Policy extends Admin
{
    public function add()
    {
        if (request()->isPost()){

        }else{
            //加载视图
            return $this->fetch();
        }
    }
}
