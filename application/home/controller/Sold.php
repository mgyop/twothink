<?php

namespace app\home\controller;

use app\admin\model\Url;
use app\home\model\Document;
use think\Db;
use think\response\Json;

class Sold extends Home
{
    public function index()
    {
        $path_zu = '/home/sold/ajaxzu.html?page=1';
        $path_shou = '/home/sold/ajaxshou.html?page=1';
        $this->assign('meta_title','房屋租售');
        $this->assign('zu_pageNext', $path_zu);
        $this->assign('shou_pageNext', $path_shou);
        return $this->fetch();
    }
    public function ajaxzu()
    {
        //初始化条件
        $map['category_id'] = 54;
        $map['status'] = 1;
        $map['deadline'] = ['>',time()];
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(6)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/sold/ajaxzu.html?page='.$pageNext;
        $list = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(6);
        $new_list = [];
        if ($list){
            foreach ($list as $item){
                $item['img_src'] = get_cover($item['cover_id'])['path'];
                $goods = Db::name('goods')->where('document_id',$item['id'])->find();
                $item['price'] = $goods['price'];
                $item['tel'] = $goods['tel'];
                $new_list[] = $item;
            }
            $response['data'] = $new_list;
            $response['path'] = $path;
        }else{
            $response['success'] = 0;
        }
        return json_encode($response);
    }
    public function ajaxshou()
    {
        //初始化条件
        $map['category_id'] = 53;
        $map['status'] = 1;
        $map['deadline'] = ['>',time()];
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(6)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/sold/ajaxshou.html?page='.$pageNext;
        $list = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(6);
        $new_list = [];
        if ($list){
            foreach ($list as $item){
                $item['img_src'] = get_cover($item['cover_id'])['path'];
                $goods = Db::name('goods')->where('document_id',$item['id'])->find();
                $item['price'] = $goods['price'];
                $item['tel'] = $goods['tel'];
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
     * 活动详情页
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        $model = new Document();
        $document = $model->find($id);
        $content = $document->documentArticle->content;
        $username = $document->ucenterMember->username;
        $this->assign('sold',$document);
        $this->assign('documentDetail',$content);
        $this->assign('username',$username);
        //浏览量自增
        $model->update(['id' => $id, 'view' => 'view'+1]);
        $goods = Db::name('goods')->where(['document_id'=>$id])->find();
        $this->assign($goods);
        return $this->fetch();
    }

}