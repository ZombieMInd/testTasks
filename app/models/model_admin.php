<?php
session_start();
class Model_Admin extends Model {

	public function checkUser() {

		$login = $_POST['login'];
		$password = $_POST['password'];
		$mysqli = new mysqli("127.0.0.1", "denisgeyer", "tGb6hSg3iTAfHeu2", "denisgeyer");
        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: " . mysqli_connect_error();
		}
		
		$sql = "SELECT * FROM users WHERE login = '$login' AND password = $password";
		$res = $mysqli->query($sql);
		if($res == false){
			$_SESSION['authorized'] = 0;
			return false;
		}
		$res->data_seek(0);
		if ($row = $res->fetch_assoc()) {
			$_SESSION['authorized'] = 1;
			header("Location: /");
        }else{
			$_SESSION['authorized'] = 0;
			return false;
		}
	}

}