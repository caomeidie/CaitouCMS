<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class ArticleController extends BackendController {
    public function index(){
        $count      = M('Article')->count();// 查询满足要求的总记录数
        $limit = $this->page($count, 2);
        $list = M('Article')->alias('a')->field('a.*, ac.column_name')->join('__ARTICLE_COLUMN__ ac ON a.article_column = ac.column_id','LEFT')->order('a.edit_time')->limit($limit)->select();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function addArticle(){
        if(IS_POST){
            $data['article_title'] = I('post.title');
            $data['profile'] = I('post.profile');
            $data['content'] = I('post.content');
            $data['article_column'] = I('post.article_column');
            $data['add_time'] = time();
            $data['edit_time'] = time();

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
            $data['article_title'] = I('post.title');
            $data['profile'] = I('post.profile');
            $data['content'] = I('post.content');
            $data['article_column'] = I('post.article_column');
            $data['edit_time'] = time();

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

    public function listNotice(){
        $count      = M('Notice')->count();// 查询满足要求的总记录数
        $limit = $this->page($count, 2);
        $list = M('Notice')->order('sort DESC')->limit($limit)->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function addNotice(){
        if(IS_POST){
            $data['notice_title'] = I('post.title');
            $data['content'] = I('post.content');
            $data['add_time'] = time();
            $data['edit_time'] = time();

            $article_id = M('article')->add($data);

            if(!$article_id){
                $this->error("添加公告失败！");
            }else{
                $this->success('添加公告成功！', U('index'));
            }
        }else{
            $this->display();
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