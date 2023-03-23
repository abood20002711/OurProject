<?php 
session_start();
if (isset($_SESSION['username'])){
  header("Location:dashbord.php");
}
include "init.php";
include "dashbord.php";
include "connect.php";
include $tpl ."header.php";
// include "includs/lang/english.php" // later
// check if user coming from http post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username=$_POST['username'];
      $password=$_POST['password'];
      $hasherPass= sha1($password);
   
      // Check if user exists in database
      $stmt= $con->prepare("select Username,Password from myshop.users where Username = ? and Password =? and GroupID	= 1");
    //   $stmt ->execute(array($username,$hasherPass));
      $count=$stmt->rowCount();
      
    //   if count is greater 0 means the database contains this user
      if ($count > 0){
        $_SESSION['username'] = $username; //register Session name
        header("Location:dashbord.php");
        exit();
      }
    }
 ?>
  <!-- Start Login page -->
  <div class="page-login ">
        <div class="content">
            <div class="formbx">
                <h2>Welcom back</h2>
                <p class="c-8">Welcom back! Pleas enter your details</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="inputbx form-outline ">
                        <span class="form-label">Username</span>
                        <input type="text" name="username" placeholder="Enter your usernane"  class="form-control ">
                        <a href="#"><i class="fa fa-user "></i></a>
                    </div>
                    <div class="inputbx ">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Enter your password" id="password" class="pass form-control">
                        <i class="fa-solid fa-key"></i>
                        <i onclick="visibili()" class="fa-regular fa-eye hide" id="hide"></i>
                    </div>
                    <div class="remember ">
                        <label for="remember"><input type="checkbox" class="form-check-inpu" id="remember"> Remember me</label>
                        <a href="#">Forgot password</a>
                    </div>
                    <div class="inputbx">
                        <input type="submit" value="Login" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <div class="or">or</div>
                <div class="log-with">
                    <a href="#" class="face"><i class="fa-brands fa-facebook-f fa-lg"></i></i></a>
                    <a href="#" class="twi"><i class="fa-brands fa-twitter fa-lg"></i></a>
                    <a href="#" class="goo"><i class="fa-brands fa-google-plus-g fa-lg"></i></a>
                </div>
                <div class="reg">
                   <?php echo "<p>Don't have an account? <a href='signup.php'>Sign up here</a></p>"; ?>
                </div>
            </div>
        </div>
        <div class="img">
            <img src="layout/imges/pexels-bogdan-glisik-1661471.png" alt="">
        </div>
    </div>
    <!-- End login page -->


<?php include $tpl . "footer.php"; ?>
