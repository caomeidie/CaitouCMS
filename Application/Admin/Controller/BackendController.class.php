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
		if(is_file(RUNTIME_PATH.'Cache/menu.php')){
			require_once RUNTIME_PATH.'Cache/menu.php';
			$this->assign('menu_list',MENU_LIST);
		}else{
			$menu_list = M('Admin_menu')->where('status=1')->order('id ASC')->index('id')->select();
			$tree_list = getTree($menu_list, 'level');
			$dir = RUNTIME_PATH.'Cache/menu.php';
			$menu_file = fopen($dir, "w") or die("Unable to open file!");
			$text = "<?php\ndefine(\"MENU_LIST\", ".var_export($tree_list, true).");\n?>";
			fwrite($menu_file, $text);
			fclose($menu_file);
			define("MENU_LIST",$tree_list);
			$this->assign('menu_list',$tree_list);
		}

		//$this->assign('menu_active',CONTROLLER_NAME.'/'.ACTION_NAME);
        $this->assign('controller',CONTROLLER_NAME);
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