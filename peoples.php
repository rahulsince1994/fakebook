<?php
$pagename = 'myfriends';
require 'header.php';
// echo $_SESSION['sid'];
// die;
$datas = getfriends($_SESSION['sid']);
// echo '<pre>';
// print_r($datas);
// // die;
?>

<div class="container">
            
                <div class="row" style="border:1px solid #0e918c ;">
                    <h2 class="py-4">friends</h2>
                    <?php
                    foreach ($datas as $d) {
                        
                    ?>

                        <div class="col-md-1 person d-flex align-items-center">

                            <img id="" class="my-4" style="height:50px; width:50px; border-radius:50%; border:1px solid grey" src=<?php if ($d['profile'] == "") {
                                                                                                                                        echo "./img/user(2).png";
                                                                                                                                    } else {
                                                                                                                                        echo $d['profile'];
                                                                                                                                    } ?>>

                        </div>
                            <div class="info col-md-2 d-flex flex-column justify-content-center">
                                <a href="friendprofile.php?fid=<?php echo $d['id']; ?>" class="link-primary" style="text-decoration:none ;">
                                    <h4><?php echo $d['first_name'] . " " . $d['last_name']; ?></h4>
                                </a>
                                <h6><?php echo $d['city']; ?></h6>
                            </div>
                            <div class='messagebox col-md-9 d-flex align-items-center'>
                                <a href="" class=''>
                                     <img src='img/messenger.png' class="img-fluid" style="height:30px; width:30px;">
                                </a>
                            </div>
                            
                    <?php
                    }

                    ?>
                </div>
            
        </div>
    </div>
                    
</body>

</html>

