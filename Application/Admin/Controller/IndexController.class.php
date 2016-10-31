<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
    private $allow_action = array('Index/logout');
	public function __construct(){
	    parent::__construct();
		if(session('admin') && !in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $this->allow_action)){
			$this->redirect('Article/index');
		}
	}
    public function index(){
        $this->display();
    }
    
    public function login(){
    	$admin_name = I('post.admin');
    	$password = I('post.password');
    	$verify = I('post.verify');
    	if(!$this->check_verify($verify)){
    		$this->error("亲，验证码输错了哦！",$this->site_url,3);
    	}
    	if($adminInfo = M('Admin')->where(array('admin_name'=>$admin_name, 'password'=>sha1($password)))->find()){
    		session('admin', $adminInfo);
    		$this->redirect('Article/index');
    	}else{
    		$this->error("登录失败！");
    	}
    }
    
    public function verify(){
    	$Verify = new Verify();
    	$Verify->fontSize = 13;
    	$Verify->useNoise = false;
    	$Verify->imageW = 95;
    	$Verify->imageH = 32;
    	$Verify->length = 4;
    	$Verify->fontttf = '4.ttf';
    	$Verify->entry();
    }
    
    public function check_verify($code){
    	$Verify = new Verify();
    	return $Verify->check($code); 
    }

	public function logout(){
		session('admin', null);
		$this->redirect('Index/index');
	}
}