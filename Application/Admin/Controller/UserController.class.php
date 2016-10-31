<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class UserController extends BackendController {
    public function index(){
        $list = M('Admin')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function addUser(){
        if(IS_POST){
            $data = I('post.');
            if(!$data['password'] || ($data['password'] != $data['repeat_password'])){
                $this->error('确认初始密码与初始密码不一致');
            }
            $data['add_time'] = time();
            $data['password'] = md5($data['password']);
            if($id = D('Admin')->add($data)){
                if($data['group'] > 0){
                    M('Admin_group_access')->data(array('admin_id'=>$id, 'group_id'=>$data['group']))->add();
                }

                $this->success('添加用户成功');
            }else{
                $this->error('添加用户失败');
            }
        }else{
            $list = M('Admin_group')->select();
            $this->assign('list', $list);
            $this->display();
        }
    }

    public function editUser(){
        $id = I('get.id');
        if(!$id){
            $this->error('该用户不存在！');
        }
        $this->assign('id', $id);
        if(IS_POST){
            $data = I('post.');
            if($data['password'] != $data['repeat_password']){
                $this->error('确认初始密码与初始密码不一致');
            }
            if(!$data['password']){
                unset($data['password']);
            }else{
                $data['password'] = md5($data['password']);
            }
            if(M('Admin')->where(array('admin_id'=>$id))->save($data)){
                if($data['group'] > 0){
                    M('Admin_group_access')->where(array('admin_id'=>$id))->save(array('group_id'=>$data['group']));
                }

                $this->success('编辑用户成功');
            }else{
                $this->error('编辑用户失败');
            }
        }else{
            $list = M('Admin_group')->select();
            $this->assign('list', $list);
            $info = D('Admin')->alias('a')->field('a.*, aga.group_id')->join('__ADMIN_GROUP_ACCESS__ aga ON aga.admin_id = a.admin_id', 'LEFT')->where(array('a.admin_id'=>$id))->find();
            $this->assign('info', $info);
            $this->display();
        }
    }

    public function listGroup(){
        $list = M('Admin_group')->where('status=1')->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function addGroup(){
        if(IS_POST){
            $form_data = I('post.');
            $data['title'] = $form_data['title'];

            if(M('Admin_group')->add($data)){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    public function listRule(){
        $list = M('Admin_rule')->where('status=1')->order('pid ASC')->select();
        $tree_list = getTree($list);
        $this->assign('list', $tree_list);
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

    public function editRule(){
        $id = I('get.id');
        if(!$id){
            $this->error('该权限不存在！');
        }
        $this->assign('id', $id);
        if(IS_POST){
            $form_data = I('post.');
            $data['name'] = $form_data['name'];
            $data['title'] = $form_data['title'];

            if(M('Admin_rule')->where('id='.$id)->save($data)){
                $this->success('编辑成功');
            }else{
                $this->error('编辑失败');
            }
        }else{
            $info = M('Admin_rule')->where('id='.$id)->find();
            $this->assign('info', $info);
            $this->display();
        }
    }

    public function dropRule(){
        $id = I('get.id');
        if(!$id){
            $this->error('该权限不存在！');
        }
        if(M('Admin_rule')->where('id='.$id)->delete()){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function allocateRule(){
        $id = I('get.id');
        if(!$id){
            $this->error('该用户组不存在！');
        }
        $this->assign('id', $id);
        if(IS_POST){
            $form_data=I('post.');
            $data['rules']=implode(',', $form_data['rule_ids']);
            if(M('Admin_group')->where(array('group_id'=>$id))->save($data)){
                $this->success('分配成功');
            }else{
                $this->error('分配失败');
            }
        }else{
            // 获取用户组数据
            $group_data=M('Admin_group')->where(array('group_id'=>$id))->find();
            $group_data['rules']=explode(',', $group_data['rules']);
            // 获取规则数据
            $list = M('Admin_rule')->where('status=1')->select();
            $rule_data=getTree($list, 'level');
            $assign=array(
                'group_data'=>$group_data,
                'rule_data'=>$rule_data
            );
            $this->assign($assign);
            $this->display();
        }
    }

    public function allocateUser(){
        $id = I('get.id');
        if(!$id){
            $this->error('该用户组不存在！');
        }
        $this->assign('id', $id);
        if($username = I('get.username')){
            $user_list = M('Admin')->alias('a')->field('a.*, aga.group_id')->join('__ADMIN_GROUP_ACCESS__ aga ON a.admin_id=aga.admin_id', 'LEFT')->where(array('a.admin_name'=>$username))->select();
            $this->assign('user_list', $user_list);
        }
        $info = M('Admin_rule')->where('id='.$id)->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function doAllocateUser(){
        $id = I('get.id');
        $admin_id = I('get.admin_id');
        if(!$id || !M('Admin_group')->where(array('group_id'=>$id))->find()){
            $this->error('该用户组不存在！');
        }
        if(!$admin_id || !M('Admin')->where(array('admin_id'=>$admin_id))->find()){
            $this->error('该用户不存在！');
        }

        if(M('Admin_group_access')->where(array('admin_id'=>$admin_id))->find()){
            $this->error('该用户已加入用户组，请先从用户组中删除！');
        }else{
            $data['group_id'] = $id;
            $data['admin_id'] = $admin_id;

            if(M('Admin_group_access')->data($data)->add()){
                $this->success('分配用户成功');
            }else{
                $this->error('分配用户失败');
            }
        }
    }

    public function dropAllocateUser(){
        $admin_id = I('get.admin_id');
        if(!$admin_id){
            $this->error('该用户不存在！');
        }
        if(M('Admin_group_access')->where(array('admin_id'=>$admin_id))->delete()){
            $this->error('从用户组中删除成功！');
        }else{
            $this->error('从用户组中删除失败！');
        }
    }
}