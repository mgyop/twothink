<?php
namespace app\home\controller;

use app\admin\model\Url;
use app\home\model\Document;
use think\Db;
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
        //初始化条件
        $map['category_id'] = 2;
        $map['status'] = 1;
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(2)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/notice/ajax.html?page='.$pageNext;
        $list = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(2);
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

    /**
     * 通知详情页
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        $model = new Document();
        $document = $model->find($id);
        $content = $document->documentArticle->content;
        $username = $document->ucenterMember->username;
        $this->assign('notice',$document);
        $this->assign('documentDetail',$content);
        $this->assign('username',$username);
        //浏览量自增
        $model->update(['id' => $id, 'view' => 'view'+1]);
        return $this->fetch();
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
