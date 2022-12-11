<?php
session_start();
if(isset($_SESSION['adminuser'])){
	header('Location: adminpanel.php');
}
elseif(isset($_SESSION['customer'])){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="static-login.css">
    <title>Static Login</title>
</head>
<body>
    <div class="container">
            <div class="row mt-5">
                <div class="col-10">
                    <h1><i class="fa fa-store"></i> Learn IT Easy Online Shop</h1>
                </div>
            </div>
        <hr>
        <?php
            if(isset($_POST['btnsignin'])){
                require_once('open-connection.php');
                if(isset($_POST['usertype'])){
                $type = ($_POST['usertype']);
                $strtype = implode($type);
                $username = htmlspecialchars($_POST['txtusername']);
                $password = htmlspecialchars($_POST['txtpassword']);

                $username = stripcslashes($username);
                $password = stripcslashes($password);

                $username = mysqli_real_escape_string($con, $username);
                $password = mysqli_real_escape_string($con, $password);

                $password = md5($password);

                    if($strtype === 'Admin'){
                        $strSql= "
                                    SELECT name FROM tbl_user 
                                    WHERE username = '$username'
                                    AND password = '$password'
                                ";

                        if($rsUser = mysqli_query($con, $strSql)){
                            if(mysqli_num_rows($rsUser) > 0){
                                $_SESSION['adminuser'] = $username;
                                header('location:adminpanel.php');
                            }
                            else{
                                echo'<div class="container-fluid text-center pt-3 mx-auto" style="width: 380px">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Invalid Username / Password
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                </div>';
                                }
                        }
                        else{
                            echo 'ERROR: Could not execute your request.';
                        }
                    }
                    elseif($strtype === 'Customer'){
                        $strSql= "
                                    SELECT * FROM tbl_customer
                                    WHERE emailAddress = '$username'
                                    AND password = '$password'
                                ";
                        if($rsCustomer = mysqli_query($con, $strSql)){
                            if(mysqli_num_rows($rsCustomer) > 0){
                                $_SESSION['customer'] = $username;
                                header('location:index.php');
                            }
                            else{
                                echo'<div class="container-fluid text-center pt-2 mx-auto" style="width: 380px">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Invalid Username / Password
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>';
                            }
                        }
                        else{
                            echo 'ERROR: Could not execute your request.';
                        }
                    }
                    require_once('close-connection.php');
                }
            }
        ?>

        <div class="card card-container">
            <form class="form-signin" method ="post">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <select name="usertype[]"  class="form-control" id="usertype">
                    <option value="Customer">Customer</option>
                    <option value="Admin">Admin</option>
                </select><br>
                <input type="text" name="txtusername" id="txtusername" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="txtpassword" id="txtpassword" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btnsignin">Sign in</button>
            </form>
            <a href="change-password.php" class="ForgetPwd" value="Login">Change Password?</a>
            <a href="register.php" class="signin" value="Login">Sign Up?</a>
        </div>s
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>