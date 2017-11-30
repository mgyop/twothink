<?php
namespace app\home\controller;

class My extends Home
{
    public function index()
    {
        $id = is_login();
        if (!$id){
           echo "<p style='color: red'>请登录...</p>";
           echo "<script>setTimeout('location.href=\'/user/login/index\'',1500)</script>";
           die;
        }
        //获取昵称
        $this->assign('nikename',get_nickname($id));
        return $this->fetch();
    }

    /**
     * 获取我的活动
     * @return mixed]
     */
    public function getActives()
    {
        $path = '/home/cactive/ajax.html?page=1';
//        $list = \think\Db::name('document')->where('category_id','44')->order('create_time','DESC')->paginate(1);
//        $this->assign('_list', $list);

        $path = '/home/my/ajax.html?page=1';
        $this->assign('meta_title','我的活动列表');
        $this->assign('pageNext', $path);
        return $this->fetch('list');
    }

    /**
     * 活动翻页
     * @return mixed
     */
    public function ajax()
    {
        $id = is_login();
        if (!$id){
            echo "<p style='color: red'>请登录...</p>";
            echo "<script>setTimeout('location.href=\'/user/login/index\'',1500)</script>";
            die;
        }
        //初始化条件
        $map['category_id'] = ['in',[49,50]];
        $map['uid'] = $id;
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(1)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/my/ajax.html?page='.$pageNext;
        $list = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(1);
        $new_list = [];
        if ($list){
            foreach ($list as $item){
                $item['img_src'] = get_cover($item['cover_id'])['path'];
                $new_list[] = $item;
            }
            $response['data'] = $new_list;
            $response['path'] = $path;
        }else{
            $response['success'] = 0;
        }
        return json_encode($response);
    }
}