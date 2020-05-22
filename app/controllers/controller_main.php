<?php
class Controller_Main extends Controller
{
    function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = $this->model->get_data();		
		$this->view->generate('main_view.php', 'template_view.php', $data);
    }
    
    function action_add() 
    {
        if(!empty($_POST)) {
            $data = $this->model->get_data();
            $data['error_email'] = $this->model->add_data();
            
            if ($data['error_email'] != NULL){   
                $this->view->generate('main_view.php', 'template_view.php', $data);
            } else{
                header("Location: /main/index/?success=true");
            }
        }
    }

    function action_check() {
        if(!empty($_GET)) {
            var_dump("Error");
        } else { 
            $this->model->check_item();
        }
    }

    function action_edit() {
        if(!empty($_GET)) {
            var_dump("Error");
        } else {
            $this->model->edit_item();
        }
    }
}