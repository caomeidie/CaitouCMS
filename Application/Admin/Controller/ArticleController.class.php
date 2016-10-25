<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class ArticleController extends BackendController {
    public function index(){
        $list = M('article')->select();
        $this->assign('list',$list);
        $this->display();
    }
    
    public function addArticle(){
        if(IS_POST){
            $data['article_title'] = I('post.title');
            $data['article_profile'] = I('post.profile');
            $data['article_content'] = I('post.content');
            $data['article_type'] = I('post.type');
            $data['add_time'] = time();

            $article_id = M('article')->add($data);

            if(!$article_id){
                $this->error("添加文章失败！");
            }else{
                $this->success('添加文章成功！');
            }
        }else{
            $this->display();
        }
    }

    public function editArticle(){
        $id = I('get.id',0,'intval');
        if(IS_POST){
            $data['article_title'] = I('post.title');
            $data['article_profile'] = I('post.profile');
            $data['article_content'] = I('post.content');
            $data['article_type'] = I('post.type');

            if(!M('article')->where(array('id'=>$id))->save($data)){
                $this->error("编辑文章失败！");
            }else {
                $this->error("编辑文章成功！");
            }
        }else{
            $article_info = M('article')->where(array('id'=>$id))->find();
            $article_info['article_content'] = htmlspecialchars_decode($article_info['article_content']);
            $this->assign('info',$article_info);
            $this->display();
        }
    }

    public function dropArticle(){
    	$this->display();
    }
}