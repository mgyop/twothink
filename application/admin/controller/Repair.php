<?php
namespace app\admin\controller;

use think\Db;

class Repair extends Admin
{
    /**
     * 列表
     * @return mixed
     */
    public function index()
    {
        $list = \think\Db::name('Repair')->select();
        $this->assign('_list', $list);
        $this->assign('meta_title','报修列表');
        return $this->fetch();
    }

    public function del($id=0)
    {
        if (!$id){
            $this->error('参数错误!');
        }
        $repair = \think\Db::name('repair');
        $result = $repair->where('id','eq',$id)->delete();
        if ($result){
            $this->success('删除成功', url('index'));
            //记录行为
            action_log('delete_repair', 'repair', $id, id);
        } else {
            $this->error($repair->getError());
        }
    }
    public function dels()
    {
        $postData=\think\Request::instance()->post();
        $ids = $postData['id'];
        if (empty($ids)){
            $this->error('参数错误!');
        }
        $repair = \think\Db::name('repair');
        $result = $repair->where('id','in',$ids)->delete();
        if ($result){
            $this->success('删除成功', url('index'));
            //记录行为
            action_log('delete_repair', 'repair', $ids, id);
        } else {
            $this->error($repair->getError());
        }
    }
    public function complete()
    {
        $postData=\think\Request::instance()->post();
        $ids = $postData['id'];
        if (empty($ids)){
            $this->error('参数错误!');
        }
        $repair = \think\Db::name('repair');
        $result = $repair->where('id','in',$ids)->update(['status'=>1,'update_time'=>time()]);
        if ($result){
            $this->success('删除成功', url('index'));
            //记录行为
            action_log('delete_repair', 'repair', $ids, id);
        } else {
            $this->error($repair->getError());
        }
    }
    /**
     * 修改
     * @param int $id
     * @return mixed|void
     */
    public function update($id=0)
    {
        if (request()->isPost()){
            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            //补充字段数据
            $post_data['update_time'] = time();
            $repair = Db::name('repair');
            $repair->data($post_data);
            $result = $repair->update();
            if($result){
                $this->success('修改成功', url('index'));
                //记录行为
//                action_log('update_repair', 'repair', $data->id, id);
            } else {
                $this->error($repair->getError());
            }
        }else{
            $repairData = array();
            /* 获取数据 */
            $repairData = \think\Db::name('repair')->find($id);

            if(false === $repairData){
                $this->error('获取配置信息错误');
            }
            //展示修改表单
            $this->assign('meta_title','修改报修');
            $this->assign('info','修改');
            $this->assign($repairData);
            return $this->fetch('add');
        }
    }

    /**
     * 添加
     * @return mixed|void
     */
    public function add()
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
                $this->success('新增成功', url('index'));
                //记录行为
//                action_log('update_repair', 'repair', $data->id, id);
            } else {
                $this->error($Repair->getError());
            }
        } else {
            //展示添加表单
            $this->assign('meta_title','添加报修');
            $this->assign('info','添加');
            return $this->fetch();
        }
    }
}
