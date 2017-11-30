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
        //验证是否通过认证
        if (!confirm()){
            //去认证
            echo "请先认证,2秒<button style='background-color: lightseagreen;'>立即认证</button>";
            echo "<script>setTimeout('location.href=\'/home/server/confirm\'',1500);
 </script>";die;
        }
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
            $post_data['member_id'] = is_login();
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

    public function getRepair()
    {
        $id = is_login();
        if (!$id){
            echo "<p style='color: red'>请登录...</p>";
            echo "<script>setTimeout('location.href=\'/user/login/index\'',1500)</script>";
            die;
        }
        $path = '/home/repair/ajax.html?page=1';
        $this->assign('meta_title','我的报修');
        $this->assign('pageNext', $path);
        return $this->fetch('index');
    }

    public function ajax()
    {

        $id = is_login();
        //初始化条件
        $map['member_id'] = $id;
        $response = ['success'=>1,'data'=>[],'path'=>''];
        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('repair')->where($map)->order('create_time','DESC')->paginate(1)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/repair/ajax.html?page='.$pageNext;
        $list = \think\Db::name('repair')->where($map)->order('create_time','DESC')->paginate(1);
        if ($list){
            $response['data'] = $list;
            $response['path'] = $path;
        }else{
            $response['success'] = 0;
        }
        return json_encode($response);
    }
}