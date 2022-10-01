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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>register</title>
</head>

<body>
    <div class="wrapper" style="background-color: #f0f2f5;">
        <div class="container">
            <div class="row align-items-center " style="height: 100vh;">
                <div class="col-md-6">
                   <img src="./img/logo1.png" alt="" class="img-fluid">
                </div>
                <div class="col-md-4 p-4" style="background-color: #fff; box-shadow:0 0 5px; border-radius:10px;">
                    <?php if(!empty($error))    echo "<h3 class='error_msg'>".$error."</h3>";?>
                    <form action="" method="post" class="form">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
                            <label for="floatingInput">user name</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="row">
                            
                            <div class="form-group">
                                <input type="submit" name="login" value="login" class="btn btn-primary my-3 w-100">
                            </div>
                            <a href="forgot.php" class="mb-3 text-center">forgot password</a>
                            <hr class="">
                            

                        </div> 
                    </form>   
                            <?php if(isset($success)) echo '<script>alert("you are successfully registered"); </script>'; ?>

                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                           Sign up
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#0d6efd ;">
                                        <h5 class="modal-title" id="staticBackdropLabel">sign up</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <div class="col-md">
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" id="floatingfirstname" name="firstname" placeholder="firstname" required>
                                                    <label for="floatingfirstname">firstname</label>
                                                </div>
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" id="floatinglastname" name="lastname" placeholder="lastname" required>
                                                    <label for="floatinglastname">lastname</label>
                                                </div>
                                                <div class="form-floating my-3">
                                                    <input type="text" class="form-control" id="floatingusername" name="username" placeholder="username" required>
                                                    <label for="floatingusername">username</label>
                                                </div>
                                                <div class="form-floating my-3">
                                                    <input type="email" class="form-control" id="floatingemail" name="email" placeholder="enter your email" required>
                                                    <label for="floatingemail">email</label>
                                                </div>
                                                <div class="form-floating my-3">
                                                    <input type="date" class="form-control" id="dob" name="dob">
                                                    <label for="dob">D.O.B.</label>
                                                </div>
                                                <div class="form-floating my-3">
                                                    <input type="password" class="form-control" id="floatingPassword1" name="password" placeholder="Password" required>
                                                    <label for="floatingPassword1">Password</label>
                                                </div>
                                                <div class="form-floating my-3">
                                                    <input type="password" class="form-control" id="floating" name="verifypassword" placeholder="Retype your Password" required>
                                                    <label for="floating">Retype your Password</label>
                                                </div>
                                               <div class="form-group my-3">
                                                <input type="submit" value="signup" name="signup" id="submitbutton" disabled class="btn btn-success">
                                               </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        </div>


                    
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
        let password = document.querySelector('#floatingPassword1');
        let verifypassword = document.querySelector('#floating');
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