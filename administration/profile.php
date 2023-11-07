<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<?php

if (isset($_GET['user_id'])) {
  $user_id = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['user_id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByIdInfo($user_id, $_POST);

}
if (isset($updateUser)) {
  echo $updateUser;
}




 ?>

 <div class="card ">
   <div class="card-header">
          <h3>User Profile <span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
        </div>
        <div class="card-body">

    <?php
    $getUinfo = $users->getUserInfoById($user_id);
    if ($getUinfo) {






     ?>


          <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
              <div class="form-group">
                <label for="avatar">Avatar</label>
                <p><img src="../avatars/<?php echo $getUinfo->avatar_id; ?>" ></p>
                <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
                <input type="file" name="pictures" accept="image/*"/>
                <input type="submit" value="upload"/>
                </form>

                <?php
              require_once  "../bulletproof.php";
              
              $image = new Bulletproof\Image($_FILES);
              
              // To provide a name for the image. If unused, image name will be auto-generated.
              //$image->setName('test');
              
              // To set the min/max image size to upload (in bytes)
              $image->setSize(1000, 10000);
              
              // To define a list of allowed image types to upload
              $image->setMime(array('jpeg', 'jpg', 'gif'));
              
              // To set the max image height/width to upload (limit in pixels)
              $image->setDimension(128, 128);
              
              // To create a folder name to store the uploaded image, with optional chmod permission
              $image->setStorage("../avatars", 0666);
              
              //$image->setName("test")
              //      ->setMime(["gif"])
              //      ->setStorage(__DIR__ . "/avatars", 0666);
              
              if($image["pictures"]){
                $upload = $image->upload();
                if($upload){
                  echo "Profile picture successfully uploaded";
                }else{
                    echo $image->getError();
                }
              }
              ?>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
              </div>

          <?php }else{?>
            <input type="hidden" name="role_id" value="<?php echo $getUinfo->role_id; ?>">
          <?php }?>
              
              <?php if (Session::get("roleid") == '1') {?>

              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Password change</a>
              </div>
          
      <?php }else{

        header('Location:index.php');
      } ?>



      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
