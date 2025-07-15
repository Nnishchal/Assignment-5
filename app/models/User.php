<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function signup($username, $password, $confirm_password){
        $db = db_connect();
        if ($password != $confirm_password) {
          header('Location: /create');
          die;
        }
      if (strlen($password) < 8) {
          header('Location: /create');
          die;
      }
      $query = $db->prepare("SELECT * FROM users WHERE username = :username;");
        $query->execute(['username' => $username]);
        if ($query->rowCount() > 0){
          header('Location: /create');
          die; 
        }else{
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $query = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password);");
          $query->execute(['username' => $username, 'password' => $hashed_password]);
          header('Location: /login');
          die;
        }
    }
  

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
  $username = strtolower($username);
    $db = db_connect();

    if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] >= 3) {
      $stmt = $db->prepare("SELECT time FROM logs WHERE username = :username AND attempt = 'BAD' ORDER BY time DESC LIMIT 1");
      $stmt->execute(['username' => $username]);
      $last_attempt_time = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($last_attempt_time){
        $last_attempt_time = strtotime($last_attempt_time['time']);
        $time_difference = time() - $last_attempt_time;
        if ($time_difference < 60) {
          header('Location: /login');
          die;
        } else{
          unset($_SESSION['failedAuth']);
        }
      }
    }

    $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
    $statement->bindValue(':name', $username);
    $statement->execute();
    $rows = $statement->fetch(PDO::FETCH_ASSOC);

    $type = 'BAD';

  if (password_verify($password, $rows['password'])) {
    $_SESSION['auth'] = 1;
    $_SESSION['username'] = ucwords($username);
    unset($_SESSION['failedAuth']);
    $type = 'GOOD';
  } else {
    if(isset($_SESSION['failedAuth'])) {
        $_SESSION['failedAuth'] ++;
      } else{
        $_SESSION['failedAuth'] = 1;
      }
  }
    $query = $db->prepare("INSERT INTO logs (username, attempt, time) VALUES (:username, :attempt, NOW());");
    $query->execute([
                    'username' => $username,
                    'attempt' => $type
                    ]);
    if ($type == 'GOOD'){
      header('Location: /home');
      die;
    }else{
      header('Location: /login');
      die;
    }

}
}
