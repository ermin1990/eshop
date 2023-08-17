<?php

class User{

    protected $conn;

    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }

    public function createUser($name, $username, $email, $password){

        // Provera da li već postoji korisnik sa istim korisničkim imenom ili email adresom
        $sql_check_existing = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt_check_existing = $this->conn->prepare($sql_check_existing);
        $stmt_check_existing->bind_param("ss", $username, $email);
        $stmt_check_existing->execute();
        $existing_user = $stmt_check_existing->get_result()->fetch_assoc();

        if ($existing_user) {
            $_SESSION['servermsg'] = "Postoji korisnik sa ovim imenom ili emailom!";
            return false;
        }else{
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("ssss", $name,$username,$email,$hash_password);
            $result = $stmt->execute();

            if($result){
                $_SESSION['user_id']=$result->insert_id;
                return true;
            }else{
                return false;
            }
        }
    }


    public function checkUser($username){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        if ($user){
            return true;
        }else{
            return false;
        }
}

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Prijavljivanje uspešno
            $_SESSION['user_id'] = $user['user_id'];
            return true;
        } else {
            $_SESSION['servermsg'] = "Prijavljivanje nije uspjelo!";
            return false;
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
    }


    public function is_loggedIn():bool
    {
        if (isset($_SESSION['user_id'])){
            return true;
        }return false;
    }

    public function is_admin($user_id){
        $sql = "SELECT * FROM users WHERE user_id = ? AND is_admin=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows>0){
            return true;
        }return false;
    }

    public function getUser($user_id)
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }


}