<?php
namespace Admin\Controller;
use Think\Controller;
class BackendController extends Controller {
	public function __construct() {
		parent::__construct();
		
		//判断是否登录
		if(!session('admin')){
			$this->redirect('Index/index');
		}
		$this->assign('controller',CONTROLLER_NAME);
		$this->assign('action',ACTION_NAME);
	}
}