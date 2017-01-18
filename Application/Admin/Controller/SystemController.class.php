<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class SystemController extends BackendController
{
    public function index()
    {
        if(!IS_POST){
            $list = M('system')->order('sort DESC')->index('key')->select();
            $this->assign('list', $list);
            $this->display();
        }else{
            $post = I('post.');
            if($post['logo']['name']){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Upload/common/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->subName = array('date', 'Ymd');
                $info = $upload->uploadOne($_FILES['thumb']);
                if (!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {// 上传成功 获取上传文件信息
                    $data['logo'] = $info['savepath'] . $info['savename'];
                }
            }

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Upload/images/common/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            $upload->subName = array('date', 'Ymd');
            
            if($_FILES['watermark']['name']){
                $info = $upload->uploadOne($_FILES['watermark']);
                if (!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {// 上传成功 获取上传文件信息
                    $data['watermark'] = $info['savepath'] . $info['savename'];
                }
            }
            if($_FILES['logo']['name']){
                $info = $upload->uploadOne($_FILES['logo']);
                if (!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {// 上传成功 获取上传文件信息
                    $data['logo'] = $info['savepath'] . $info['savename'];
                }
            }

            $data['domain'] = $post['domain'];
            $data['title'] = $post['title'];
            $data['keyword'] = $post['keyword'];
            $data['description'] = $post['description'];
            foreach($data as $key=>$val){
                M('system')->where(array('key'=>$key))->save(array('value'=>$val));
            }
            $this->success('提交成功！');
        }
    }

    public function listLink()
    {
        $list = M('Link')->order('sort desc')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function addLink()
    {
        if (IS_POST) {
            $data = I('post.');
            $data['add_time'] = time();

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Upload/images/link/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            $upload->subName = array('date', 'Ymd');
            if($_FILES['logo']['name']){
                $info = $upload->uploadOne($_FILES['logo']);
                if (!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {// 上传成功 获取上传文件信息
                    $data['logo'] = $info['savepath'] . $info['savename'];
                }
            }

            $link_id = M('Link')->add($data);

            if (!$link_id) {
                $this->error("添加友情链接失败！");
            } else {
                $this->success('添加友情链接成功！', U('listLink'));
            }
        } else {
            $this->display();
        }
    }

    public function editLink()
    {
        $id = I('get.id', 0, 'intval');
        if (IS_POST) {
            $data = I('post.');
            $data['edit_time'] = time();
            if ($_FILES['thumb']['name']) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Upload/article/'; // 设置附件上传根目录
                $upload->savePath = ''; // 设置附件上传（子）目录
                $upload->subName = array('date', 'Ymd');
                $info = $upload->uploadOne($_FILES['thumb']);
                if (!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                } else {// 上传成功 获取上传文件信息
                    $data['thumb'] = $info['savepath'] . $info['savename'];
                }
            }

            if (!M('article')->where(array('article_id' => $id))->save($data)) {
                $this->error("编辑文章失败！");
            } else {
                $this->success("编辑文章成功！", U('index'));
            }
        } else {
            $article_info = M('article')->where(array('article_id' => $id))->find();
            $article_info['content'] = htmlspecialchars_decode($article_info['content']);
            $this->assign('info', $article_info);
            $column_list = M('Link_column')->order('sort desc')->select();
            $this->assign('column_list', $column_list);
            $this->display();
        }
    }

    public function dropLink()
    {
        $id = I('get.id');
        if (!$id) {
            $this->error('该文章不存在！');
        }

        if (M('Link')->where(array('article_id' => $id))->delete()) {
            $this->success('删除文章成功', U('index'));
        } else {
            $this->error('删除文章失败');
        }
    }

    /**
     *  批量删除文章
     */
    public function dropLinkBatch()
    {
        $id = I('post.id');
        if (!$id) {
            $this->error('请选择文章！');
        }

        if (M('Link')->where(array('article_id' => array('in', $id)))->delete()) {
            $this->success('删除文章成功', U('index'));
        } else {
            $this->error('删除文章失败');
        }
    }
}