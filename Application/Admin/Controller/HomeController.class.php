<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class HomeController extends BackendController {
    public function index(){
        $this->display();
    }
}