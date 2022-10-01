<?php
    session_start();

require "process.php";
if (!isset($_SESSION["sid"])) {
    header("location:register.php");
}
$user = getData($_SESSION['sid']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagename; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
     
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg px-5" style="background-color:#0E918C">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./img/logo.png" alt="1" style="width:70px; height:70px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto fw-bold">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="peoples.php">friends</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="friends.php">peoples</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="notification.php">Notification</a>
                    </li>
                        <li class="nav-item ms-3">
                            <a class="navbar-brand" href="index.php"><img src="<?php if ($user["profile"] == "") {
                                                                                    echo "./img/user(2).png";
                                                                                } else {
                                                                                    echo $user['profile'];
                                                                                }; ?>" alt="1" style="width:35px; height:35px; border-radius:50%;"></a>
                        </li>
                    </ul>
                </div>


                <form action="" method="post">
                    <input type="submit" class="btn btn-danger ms-5" name="logout" value="Logout">

                </form>
            </div>
        </nav>