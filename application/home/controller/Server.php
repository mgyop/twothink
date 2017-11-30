<?php

namespace app\home\controller;

use app\admin\model\Url;
use app\home\model\Confirm;
use app\home\model\Document;
use think\Db;
use think\response\Json;

class Server extends Home
{
    public function index()
    {
        $path = '/home/server/ajax.html?page=1';
//        $list = \think\Db::name('document')->where('category_id','44')->order('create_time','DESC')->paginate(1);
//        $this->assign('_list', $list);
        $this->assign('meta_title','政策列表');
        $this->assign('pageNext', $path);
        return $this->fetch();
    }
    public function ajax()
    {
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->where('category_id','44')->order('create_time','DESC')->paginate(1)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/server/ajax.html?page='.$pageNext;
        $list = \think\Db::name('document')->where('category_id','44')->order('create_time','DESC')->paginate(1);
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

    /**
     * 服务列表
     * @return mixed
     */
    public function lists()
    {
        $this->assign('meta_title','服务列表');
        return $this->fetch('lists');
    }

    /**
     * 业主认证
     * @return mixed|void
     */
    public function confirm()
    {
        $id = is_login();//user_id
        if (request()->isPost()){
            //接收认证表单数据,认证用户
            //接收数据
            $confirm = new Confirm();
            $data=\think\Request::instance()->post();
            $validate = validate('confirm');
            if (!$validate->check($data)){
                //验证失败打印错误信息
                return $this->error($validate->getError());
            }else{
                //准备user_id
                $data['member_id'] = $id;
                //成功保存数据
                $result = $confirm->insert($data);
                if (!$result){
                    return $this->error($confirm->getError());
                }
                return $this->success('认证成功',url('home/index/index'));die;
            }
        }else{
            //展示认证表单
            if (!$id){
                $this->error('请先登录','/user/login','',3);
            }else{
                //判断是否认证
                $res = Db::name('confirm')->where('member_id',$id)->find();
                if ($res){
                    //已经认证过了
                    echo "已经认证过了,2秒<button style='background-color: lightseagreen;'>立即返回</button>";
                    echo "<script>setTimeout('history.back()',1500);
 </script>";die;
                }else{
                    $this->assign('meta_title','业主认证');
                    return $this->fetch();
                }
            }
        }

    }

    /**
     * 生活贴士
     * @return mixed
     */
    public function tips()
    {
        $path = '/home/server/ajaxtips.html?page=1';
        $this->assign('meta_title','生活贴士');
        $this->assign('pageNext', $path);
        return $this->fetch();
    }

    public function ajaxtips()
    {
        $response = ['success'=>1,'data'=>[],'path'=>''];

        $pageNow = input('page')?input('page'):1;
        $pageNext = $pageNow+1;
        $lastPage = \think\Db::name('document')->order('create_time','DESC')->paginate(4)->lastPage();
        if ($pageNow > $lastPage){
            $response['success'] = 0;
            return json_encode($response);
        }
        $path = '/home/server/ajaxtips.html?page='.$pageNext;
        $list = \think\Db::name('document')->order('create_time','DESC')->paginate(4);
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
     * 关于我们
     * @return mixed
     */
    public function about()
    {
        $model = new Document();
        $document = $model->find(143);
        $content = $document->documentArticle->content;
        $username = $document->ucenterMember->username;
        $this->assign('about',$document);
        $this->assign('documentDetail',$content);
        $this->assign('username',$username);

        $this->assign('meta_title','关于我们');
        //浏览量自增
        $model->update(['id' => 143, 'view' => 'view'+1]);
        return $this->fetch();
    }
















}