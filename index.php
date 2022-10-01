<?php
$pagename = 'index';
require 'header.php';

// session_start();


$data = getData($_SESSION['sid']);

?>




    <div class="section1" style="background-color: #C4DDFF;">
        <div class="container">
            <form action="" method="post" class="form" enctype="multipart/form-data">
                <div class="row p-5">
                    <div class="col-md-3 offset-md-1 px-3" style="background-color:#F2F2F2; height:100%;">
                        <div class="form-group my-3 d-flex flex-column align-items-center">
                            <h3 class="my-4 fw-bold"><?php echo $data['username']; ?></h3>

                            <img id="uploadPreview" class="my-4" style="height:200px; width:200px; border-radius:50%; border:1px solid grey" src="<?php if (empty($data["profile"])) {
                                                                                                                                                        echo "./img/user(2).png";
                                                                                                                                                    } else {
                                                                                                                                                        echo $data['profile'];
                                                                                                                                                    }; ?>">
                            <label class="btn btn-danger" style="position:relative; cursor:pointer;" for="input">Upload Your Photo
                                <input type="file" id="input" value="" name="profile" class="" style="opacity:0; position:absolute; top:0; left:0; height:100%; width:100%;cursor:pointer; z-index:1;">
                                <input type="hidden" name="profileHidden" value="<?php echo $data['profile'];?>">
                            </label>

                        </div>
                    </div>
                    <div class="col-md-5 ms-5 px-5 py-3" style="background-color:#F2F2F2;">
                        <div class="form-group my-3">
                            <label for="">first Name</label>
                            <input type="text" value="<?php echo $data['first_name']; ?>" name="firstname" class="form-control">
                        </div>
                        <div class="form-group my-3">
                            <label for="">Last Name</label>
                            <input type="text" value="<?php echo $data['last_name']; ?>" name="lastname" class="form-control">
                        </div>
                        <div class="form-group my-3">
                            <label for="">Email</label>
                            <input type="email" value="<?php echo $data['email']; ?>" name="email" readonly class="form-control">
                        </div>
                        <div class="form-group my-3">
                            <label for="">Phone</label>
                            <input type="number" value="<?php echo $data['mobile']; ?>" name="phone" class="form-control" style=" -moz-appearance: textfield">
                            <?php if(isset($_GET['phoneError']))echo "<p class='mt-1 text-danger'>please enter valid number</p>";
                            ?>
                        </div>
                        <div class="form-group my-3">
                            <label class="mb-3">Gender</label><br>
                            <label for="" class="">Male</label>
                            <input type="radio" value="male" <?php if ($data['gender'] === 'male') echo "checked"; ?> name="gender" class="me-5">
                            <label>Female</label>
                            <input type="radio" value="female" <?php if ($data['gender'] === 'female') echo "checked"; ?> name="gender" class="">
                        </div>
                        <div class="form-group my-3">
                            <label for="">Age</label>
                            <input type="number" value="<?php echo $data['age']; ?>" name="age" class="form-control" readonly style=" -moz-appearance: textfield">
                        </div>
                        <div class="form-group my-3">
                            <label for="">City</label>
                            <input type="text" value="<?php echo $data['city']; ?>" name="city" class="form-control">
                        </div>
                         <div class="form-group my-3">
                            <label for="">About us</label>
                            <textarea name="about" id="textarea" cols="45" rows="5"><?php echo $data['about'];?></textarea>
                         </div>                                                                                                                           

                        <div class="form-group my-3">
                            <input type="submit" value="Update" name="update" class="btn btn-success">
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
        let img = document.querySelector('#uploadPreview');
        let input = document.querySelector("input[type=file]");
        console.log(input);

        input.addEventListener('change', (event) => {
            console.log(event);
            img.setAttribute("src", URL.createObjectURL(event.target.files[0]));
        })
        // for friends list
    </script>
</body>

</html>