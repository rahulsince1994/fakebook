<?php
session_start();
require "process.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="wrapper" style="background-color: #f0f2f5;">
        <div class="container">
            <div class="row align-items-center " style="height: 100vh;">
            <?php if(isset($message)){
                $name= $result["username"];
                $to = $result["email"];
                $hex = bin2hex($to);
                    echo "<div class='alert alert-success' role='alert'>
                    'Hello $name, please click on the link given below to reset your password. <a href='http://localhost/facebook/resetpassword.php?email=$hex'>Reset Your Password</a>';
                  </div>
                  ";
                }?>
                <div class="col-md-6">
                   <img src="./img/logo1.png" alt="" class="img-fluid">
                </div>
                <div class="col-md-4 p-4" style="background-color: #fff; box-shadow:0 0 5px; border-radius:10px;">
                    <?php if (!empty($error))    echo "<h6 class='text-danger'>" . $error . "</h6>"; ?>
                    <form action="" method="post" class="form">
                        <div class="form-floating my-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                            <label for="floatingInput">email</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="forgot" value="Submit" class="btn btn-primary my-3 w-100">
                        </div>
                        
                        

                    </form>
                    <div class="form-group text-center">
                           <a href="register.php"  class="text-decoration-none my-2">Login</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>