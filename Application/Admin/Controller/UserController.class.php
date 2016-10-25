<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class UserController extends BackendController {
    public function index(){
        $this->display();
    }

    public function addUser(){
        if(IS_POST){

        }else{
            $this->display();
        }
    }

    public function listGroup(){
        $this->display();
    }

    public function addGroup(){
        if(IS_POST){

        }else{
            $this->display();
        }
    }

    public function listRule(){
        $this->display();
    }

    public function addRule(){
        $pid = I('get.pid') ? : 0;
        $this->assign('pid', $pid);
        if(IS_POST){
            $form_data = I('post.');
            $data['pid'] = $pid;
            $data['name'] = $form_data['name'];
            $data['title'] = $form_data['title'];

            if(M('Admin_rule')->add($data)){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }
}