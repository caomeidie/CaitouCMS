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

	public function page($count, $per = 10){
		$Page       = new \Think\Page($count, $per);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('last','末页');
		$Page->setConfig('first','首页');
        $show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);
		return $Page->firstRow.','.$Page->listRows;
	}
}