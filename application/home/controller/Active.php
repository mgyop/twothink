<?php

namespace app\home\controller;

use app\admin\model\Url;
use app\home\model\Document;
use think\Db;
use think\response\Json;

class Active extends Home
{
    public function index()
    {
        $path = '/home/active/ajax.html?page=1';
//        $list = \think\Db::name('document')->where('category_id','44')->order('create_time','DESC')->paginate(1);
//        $this->assign('_list', $list);
        $this->assign('meta_title','政策列表');
        $this->assign('pageNext', $path);
        return $this->fetch();
    }
    public function ajax()
    {
        //初始化条件
        $map['category_id'] = 49;
        $map['status'] = 1;

        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->where($map)->order('create_time','DESC')->paginate(1)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/active/ajax.html?page='.$pageNext;
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
        $this->assign('notice',$document);
        $this->assign('documentDetail',$content);
        $this->assign('username',$username);
        //浏览量自增
        $model->update(['id' => $id, 'view' => 'view'+1]);
        return $this->fetch();
    }


    public function join()
    {
        //初始化返回参数
        $response = ['success'=>0,'msg'=>''];
        $id = request()->get('activeid');
        if (!$id){
            $response['msg'] = '参数错误';
        }else{
            //验证是否登录
            $user_id = is_login();
            if (!$user_id){
                $response['msg'] = '请先登录';
            }else{
                //已登录判断是否参加过活动
                $res = Db::name('member_active')->where(['member_id'=>$user_id,'active_id'=>$id])->find();
                if ($res){
                    $response['msg'] = '已经参加过了';
                }else{
                    //可以参加
                    Db::name('member_active')->insert(['member_id'=>$user_id,'active_id'=>$id]);
                    $response['msg'] = '参加成功';
                    $response['success'] = 1;
                }
            }

        }

        return $response;
    }
}