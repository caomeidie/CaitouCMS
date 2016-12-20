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
			$this->assign('menu_list',getTree($menu_list, 'level'));
		}else{
			$menu_list = M('Admin_menu')->where('status=1')->order('id ASC')->index('id')->select();
			$dir = RUNTIME_PATH.'Cache/menu.php';
			$menu_file = fopen($dir, "w") or die("Unable to open file!");
			$text = "<?php\n\$menu_list = ".var_export($menu_list, true).";\n?>";
			fwrite($menu_file, $text);
			fclose($menu_file);
			$this->assign('menu_list',getTree($menu_list, 'level'));
		}

		$a_c = CONTROLLER_NAME.'/'.ACTION_NAME;
		$menu = I('get.menu') ? I('get.menu') : 0;
		if($menu == 0){
			if($menu_arr = $this->parent_menu($a_c, $menu_list)){
				$menu = $menu_arr['top_menu'];
				$a_c = $menu_arr['title'];
			}
		}
		if(!$menu){
			$start_menu_list = M('Admin_menu')->where('status=1 AND recom=1')->order('id ASC')->index('id')->select();
			$this->assign('start_menu_list',$start_menu_list);
		}
		$this->assign('menu', $menu);
		$this->assign('menu_active', $a_c);

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

	private function parent_menu($value, $array){
		foreach($array as $key=>$val){
			if($val['title'] == $value){
				if($array[$val['id']]['pid'] == 0){
					return array('top_menu'=>$val['id'], 'title'=>$val['title']);
				}elseif($array[$array[$key]['pid']]['pid'] != 0){
					return array('top_menu'=>$array[$array[$key]['pid']]['pid'], 'title'=>$array[$array[$key]['pid']]['title']);
				}else{
					return array('top_menu'=>$array[$val['id']]['pid'], 'title'=>$array[$val['id']]['title']);
				}

			}
		}
		return false;
	}
}