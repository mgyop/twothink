<?php
namespace app\home\controller;

use think\Db;

class Repair extends Home
{
    /**
     * 添加
     * @return mixed|void
     */
    public function online()
    {
        if(request()->isPost()){
            $Repair = model('repair');
            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            //补充字段数据
            $post_data['sn'] = date('Ymd').uniqid();
            //赋值数据
            $Repair->data($post_data);
            $result = $Repair->create($post_data);
            if($result){
                $this->success('报修成功', url('index'));
                //记录行为
//                action_log('update_repair', 'repair', $data->id, id);
            } else {
                $this->error($Repair->getError());
            }
        } else {
            //展示添加表单
            $this->assign('meta_title','在线报修');
            $this->assign('info','添加');
            return $this->fetch();
        }
    }
}