<?php

include 'lib/Database.php';
include_once 'lib/Session.php';


class Users{


  // Db Property
  private $db;

  // Db __construct Method
  public function __construct(){
    $this->db = new Database();
  }
  
  // Check Exists Email Address Method
  public function checkExistsEmail($email){
    $sql = "SELECT email from user WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }

  // Add New User By Admin
  public function addNewUserByAdmin($data){
    $username = $data['username'];
    $password = $data['password'];
    $email = $data['email'];

    $checkEmail = $this->checkExistsEmail($email);

    if ($username == "" || $password == "" || $email == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Input fields must not be Empty !</div>';
        return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Password at least 6 Characters !</div>';
        return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address!</div>';
        return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
        return $msg;
    }else{

      $sql = "INSERT INTO user (username, password, email) VALUES (:username, :password, :email";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':email', $email);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Registered successfully!</div>';
          return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Something went Wrong!</div>';
          return $msg;
      }



    }





  }



  // Select All User Method
  public function selectAllUserData(){
    $sql = "SELECT * FROM user ORDER BY user_id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // User login info method
  public function userLoginInfo($email, $password){
    $password = SHA1($password);
    $sql = "SELECT * FROM user WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  // Check User Account enabled status
  public function CheckEnabledUser($email){
    $sql = "SELECT * FROM user WHERE email = :email and isEnabled = :isEnabled LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isEnabled', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }

    // Check User Account admin status
  public function CheckAdminUser($email){
    $sql = "SELECT * FROM user WHERE email = :email and role_id = :role_id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':role_id', 1);
    $stmt->execute();
    $test1 = $stmt->fetch(PDO::FETCH_OBJ);
    $sql = "SELECT * FROM admin WHERE email = :email and isAdmin = :isAdmin LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isAdmin', 1);
    $stmt->execute();
    $test2 = $stmt->fetch(PDO::FETCH_OBJ);
    if ($test1 && $test2) {
      return true;
    }
  }




    // User Authentication Method
    public function userAuthentication($data){
      $email = $data['email'];
      $password = $data['password'];


      $checkEmail = $this->checkExistsEmail($email);

      if ($email == "" || $password == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Email or password cannot be empty!</div>';
          return $msg;
      }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $checkEmail == FALSE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Invalid email address!</div>';
          return $msg;
      }else{

        $loginResult = $this->userLoginInfo($email, $password);
        $chkAdmin = $this->CheckAdminUser($email);
        $chkEnabled = $this->CheckEnabledUser($email);

        if ($chkAdmin == FALSE || $chkEnabled == FALSE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Sorry, either your account is disabled or you are not admin!</div>';
            return $msg;
        }elseif ($loginResult) {

          Session::init();
          Session::set('login', TRUE);
          Session::set('user_id', $loginResult->user_id);
          Session::set('username', $loginResult->username);
          Session::set('email', $loginResult->email);
          Session::set('avatar_id', $loginResult->avatar_id);
          Session::set('role_id', $loginResult->role_id);
          Session::set('logMsg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> You are logged in successfully as administrator!</div>');
          echo "<script>location.href='index.php';</script>";

        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Email or password did not match!</div>';
            return $msg;
        }

      }


    }



    // Get Single User Information By Id Method
    public function getUserInfoById($user_id){
      $sql = "SELECT * FROM user WHERE user_id = :user_id LIMIT 1";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':user_id', $user_id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return $result;
      }else{
        return false;
      }


    }



  //
  //   Get Single User Information By Id Method
    public function updateUserByIdInfo($user_id, $data){
      $username = $data['username'];
      $email = $data['email'];
      $role_id = $data['role_id'];
      $avatar_id = $data['avatar_id'];

      if ($username == ""|| $email == "") {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Input Fields must not be Empty !</div>';
          return $msg;
        }elseif (strlen($username) < 3) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
            return $msg;

      }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Invalid email address !</div>';
          return $msg;
      }else{

        $sql = "UPDATE user SET
          username = :username,
          email = :email,
          avatar_id = :avatar_id,
          role_id = :role_id,
          WHERE user_id = :user_id";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':username', $username);
          $stmt->bindValue(':email', $email);
          $stmt->bindValue(':avatar_id', $avatar_id);
          $stmt->bindValue(':role_id', $role_id);
          $stmt->bindValue(':user_id', $user_id);
        $result =   $stmt->execute();

        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Your information was updated successfully!</div>');



        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not inserted!</div>');


        }


      }


    }




    // Delete User by Id Method
    public function deleteUserById($delete){
      $sql = "DELETE FROM user WHERE user_id = :user_id ";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':user_id', $delete);
        $result =$stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> User account deleted successfully!</div>';
            return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not deleted!</div>';
            return $msg;
        }
    }

    // User Disabled By Admin
    public function userDisableByAdmin($disable){
      $sql = "UPDATE user SET

       isEnabled=:isEnabled
       WHERE user_id = :user_id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isEnabled', 0);
       $stmt->bindValue(':user_id', $disable);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> User account disabled successfully!</div>');

        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not disabled!</div>');

            return $msg;
        }
    }


    // User Enabled By Admin
    public function userEnableByAdmin($enable){
      $sql = "UPDATE user SET
       isEnabled=:isEnabled
       WHERE user_id = :user_id";

       $stmt = $this->db->pdo->prepare($sql);
       $stmt->bindValue(':isEnabled', 1);
       $stmt->bindValue(':user_id', $enable);
       $result =   $stmt->execute();
        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> User account enabled successfully!</div>');
        }else{
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Data not enabled!</div>');
        }
    }




    // Check Old password method
    public function CheckOldPassword($user_id, $old_pass){
      $old_pass = SHA1($old_pass);
      $sql = "SELECT password FROM user WHERE password = :password AND user_id =:user_id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $old_pass);
      $stmt->bindValue(':user_id', $user_id);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
    }



    // Change User pass By Id
    public  function changePasswordBysingleUserId($user_id, $data){

      $old_pass = $data['old_password'];
      $new_pass = $data['new_password'];


      if ($old_pass == "" || $new_pass == "" ) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Password field must not be Empty !</div>';
          return $msg;
      }elseif (strlen($new_pass) < 6) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> New password must be at least 6 characters !</div>';
          return $msg;
       }

         $oldPass = $this->CheckOldPassword($user_id, $old_pass);
         if ($oldPass == FALSE) {
           $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Error !</strong> Old password did not Matched !</div>';
             return $msg;
         }else{
           $new_pass = SHA1($new_pass);
           $sql = "UPDATE user SET

            password=:password
            WHERE user_id = :user_id";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':password', $new_pass);
            $stmt->bindValue(':user_id', $user_id);
            $result =   $stmt->execute();

          if ($result) {
            echo "<script>location.href='index.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Great news, Password Changed successfully !</div>');

          }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Password did not changed !</div>';
              return $msg;
          }

         }



    }








}

?>
