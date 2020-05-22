<?php
class Model_Main extends Model
{
	public function get_data()
	{	
        $sort = $_GET["sort"];
        $order = $_GET["order"];
        $page = $_GET["page"];
        $firstItem = ($page - 1)*3;
        $result["PAGE"] = $page;

        if ($_GET["success"]){
            $result["SUCCESS"] = "Task successfully added";
        }

        $mysqli = new mysqli("127.0.0.1", "denisgeyer", "tGb6hSg3iTAfHeu2", "denisgeyer");

        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: " . mysqli_connect_error();
        }
        if (!empty($sort)){
            $res = $mysqli->query("SELECT * FROM task ORDER BY ".$sort." ".$order);
        } else {
            $res = $mysqli->query("SELECT * FROM task ORDER BY task_id desc");
        }
        if (!empty($page)){
            $res->data_seek($firstItem);
        } else {
            $result["PAGE"] = 1;
            $res->data_seek(0);
        }
        $result["LUST_PAGE"] = ceil(($res->num_rows) / 3);
        
        if($res->num_rows < 3){
            $counter = $res->num_rows;
        } else {
            $counter = 3;
        }

        for ($i = 0; $i < $counter; $i++){
            $row = $res->fetch_assoc();
            $result["CONTENT"][] = $row;
        }
        return $result; 
		
    } 

    public function add_data() {	
        $mysqli = new mysqli("127.0.0.1", "denisgeyer", "tGb6hSg3iTAfHeu2", "denisgeyer");

        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: " . mysqli_connect_error();
        }
        $email = $_POST["email"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            if (!$mysqli->query("INSERT INTO task(user_name, user_email, text) 
                VALUES ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["text"]."');"))
            return $mysqli->errno . ") " . $mysqli->error;
        } else{
            return "email: ".$email." not valid";
        }
    }
    
    public function check_item() {
        $mysqli = new mysqli("127.0.0.1", "denisgeyer", "tGb6hSg3iTAfHeu2", "denisgeyer");

        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: " . mysqli_connect_error();
        }

        $cheked = $_POST["checked"];
        $item_id = $_POST["id"];
        if(!$mysqli->query("UPDATE task SET task_status = ".$cheked." WHERE task_id = ".$item_id)) {
            var_dump( $mysqli->errno . ") " . $mysqli->error);
        }

    }

    public function edit_item() {
        $mysqli = new mysqli("127.0.0.1", "denisgeyer", "tGb6hSg3iTAfHeu2", "denisgeyer");

        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: " . mysqli_connect_error();
        }

        $text = $_POST["text"];
        $item_id = $_POST["id"];
        if(!$mysqli->query("UPDATE task SET text = '".$text."' WHERE task_id = ".$item_id)) {
            var_dump( $mysqli->errno . ") " . $mysqli->error);
        }

    }
}