<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class UserController extends BackendController {
    public function index(){
        $count      = M('Admin')->count();// 查询满足要求的总记录数
        $limit = $this->page($count, 2);
        $list = M('Admin')->order('add_time')->limit($limit)->select();
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
            $data['password'] = sha1($data['password']);
            if(D('Admin')->create() && ($id = D('Admin')->add($data))){
                if($data['group'] > 0){
                    M('Admin_group_access')->data(array('admin_id'=>$id, 'group_id'=>$data['group']))->add();
                }

                $this->success('添加用户成功', U('User/index'));
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
            $data_form = I('post.');
            if($data_form['password'] != $data_form['repeat_password']){
                $this->error('确认初始密码与初始密码不一致');
            }
            if($data_form['password']){
                $data['password'] =  sha1($data_form['password']);
            }
            $data['admin_name'] = $data_form['admin_name'];
            $data['mobile'] = $data_form['mobile'];
            $data['status'] = $data_form['status'];
            M('Admin_group_access')->where(array('admin_id'=>$id))->delete();
            if(!D('Admin')->where(array('admin_id'=>$id))->save($data) && !(M('Admin_group_access')->data(array('admin_id'=>$id, 'group_id'=>$data_form['group']))->add())){
                $this->success('编辑用户失败');
            }else{
                $this->error('编辑用户成功', U('User/index'));
            }
        }else{
            $list = M('Admin_group')->select();
            $this->assign('list', $list);
            $info = D('Admin')->alias('a')->field('a.*, aga.group_id')->join('__ADMIN_GROUP_ACCESS__ aga ON aga.admin_id = a.admin_id', 'LEFT')->where(array('a.admin_id'=>$id))->find();
            $this->assign('info', $info);
            $this->display();
        }
    }

    public function dropUser(){
        $id = I('get.id');
        if(!$id){
            $this->error('该用户不存在！');
        }

        if(M('Admin')->where(array('admin_id'=>$id))->delete()){
            M('Admin_group_access')->where(array('admin_id'=>$id))->delete();
            $this->success('删除用户成功', U('User/index'));
        }else{
            $this->error('删除用户失败', U('User/index'));
        }
    }

    /**
     *  批量删除用户
     */
    public function dropUserBatch(){
        $id = I('post.id');
        if(!$id){
            $this->error('请选择用户！');
        }

        if(M('Admin')->where(array('admin_id'=>array('in', $id)))->delete()){
            M('Admin_group_access')->where(array('admin_id'=>array('in', $id)))->delete();
            $this->success('删除用户成功', U('User/index'));
        }else{
            $this->error('删除用户失败', U('User/index'));
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
                $this->success('添加成功', U('User/listGroup'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    public function editGroup(){
        $id = I('get.id');
        if(!$id || !$info = M('Admin_group')->where('group_id='.$id)->find()){
            $this->error('该用户组不存在！');
        }
        $this->assign('id', $id);
        if(IS_POST){
            $data = I('post.');

            if(M('Admin_rule')->where('group_id='.$id)->save($data)){
                $this->success('编辑成功', U('User/listGroup'));
            }else{
                $this->error('编辑失败');
            }
        }else{
            $this->assign('info', $info);
            $this->display();
        }
    }

    public function dropGroup(){
        $id = I('get.id');
        if(!$id){
            $this->error('该用户组不存在！');
        }
        if(M('Admin_group')->where('group_id='.$id)->delete()){
            $this->success('删除成功', U('User/listGroup'));
        }else{
            $this->error('删除失败', U('User/listGroup'));
        }
    }

    public function listRule(){
        $list = M('Admin_rule')->where('status=1')->order('id ASC')->select();
        $tree_list = getTree($list);
        $this->assign('list', $tree_list);
        $this->display();
    }

    public function addRule(){
        if(IS_POST){
            $data = I('post.');

            if(M('Admin_rule')->add($data)){
                $this->success('添加成功', U('User/listRule'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $pid = I('get.pid') ? : 0;
            $this->assign('pid', $pid);
            if($pid != 0){
                if(!M('Admin_rule')->where('id='.$pid)->find()){
                    $this->error('父权限不存在');
                }
            }
            $list = M('Admin_rule')->where('status=1')->order('id ASC')->select();
            $tree_list = getTree($list);
            $this->assign('list', $tree_list);
            $this->display();
        }
    }

    public function editRule(){
        $id = I('get.id');
        if(!$id || !$info = M('Admin_rule')->where('id='.$id)->find()){
            $this->error('该权限不存在！');
        }
        $this->assign('id', $id);
        if(IS_POST){
            $data = I('post.');

            if(M('Admin_rule')->where('id='.$id)->save($data)){
                $this->success('编辑成功', U('User/listRule'));
            }else{
                $this->error('编辑失败');
            }
        }else{
            $this->assign('info', $info);
            $list = M('Admin_rule')->where('status=1')->order('id ASC')->select();
            $tree_list = getTree($list);
            $this->assign('list', $tree_list);
            $this->display();
        }
    }

    public function dropRule(){
        $id = I('get.id');
        if(!$id){
            $this->error('该权限不存在！');
        }
        if(M('Admin_rule')->where('id='.$id)->delete()){
            $this->success('删除成功', U('User/listRule'));
        }else{
            $this->error('删除失败', U('User/listRule'));
        }
    }

    public function listMenu(){
        $list = M('Admin_menu')->where('status=1')->order('id ASC')->select();
        $tree_list = getTree($list);
        $this->assign('list', $tree_list);
        $this->display();
    }

    public function addMenu(){
        if(IS_POST){
            $data = I('post.');

            if(M('Admin_menu')->add($data)){
                $this->success('添加成功', U('User/listMenu'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $pid = I('get.pid') ? : 0;
            $this->assign('pid', $pid);
            if($pid != 0){
                if(!M('Admin_menu')->where('id='.$pid)->find()){
                    $this->error('父菜单不存在');
                }
            }
            $list = M('Admin_menu')->where('status=1')->order('id ASC')->select();
            $tree_list = getTree($list);
            $this->assign('list', $tree_list);
            $this->display();
        }
    }

    public function editMenu(){
        $id = I('get.id');
        if(!$id || !$info = M('Admin_menu')->where('id='.$id)->find()){
            $this->error('该菜单不存在！');
        }
        $this->assign('id', $id);
        if(IS_POST){
            $data = I('post.');

            if(M('Admin_menu')->where('id='.$id)->save($data)){
                $this->success('编辑成功', U('User/listMenu'));
            }else{
                $this->error('编辑失败');
            }
        }else{
            $this->assign('info', $info);
            $list = M('Admin_menu')->where('status=1')->order('id ASC')->select();
            $tree_list = getTree($list);
            $this->assign('list', $tree_list);
            $this->display();
        }
    }

    public function dropMenu(){
        $id = I('get.id');
        if(!$id){
            $this->error('该菜单不存在！');
        }
        if(M('Admin_menu')->where('id='.$id)->delete()){
            $this->success('删除成功', U('User/listMenu'));
        }else{
            $this->error('删除失败', U('User/listMenu'));
        }
    }

    public function refreshMenu(){
        $menu_list = M('Admin_menu')->where('status=1')->order('sort DESC')->index('id')->select();
        $dir = RUNTIME_PATH.'Cache/menu.php';
        $menu_file = fopen($dir, "w") or die("Unable to open file!");
        $text = "<?php\n\$menu_list = ".var_export($menu_list, true).";\n?>";
        fwrite($menu_file, $text);
        fclose($menu_file);
        $this->success('更新成功', U('User/listMenu'));
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
                $this->success('分配成功', U('User/listGroup'));
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
            $user_list = M('Admin')->alias('a')->field('a.*, aga.group_id')->join('__ADMIN_GROUP_ACCESS__ aga ON a.admin_id=aga.admin_id', 'LEFT')->where(array('a.admin_name'=>array('like', '%'.$username.'%')))->select();
            $this->assign('user_list', $user_list);
        }

        $group_user_list = M('Admin')->alias('a')->field('a.*, aga.group_id')->join('__ADMIN_GROUP_ACCESS__ aga ON a.admin_id=aga.admin_id', 'LEFT')->where(array('aga.group_id'=>$id))->select();
        $this->assign('group_user_list', $group_user_list);

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
                $this->success('分配用户成功', U('User/listGroup'));
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
            $this->success('从用户组中删除成功！', U('User/listGroup'));
        }else{
            $this->error('从用户组中删除失败！');
        }
    }
}