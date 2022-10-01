<?php
$pagename = "home";
require "header.php";
$data = getpostdata();

?>
<div class="container-fluid " style="background:#c4ddff;">
    <div class="row ">
        <div class="col-md-3">

        </div>
        <div class="col-md-6 border border-dark bg-white" style="height:auto ;">
            <div class="border rounded mt-4 mb-5 px-3" style="background:#e8eaee;">
                <form action="" method='post' class="form" enctype="multipart/form-data">
                    <div class="my-2  d-flex align-items-center">
                        <img src="<?php echo $user['profile'] ?>" alt="" class="img-fluid me-2" style="width: 40px; height:40px; border-radius:50%;">

                        <textarea type="text" id="" rows="3" placeholder="Share what's on your mind!" class="form-control border-0 me-2" style="resize: none;" name="posts"></textarea>
                        
                        <input type="submit" value="Post" name="post" disabled class="btn post btn-primary form-group">

                    </div>
                    <div class="d-flex align-items-center" >
                    <div class="mb-3 ms-5" style="width:60px;height:60px;position:relative;">
                        <input type="file" name="postphoto" id="" style="cursor:pointer;opacity:0 ; width:100%;height:100% ;position:absolute;top:0;left:0;">
                        <img src="./img/upload.png" id="uploadPreview" alt="" class="rounded" style="width:100%;height:100%;">
                    </div>
                        <?php
                        if(!empty($error)) echo "<h6 class ='text-danger ms-2'>".$error."</h6>";
                       
                                                 ?>
                    </div>
                </form>
            </div>
            <?php
            while ($d = mysqli_fetch_assoc($data)) {
            ?>
                <div class="mx-5">
                    <div class="d-flex align-items-center mb-2">
                        <img style="width:30px; height:30px; border-radius:50%;" class="img-fluid" src="<?php if (empty($d['profile'])) {
                                                                                                            echo "./img/user(2).png";
                                                                                                        } else {
                                                                                                            echo $d['profile'];
                                                                                                        } ?>">
                        <a href="friendprofile.php" class="text-decoration-none ms-2">
                            <h6><?php echo $d['first_name']." " . $d['last_name'] ?></h6>
                        </a>
                    </div>
                    <div class="border rounded mb-3 px-3" style="background:#e8eaee;">
                        <p class="py-2"><?php echo $d['post'] ?></p>
                        <?php
                        if (($d['post_photo'] !== null)) echo "<img src=' " . $d['post_photo'] . "'style='width:350px;height:350px;' class='img-fluid' >";
                        ?>
                        <p class="text-success mt-2" style="font-size: 10px;"><?php
                                                                                $date = $d['post_date'];
                                                                                $lattestDate = date("y-m-d H:i:s");
                                                                                $diff = date_diff(date_create($lattestDate), date_create($date));
                                                                                // echo $diff;
                                                                                // die;
                                                                                $minute =  $diff->format('%i');
                                                                                $hour =  $diff->format('%h');
                                                                                $day =  $diff->format('%d');
                                                                                // echo $minute ."<br>";
                                                                                // echo $hour ."<br>";
                                                                                // echo $day;



                                                                                if ($hour == 0) {
                                                                                    echo $minute . ' minutes ago';
                                                                                } else {
                                                                                    if ($day == 0) {
                                                                                        echo $hour . ' hours ago';
                                                                                    } else {
                                                                                        if ($day <= 7)
                                                                                            echo $day . ' days ago';
                                                                                        else {
                                                                                            echo $date;
                                                                                        }
                                                                                    }
                                                                                }





                                                                                ?></p>


                    </div>

                </div>


            <?php
            }
            ?>


        </div>
        <div class="col-md-3"></div>


    </div>
</div>






</div>
<script>
    let img = document.querySelector('#uploadPreview');
    let input = document.querySelector("input[type=file]");
    let button = document.querySelector(".post");
    let textarea = document.querySelector("textarea");
    console.log(button);

    input.addEventListener('change', (event) => {
        console.log(event);
        img.setAttribute("src", URL.createObjectURL(event.target.files[0]));
        button.disabled=false;
    })
    textarea.addEventListener('keyup', () => {
        if(textarea.length !== 0)
       button.disabled=false; 
       
    })
</script>
</body>

</html>