<?php
date_default_timezone_set('Asia/Kolkata');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "connection.php";
$error = "";
if (isset($_POST["signup"])) {
    // extract($_POST);

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dob), date_create($today));
    $age  = $diff->format('%y');
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "insert into users set first_name = '$firstname',
                                    last_name = '$lastname',
                                    username = '$username',
                                    email = '$email',
                                    dob = '$dob',
                                    passwords = '$hash',
                                    age = '$age'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    } else {
        $success = 1;
    }
}
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "select * from users where username = '$username'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    } else {
        if (mysqli_num_rows($execute) === 0) {
            $error = "Invalid Username / Password";
        } else {
            $result = mysqli_fetch_assoc($execute);
            
            $passcode = $result["passwords"];
            if (password_verify($password, $passcode)) {
                $_SESSION['sid'] = $result['id'];
                $query = 'select * from users where id = "'.$_SESSION["sid"].'" ';
                $execute = mysqli_query($conn,$query);
                if(!$execute) echo mysqli_error($conn);
                else{
                    $result = mysqli_fetch_assoc($execute);
                    if(!empty($result['mobile'])){
                        header("location:home.php");
                    }
                    else{

                        header("location:index.php");
                    }
                }
            } else {
                $error = "Password Error";
                // $result = alreadyupdated();
               
                
            }
        }
    }
}
// function alreadyupdated(){
//     global $conn;
//     $temp = [];
//     $query = 'select id from users where mobile is null';
//     $execute = mysqli_query($conn,$query);
//     while($results = mysqli_fetch_assoc($execute)){
//         array_push($temp,$results);
//     }
    
//     return $temp;
// }

function uploadPhoto($file)
{

    $directory = "profilephoto";
    $path = $directory . "/" . $file["profile"]["name"];
    $allowedext = ["jpg", "jpeg", "webp", "svg", "png"];
    $ext = pathinfo($file["profile"]["name"], PATHINFO_EXTENSION);
    if (!in_array($ext, $allowedext)) {
        echo "file type not supported";
    } else {
        if ($file["profile"]["size"] > 1048576) {
            echo "file size is too big.max 1 mb allowed";
        } else {
            if (!is_dir($directory)) {
                mkdir($directory);
            }
            if (move_uploaded_file($file["profile"]["tmp_name"], $path)) {
                return $path;
            }
        }
    }
}



if (isset($_POST["update"])) {

    $profile = uploadphoto($_FILES);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    // $mobilepattern = "/^[1-9][0-9]{10}$/" ; 
    if(!preg_match('/^[0-9]{10}$/',$phone)){
        // $errormobile ="enter valid number";
        header("location:index.php?phoneError=1");
        die;
    }
    $gender = $_POST["gender"];
    
    $city = $_POST["city"];
    $about = $_POST["about"];
    $id = $_SESSION['sid'];
    $profileHidden = $_POST['profileHidden'];
    $query = '';
    if (!empty($profile)) {
        $query = "update users set profile = '$profile', first_name = '$firstname',last_name = '$lastname',mobile = '$phone',";
    } else {

        $query = "update users set profile = '$profileHidden', first_name = '$firstname',last_name = '$lastname',mobile = '$phone',";
    }
    $query .= "gender = '$gender', city = '$city',about = '$about' where id='$id'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    } else {
        header("location:friends.php?sid='$id'");
    }
}


if (isset($_POST["logout"])) {
    unset($_SESSION["sid"]);
    session_destroy();
    header("location:register.php");
}

// for single data

function getData($id)
{
    global $conn;
    $query = "select * from users where id = '$id'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    } else {
        $result = mysqli_fetch_assoc($execute);
        //  echo "<pre>";
        //  print_r($result);
        //  die;
        return $result;
    }
}

// password reset
if (isset($_POST["forgot"])) {
    $email = $_POST["email"];
    $query = " select * from users where email = '$email'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    } else {
        if (mysqli_num_rows($execute) === 1) {
            $result = mysqli_fetch_assoc($execute);
            sendPasswordResetEmail($result);


            $message = 1;
        } else $error = "Email not registered";
    }
}


function sendPasswordResetEmail($user)
{
    $salt = bin2hex(random_bytes(30));
    $to = $user["email"];
    $name = $user["username"];
    $subject = "Password Reset Instructions";
    $headers = 'MIME-Version: 1.0 . "\r\n";
    Content-type: text/html; Charset: UTF-8' . "\r\n" .
        'From: rhlrathore94@gmail.com' . "\r\n" .
        'Reply-To: rhlrathore94@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $message = "Hello $name, please click on the link given below to reset your password. <a href='http://localhost/facebook/reset.php?salt=$salt&email=$to'>Reset Your Password</a>";

    // updateSalt($user["email"], $salt);
}
function updateSalt($email, $salt)
{
    global $conn;
    $query = "update users set salt = '$salt' where email ='$email'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    }
}
function checkSalt($salt)
{
    global $conn;
    $query = "select * from users where salt = '$salt'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) echo mysqli_error($conn);
    else {
        if (mysqli_num_rows($execute) === 1) {
            $result = mysqli_fetch_assoc($execute);
            return $result["email"];
        } else
            return false;
    }
}
//   for reset password
if (isset($_POST["reset"])) {
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $email = $_GET["email"];
    $bin = hex2bin($email);
    $query = "update users set passwords = '$hash' where email = '$bin'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        mysqli_error($conn);
    } else {
        if (mysqli_affected_rows($conn) === 1) {
            $change = 1;
        }
    }
}
// get data for friends list
function getfriendsdata()
{
    global $conn;
    $id = $_SESSION['sid'];
    $user = getData($_SESSION['sid']);
    $city = $user["city"];
    $gender = $user["gender"];
    $age = $user["age"];
    // $check = checkRequestdata();



    //     print_r($check);


    $query = "select * from users where not id ='$id' and not gender = '$gender' and city ='$city' and not users.id in (select reciever from friendlist where  sender = '$id')";
    $execute = mysqli_query($conn, $query);


    $records = [];

    if (!$execute) {
        echo (mysqli_error($conn));
    } else {
        if (mysqli_num_rows($execute) == 0) {
            $query = "select * from users where not id ='$id' and not gender = '$gender' and not users.id in (select reciever from friendlist where  sender = '$id')";
            $execute = mysqli_query($conn, $query);
        }
        while ($results = mysqli_fetch_assoc($execute)) {

            array_push($records, $results);
        };
    }

    return $records;
}
// for already friends

// function alreadyFriendsData(){
//     global $conn;
//     $friend = [];
//     $id = $_SESSION['sid'];
//     $query = "select * from friendlist where sender = '$id'";
//     $execute = mysqli_query($conn, $query);
//     while ($results = mysqli_fetch_assoc($execute)) {

//         array_push($friend, $results);
//     };
//     // echo "<pre>";
//     // print_r($friend);
//     // die;
//     return $friend;
// }
// for check if request sent
function checkRequestdata()
{
    global $conn;
    $check = [];
    $id = $_SESSION['sid'];
    $query1 = "select receiverid from friendrequest where senderid = '$id'";
    $executecheck = mysqli_query($conn, $query1);
    while ($results = mysqli_fetch_assoc($executecheck)) {

        array_push($check, $results['receiverid']);
    };
    return $check;
}


// for friend request add


if (isset($_GET["aid"])) {
    $sender_id = $_SESSION['sid'];
    $receiver_id = $_GET['aid'];
    $date = date("y-m-d h-i-s");



    $query = "insert into friendrequest 
        set senderid ='$sender_id',
        receiverid = '$receiver_id',
        requestdate = '$date' ";

    $execute = mysqli_query($conn, $query);
    // }
    if (!$execute) mysqli_error($conn);
    else {

        header("location:friends.php");
        // $key = array_search('deepika', array_column($records, 'first_name'));
        // echo 'Key: ' . $key;
        //  die;

    }
}
// for friend request cancle
if (isset($_GET["cid"])) {
    $id = $_GET['cid'];
    $query = "delete from friendrequest where receiverid = '$id'";
    $execute = mysqli_query($conn, $query);
    // }
    if (!$execute) mysqli_error($conn);
    else {
    }
}


//friend request data////


function friendRequestData()
{
    global $conn;
    $id = $_SESSION['sid'];
    $results = [];
    $query = "select users.id,users.profile,users.first_name,users.last_name from users INNER JOIN friendrequest ON 
                users.id = friendrequest.senderid where friendrequest.receiverid = '$id'";
    $execute = mysqli_query($conn, $query);
    // }
    if (!$execute) mysqli_error($conn);
    else {
        while (
            $result = mysqli_fetch_assoc($execute)
        ) {
            array_push($results, $result);
        }
        return $results;
    }
}


if (isset($_GET['acceptid'])) {
    $id = $_GET['acceptid'];
    $userid = $_SESSION['sid'];
    $query = "delete from friendrequest where senderid = '$id'";
    $execute = mysqli_query($conn, $query);

    if (!$execute) mysqli_error($conn);
    else {
        $query = "insert into friendlist set reciever = '$userid',sender = '$id'";
        $execute = mysqli_query($conn, $query);
        if (!$execute) mysqli_error($conn);
        else {
            $query = "insert into friendlist set reciever = '$id',sender = '$userid'";
            $execute = mysqli_query($conn, $query);
            header("location:notification.php");
        }
    }
}
if (isset($_GET['rejectid'])) {
    $id = $_GET['rejectid'];
    $query = "delete from friendrequest where senderid = '$id'";
    $execute = mysqli_query($conn, $query);
    // }
    if (!$execute) mysqli_error($conn);
    else {
    }
}


function getfriends($id)
{
    
    global $conn;
    $array = [];
    $query = "select * from users inner join friendlist on users.id = friendlist.reciever where friendlist.sender = '$id'";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        echo mysqli_error($conn);
    } else {
        while($result = mysqli_fetch_assoc($execute)){
            array_push($array,$result);
        }
        return $array;
        // $result = mysqli_fetch_assoc($execute);
       
    }
}
// for post update
if(isset($_POST['post'])){
    $post = $_POST['posts'];
    $id = $_SESSION['sid'];
    $date = date("y-m-d H-i-s");
    $post_photo =uploadPostphoto($_FILES);
    if(!empty($post_photo) && !empty($post)){
        $query = "insert into posts set post_id='$id',post ='$post',post_date='$date',post_photo='$post_photo'";

        $execute = mysqli_query($conn,$query);
        if(!$execute)mysqli_error($conn);
        else{
            header("location:home.php");
        }
    }
    else if(empty($post_photo) && !empty($post)){
        $query = "insert into posts set post_id='$id',post ='$post',post_date='$date'";

        $execute = mysqli_query($conn,$query);
        if(!$execute)mysqli_error($conn);
        else{
            header("location:home.php");
        }
    }
    
    else
       if(empty($post_photo) && empty($post)){
        $error ="please add post";
       }
       else{

        $error = "file size is too big or file type not supported( max-1mb size,only png,jpg,jpeg,webp,svg image supported.";
       }
        // echo $error;
        // header("location:home.php?imgerr=1");
    
}
// for post data display
function getpostdata(){
    global $conn;
    $id = $_SESSION['sid'];

    // $query = 'select users.id ,users.first_name,users.last_name,users.profile,posts.post_date,
    // posts.post, posts.post_photo from posts inner join users on posts.post_id = users.id   order by posts.post_date desc';
    $query = "select users.first_name,users.last_name,posts.post_date,friendlist.reciever,posts.post,posts.post_photo from posts 
            inner join users on users.id = posts.post_id inner join friendlist on posts.post_id = friendlist.reciever
            where friendlist.sender = '$id' or friendlist.reciever='$id' order by posts.post_date desc";
    $execute = mysqli_query($conn,$query);
    if(!$execute)mysqli_error($conn);
    else{
        
    }
    return $execute;
}
// for photo post data;
function uploadPostPhoto($file)
{
    // echo"<pre>";
    // print_r($file) ;
    // die;

    $directory = "uploadpost";
    $path = $directory . "/" . $file["postphoto"]["name"];
    $allowedext = ["jpg", "jpeg", "webp", "svg", "png",];
    $ext = pathinfo($file["postphoto"]["name"], PATHINFO_EXTENSION);
    if (!in_array($ext, $allowedext)) {
        $error= "file type not supported";
    } else {
        if ($file["postphoto"]["size"] > 1048576) {
             $error ="file size is too big.max 1 mb allowed";
            //  echo $filebig;
            //  die;
        } else {
            if (!is_dir($directory)) {
                mkdir($directory);
            }
            if (move_uploaded_file($file["postphoto"]["tmp_name"], $path)) {
                return $path;
            }
        }
    }
}