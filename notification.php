<?php
// session_start();
$pagename = 'notification';
require 'header.php';

$data = friendRequestData();
// echo '<pre>';
// print_r($data);
// die;
?>

<div class="container">
            
                <div class="row" style="border:1px solid #0e918c ;">
                    <h2 class="py-4">friends Requests</h2>
                    <?php
                    foreach ($data as $d) {
                        
                    ?>

                        <div class="col-md-1 person d-flex align-items-center">

                            <img id="" class="my-4" style="height:50px; width:50px; border-radius:50%; border:1px solid grey" src=<?php if ($d["profile"] == "") {
                                                                                                                                        echo "./img/user(2).png";
                                                                                                                                    } else {
                                                                                                                                        echo $d['profile'];
                                                                                                                                    }; ?>>

                        </div>
                            <div class="info col-md-2 d-flex align-items-center">
                                <a href="friendprofile.php?fid=<?php echo $d['id']; ?>" class="link-primary" style="text-decoration:none ;">
                                    <h4><?php echo $d['first_name'] . " " . $d['last_name']; ?></h4>
                                </a>

                            </div>
                            
                            <div class="request col-md-9 d-flex align-items-center">
                            <?php
                                echo '<a href="?acceptid='.$d["id"].'" class="btn btn-primary mx-2">Accept</a>';
                                echo '<a href="?rejectid='. $d["id"].'" class="btn btn-success px-4">Reject</a>';
                            
                           
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

