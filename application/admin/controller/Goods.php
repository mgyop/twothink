<?php
namespace app\admin\controller;

use think\Db;
use think\Request;

class Goods extends Admin
{
    /**
     * 列表
     * @return mixed
     */
    public function index()
    {
        $nickname       =   input('nickname');
        if(is_numeric($nickname)){
            $map['id']=   array('like','%'.$nickname.'%');
        }

        $list = \think\Db::name('goods')->where($map)->paginate(5);
        $this->assign('_list', $list);
        $this->assign('meta_title','商品列表');
        //分页配置
        $page = $list->render();
        $this->assign('_page', $page);
        return $this->fetch();
    }

    public function del($id=0)
    {
        if (!$id){
            $this->error('参数错误!');
        }
        $repair = \think\Db::name('repair');
        $result = $repair->where('id',$id)->delete();
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
        $repair = \think\Db::name('repair');
        if (request()->isPost()){
            $postData=\think\Request::instance()->post();
            $ids = $postData['id'];
            if (empty($ids)){
                $this->error('参数错误!');
            }
        }else{
            $getData = Request::instance()->get();
            $ids = $getData['id'];
        }
        $result = $repair->where('id','in',$ids)->update(['status'=>1,'update_time'=>time()]);
        if ($result){
            $this->success('处理成功', url('index'));
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
    public function update($id)
    {
        if (request()->isPost()){

            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('goods');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            $goods = Db::name('goods');
            $goods->data($post_data);
            $result = $goods->update();
            if($result || $result==0){
                $this->success('修改成功', url('index'));
                //记录行为
//                action_log('update_repair', 'repair', $data->id, id);
            } else {
                $this->error($goods->getError());
            }
        }else{
            /* 获取数据 */
            $goodsData = \think\Db::name('goods')->find($id);

            if(false === $goodsData){
                $this->error('获取配置信息错误');
            }
            //展示修改表单
            $this->assign($goodsData);
            $map = [];
            $map['category_id'] = ['in',[53,54]];
            //展示添加表单
            $response = Db::name('document')->where($map)->select();
            $this->assign('documents',$response);
            //展示添加表单
            $this->assign('meta_title','修改商品');
            $this->assign('info','修改');
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
            $goods = model('goods');
            $post_data=\think\Request::instance()->post();
            //自动验证
            $validate = validate('goods');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            //赋值数据
            $goods->data($post_data);
            $result = $goods->create($post_data);
            if($result){
                $this->success('新增成功', url('index'));
                //记录行为
//                action_log('update_repair', 'repair', $data->id, id);
            }else{
                $this->error($goods->getError());
            }
        } else {
            $map = [];
            $map['category_id'] = ['in',[53,54]];
            //展示添加表单
            $response = Db::name('document')->where($map)->select();
            $this->assign('documents',$response);
            $this->assign('meta_title','添加商品扩展');
            $this->assign('info','添加');
            return $this->fetch();
        }
    }
}
