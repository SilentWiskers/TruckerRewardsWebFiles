<?php
class User
{
    private $mysqli;
	public $uid;
	public $email;
	private $type;


    public function __construct($db, $uid_construct = null)
    {
        $this->mysqli = $db;

		if(isset($uid_construct)){
			$this->uid = $uid_construct;
			$users = $this->mysqli->query("SELECT * from users WHERE id = ?", [$uid_construct])->fetchAll("assoc");
			$user = $users[0];
			$this->email = $user['email'];
			$this->type = $user['type'];


		}
		else if(isset($_SESSION['user_id'])){
			$this->uid = $_SESSION['user_id'];
			$users = $this->mysqli->query("SELECT * from users WHERE id = ?", [$this->uid])->fetchAll("assoc");
			$user = $users[0];
			$this->email = $user['email'];
			$this->type = $user['type'];

		}
    }

    public function register($email, $password, $first_name, $last_name, $address, $phone, $type)
    {
		$res = $this->mysqli->query("SELECT * from users WHERE email = ?", [$email])->fetchAll("assoc");
		if(count($res) > 0)
			return "User with this email already exists!";

		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$res = $this->mysqli->query("INSERT INTO users (email, password, first_name, last_name, address, phone, type) VALUES (?, ?, ?, ?, ?, ?, ?)", [$email, $password_hash, $first_name, $last_name, $address, $phone, $type]);
		return "Registration Sucessful!";
	}

	public function isAdmin(){
		if ($this->type == 2)
			return true;
		return false;
	}


	public function isSponsor(){
		if ($this->type == 1)
			return true;
		return false;
	}

	public function isDriver(){
		if ($this->type == 0)
			return true;
		return false;
	}


	public function getValue($key){
		$users = $this->mysqli->query("SELECT * from users WHERE id = ?", [$this->uid])->fetchAll("assoc");
		$user = $users[0];
		return $user[$key];

	}


    public function login($email, $password)
    {
		$users = $this->mysqli->query("SELECT * from users WHERE email = ?", [$email])->fetchAll("assoc");
		if(count($users) < 1)
			return "Login failed.";
		$user = $users[0];
		if(password_verify($password, $user['password'])){
			$_SESSION['user_id'] = $user['id'];
			$this->uid = $user['id'];
			$this->email = $user['email'];
			$this->type = $user['type'];

			return "Login success!";
		}
		return "Login failed.";
    }

    public function is_logged_in() {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
		return false;
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function log_out() {
        session_destroy();
        unset($_SESSION['user_id']);
		$this->redirect("/login.php");
        return true;
    }
}
