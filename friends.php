<?php
// session_start();
$pagename = 'friends';
require 'header.php';

$check = checkRequestdata();
$datas = getfriendsdata();
// $friends_datas = alreadyFriendsData();
// $new_array = [];
// // echo "<pre>";
// // print_r($friends_datas);
// // die;
// // data exists in friendlist not shown in friend suggestion
// foreach($datas as $data){
//     foreach($friends_datas as $friends_data){

//         if ($friends_data['user_id'] != $data['id']){
//             array_push($new_array,$data);
    
//         }

//     }
    
// }
//  echo "<pre>";
//  print_r($new_array);
//  die;




?>

        <div class="container">
            
                <div class="row" style="border:1px solid #0e918c ;">
                    <h2 class="py-4">friends suggesstion</h2>
                    <?php
                    foreach ($datas as $d) {
                        
                    ?>

                        <div class="col-md-1 person">

                            <img id="" class="my-4" style="height:50px; width:50px; border-radius:50%; border:1px solid grey" src=<?php if ($d["profile"] == "") {
                                                                                                                                        echo "./img/user(2).png";
                                                                                                                                    } else {
                                                                                                                                        echo $d['profile'];
                                                                                                                                    }; ?>>

                        </div>
                            <div class="info col-md-2">
                                <a href="friendprofile.php?fid=<?php echo $d['id']; ?>" class="link-primary" style="text-decoration:none ;">
                                    <h4><?php echo $d['first_name'] . " " . $d['last_name']; ?></h4>
                                </a>
                                <h6><?php echo $d['city']; ?></h6>
                            </div>
                            
                            <div class="request col-md-9">
                            <?php if(in_array($d["id"],$check)){
                                echo '<a href="#" class="me-2 text-decoration-none">request sent</a>';
                                echo  '<a href="?cid='.$d["id"].'" class="btn btn-danger">cancel</a>';
                            }
                            else{
                                
                                echo '<a href="?aid='. $d["id"].'" class="btn btn-success px-4">Add</a>';
                               
                            }
                            ?>
                               
                            </div>


                        

                    <?php
                    }

                    ?>
                </div>
            
        </div>
    </div>
                    
</body>

</html>