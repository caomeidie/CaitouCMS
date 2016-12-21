<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class ArticleController extends BackendController {
    public function index(){
        $count      = M('Article')->count();// 查询满足要求的总记录数
        $limit = $this->page($count, 2);
        $list = M('Article')->alias('a')->field('a.*, ac.column_name')->join('__ARTICLE_COLUMN__ ac ON a.article_column = ac.column_id','LEFT')->order('a.sort DESC')->limit($limit)->select();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function addArticle(){
        if(IS_POST){
            $data = I('post.');
            $data['add_time'] = time();
            $data['edit_time'] = time();

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Upload/article/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->subName   = array('date','Ymd');
            $info   =   $upload->uploadOne($_FILES['thumb']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                $data['thumb'] = $info['savepath'].$info['savename'];
            }

            $article_id = M('article')->add($data);

            if(!$article_id){
                $this->error("添加文章失败！");
            }else{
                $this->success('添加文章成功！', U('index'));
            }
        }else{
            $column_list = M('Article_column')->order('sort desc')->select();
            $this->assign('column_list',$column_list);
            $this->display();
        }
    }

    public function editArticle(){
        $id = I('get.id',0,'intval');
        if(IS_POST){
            $data = I('post.');
            $data['edit_time'] = time();
            if($_FILES['thumb']['name']){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Upload/article/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                $upload->subName   = array('date','Ymd');
                $info   =   $upload->uploadOne($_FILES['thumb']);
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功 获取上传文件信息
                    $data['thumb'] = $info['savepath'].$info['savename'];
                }
            }

            if(!M('article')->where(array('article_id'=>$id))->save($data)){
                $this->error("编辑文章失败！");
            }else {
                $this->success("编辑文章成功！", U('index'));
            }
        }else{
            $article_info = M('article')->where(array('article_id'=>$id))->find();
            $article_info['content'] = htmlspecialchars_decode($article_info['content']);
            $this->assign('info',$article_info);
            $column_list = M('Article_column')->order('sort desc')->select();
            $this->assign('column_list',$column_list);
            $this->display();
        }
    }

    public function dropArticle(){
        $id = I('get.id');
        if(!$id){
            $this->error('该文章不存在！');
        }

        if(M('Article')->where(array('article_id'=>$id))->delete()){
            $this->success('删除文章成功', U('index'));
        }else{
            $this->error('删除文章失败');
        }
    }

    /**
     *  批量删除文章
     */
    public function dropArticleBatch(){
        $id = I('post.id');
        if(!$id){
            $this->error('请选择文章！');
        }

        if(M('Article')->where(array('article_id'=>array('in', $id)))->delete()){
            $this->success('删除文章成功', U('index'));
        }else{
            $this->error('删除文章失败');
        }
    }

    public function listNotice(){
        $count      = M('Notice')->count();// 查询满足要求的总记录数
        $limit = $this->page($count, 2);
        $list = M('Notice')->order('sort DESC')->limit($limit)->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function addNotice(){
        if(IS_POST){
            $data = I('post.');
            $data['add_time'] = time();
            $data['edit_time'] = time();

            $article_id = M('Notice')->add($data);

            if(!$article_id){
                $this->error("添加公告失败！");
            }else{
                $this->success('添加公告成功！', U('listNotice'));
            }
        }else{
            $this->display();
        }
    }

    public function editNotice(){
        $id = I('get.id',0,'intval');
        if(IS_POST){
            $data = I('post.');
            $data['edit_time'] = time();

            if(!M('Notice')->where(array('notice_id'=>$id))->save($data)){
                $this->error("编辑公告失败！");
            }else {
                $this->success("编辑公告成功！", U('listNotice'));
            }
        }else{
            $notice_info = M('Notice')->where(array('notice_id'=>$id))->find();
            $notice_info['content'] = htmlspecialchars_decode($notice_info['content']);
            $this->assign('info',$notice_info);
            $this->display();
        }
    }

    public function dropNotice(){
        $id = I('get.id');
        if(!$id){
            $this->error('该公告不存在！');
        }

        if(M('Notice')->where(array('notice_id'=>$id))->delete()){
            $this->success('删除公告成功', U('listNotice'));
        }else{
            $this->error('删除公告失败');
        }
    }

    /**
     *  批量删除文章
     */
    public function dropNoticeBatch(){
        $id = I('post.id');
        if(!$id){
            $this->error('请选择公告！');
        }

        if(M('Notice')->where(array('notice_id'=>array('in', $id)))->delete()){
            $this->success('删除公告成功', U('listNotice'));
        }else{
            $this->error('删除公告失败');
        }
    }

    public function listArticleColumn(){
        $count      = M('Article_column')->count();// 查询满足要求的总记录数
        $limit = $this->page($count, 2);
        $list = M('Article_column')->order('sort DESC')->limit($limit)->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function addArticleColumn(){
        if(IS_POST){
            $data['column_name'] = I('post.column_name');
            $data['sort'] = I('post.sort');
            $data['add_time'] = time();

            $column_id = M('Article_column')->add($data);

            if(!$column_id){
                $this->error("添加栏目失败！");
            }else{
                $this->success('添加栏目成功！', U('listArticleColumn'));
            }
        }else{
            $this->display();
        }
    }

    public function editArticleColumn(){
        $id = I('get.id',0,'intval');
        if(IS_POST){
            $data['column_name'] = I('post.column_name');
            $data['sort'] = I('post.sort');

            if(!M('Article_column')->where(array('column_id'=>$id))->save($data)){
                $this->error("编辑栏目失败！");
            }else {
                $this->error("编辑栏目成功！", U('listArticleColumn'));
            }
        }else{
            $column_info = M('Article_column')->where(array('id'=>$id))->find();
            $this->assign('info',$column_info);
            $this->display();
        }
    }

    public function dropArticleColumn(){
        $id = I('get.id');
        if(!$id){
            $this->error('该栏目不存在！');
        }

        if(M('Article_column')->where(array('column_id'=>$id))->delete()){
            $this->success('删除栏目成功', U('listArticleColumn'), U('listArticleColumn'));
        }else{
            $this->error('删除栏目失败', U('listArticleColumn'));
        }
    }

    /**
     *  批量删除栏目
     */
    public function dropArticleColumnBatch(){
        $id = I('post.id');
        if(!$id){
            $this->error('请选择栏目！');
        }

        if(M('Article_column')->where(array('column_id'=>array('in', $id)))->delete()){
            $this->success('删除栏目成功', U('listArticleColumn'));
        }else{
            $this->error('删除栏目失败');
        }
    }
}