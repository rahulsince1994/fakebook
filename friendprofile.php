<?php
// session_start();
$pagename = 'friendprofile';
require 'header.php';

$data = getdata($_GET["fid"]);
$user = getData($_SESSION['sid']);
?>

        <div class="container">
            <div class="row p-5">
                <div class="col-md-3 offset-md-1 px-3" style="background-color:#F2F2F2; height:100%;">
                    <div class="form-group my-3 d-flex flex-column align-items-center">
                        <h3 class="my-4 fw-bold"><?php echo $data['first_name']." ".$data['last_name']; ?></h3>

                        <img id="uploadPreview" class="my-4 img-fluid" style="height:200px; width:200px; border-radius:50%; border:1px solid grey" src="<?php if (empty($data["profile"])) {
                                                                                                                                                    echo "./img/user(2).png";
                                                                                                                                                } else {
                                                                                                                                                    echo $data['profile'];
                                                                                                                                                }; ?>">
                        <div class='about'>
                            <h5><?php echo 'Age: '. $data['age'];?></h5>                                                                                                                      
                            <h5><?php echo 'City: '.$data['city'];?></h5>                                                                                                                      
                            <h6><?php echo  'About: '.$data['about'];?></h6>
                         </div>                                                                                                                          
                    </div>
                </div>
            </div>
</body>

</html>