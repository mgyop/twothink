<?php
namespace app\home\controller;

use app\admin\model\Url;
use think\response\Json;

class Notice extends Home
{
    public function index()
    {
        $path = '/home/notice/ajax.html?page=1';
//        $list = \think\Db::name('document')->order('create_time','DESC')->paginate(1);
//        $this->assign('_list', $list);
//        $this->assign('meta_title','通知列表');
        $this->assign('pageNext', $path);
        return $this->fetch();
    }
    public function ajax()
    {
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->order('create_time','DESC')->paginate(1)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/notice/ajax.html?page='.$pageNext;
        $list = \think\Db::name('document')->order('create_time','DESC')->paginate(1);
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

    public function detail($id)
    {
        dump($id);
        echo 'tongzhi';
    }
    public function add()
    {
        if (request()->isPost()){

        }else{
            //展示添加表单
            return $this->fetch();
        }
    }
}
