<?php
namespace Admin\Controller;
use Admin\Controller\BackendController;
class UserController extends BackendController {
    public function index(){
        $this->display();
    }
}