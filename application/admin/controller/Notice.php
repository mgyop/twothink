<?php
namespace app\admin\controller;

class Notice extends Admin
{
    public function add()
    {
        if (request()->isPost()) {
            $noticeModel = model('notice');
            $post_data = \think\Request::instance()->post();
            //自动验证
            $validate = validate('notice');
            if (!$validate->check($post_data)) {
                return $this->error($validate->getError());
            }
            //赋值数据
            $noticeModel->data($post_data);
            $result = $noticeModel->create($post_data);
            if ($result) {
                $this->success('发布成功', url('index'));
                //记录行为
                action_log('update_notice', 'notice', $noticeModel->id, id);
            } else {
                $this->error($noticeModel->getError());
            }
        } else {
            //展示添加表单
            $this->assign('meta_title', '发布通告');
            $this->assign('info', '添加');
            return $this->fetch();
        }
    }
}
