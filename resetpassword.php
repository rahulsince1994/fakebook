<?php
 if(!isset($_GET["email"])){
    header("location:forgot.php");
}
    require "process.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>password reset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row align-items-center " style="height: 100vh;">
                <div class="col-md-4 offset-md-2">
                    <h1 style="font-weight:900;color:#0d6efd">facebook</h1>
                    <h3>create account and connect to the world</h3>
                </div>
                <div class="col-md-4 p-4" style="background-color: #fff; box-shadow:0 0 5px; border-radius:10px;">
                    <?php if (!empty($error))    echo "<h3 class='error_msg'>" . $error . "</h3>"; ?>
                    <form action="" method="post" class="form">
                    <div class="form-floating">
                            <input type="password" class="form-control my-3" name="password" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="verifypassword" id="floatingverify" placeholder="Password">
                            <label for="floatingverify">Verify Password</label>
                        </div>
                        <div class="row">

                            <div class="form-group">
                                <input type="submit" name="reset" value="reset" id ="submitbutton" disabled class="btn btn-success my-3 w-100">
                            </div>
                          

                        </div>
                    </form>
                    <?php if (isset($change)) echo '<script>alert(" successfully change password");
                    window.location.href="register.php" </script>'; 
                     
                    ?>




                </div>

            </div>

        </div>

    </div>

    <script>
        let password = document.querySelector('#floatingPassword');
        let verifypassword = document.querySelector('#floatingverify');
        let submitbutton = document.querySelector('#submitbutton');
        let passwordvalue;
      
        verifypassword.addEventListener('keyup',()=>{
            if(password.value==verifypassword.value){
                verifypassword.style.cssText = 'border:2px green solid !important';
                submitbutton.disabled = false;

            }else{
                verifypassword.style.cssText = 'border:2px red solid !important';
            }
        })



    </script>

</body>

</html>