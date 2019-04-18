<?php


session_start();
include_once "User_parent.php";
if(isset($_COOKIE['usernmame'])&& isset($_COOKIE['password'])){
    $username=$_COOKIE['username'];
    $password=$_COOKIE['password'];
}
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
}
else{
    if(isset($_POST['remember'])){
        setcookie("username",$username,time()+(60*60));
        setcookie("password",$password,time()+(60*60));
    }
}

$logged_user=new User_parent();
$logged_user->set_username($username);
$logged_user->set_password($password);
$login_return=$logged_user->login();
$user_id=$logged_user->get_id();
if($login_return){
    $logged_user=new User_parent($user_id);
    $_SESSION['id']=$user_id;
    $_SESSION['username']=$logged_user->get_username();
    $_SESSION['password']=$logged_user->get_password();
    $_SESSION['fname']=$logged_user->get_fname();
    $_SESSION['lname']=$logged_user->get_lname();
    $_SESSION['email']=$logged_user->get_email();
    $_SESSION['role']=$logged_user->get_Roles();
    if($_SESSION['role']==1){
    header("location: adminhome.php");}
    if($_SESSION['role']==2){
    header("location: customehome.php");}
    if($_SESSION['role']==3){
    header("location: employeehome.php");}
}








?>

<html>
<head>
<link rel="stylesheet" href="login.css">
</head>

<body>
    
    <form action="index.php" method ="post" name="login">
  <!-- <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div> -->

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" name="submit" value="Login">Login</button>
    <label>
        <input type="checkbox" checked="checked"name="remember"> Remember me
    </label>
</div>

  <div class="container" style="background-color:#f1f1f1">
  </div>

</form>
</body>



</html>