<?php

class Controller_Admin extends Controller {
	
	private $pageTpl = '/views/admin_view.php';


	public function __construct() {
		$this->model = new Model_Admin();
		$this->view = new View();
	}
	
	public function action_index(){
		
		$data['title'] = "Log in to your personal account";
		
		if(!empty($_POST)) {
			if(!$this->login()) {
				$data['error'] = "Wrong login or password";
			}
		}
		$this->view->generate('admin_view.php', 'template_view.php', $data);
    }

	public function login() {
		return $this->model->checkUser();
	}
}