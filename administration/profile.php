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
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
              </div>

           <?php if (Session::get("role_id") == '1') { ?>

              <div class="form-group
              <?php if (Session::get("role_id") == '1' && Session::get("user_id") == $getUinfo->user_id) {
                echo "d-none";
              } ?>
              ">

              </div>

          <?php }else{?>
            <input type="hidden" name="role_id" value="<?php echo $getUinfo->role_id; ?>">
          <?php } ?>

              <?php if (Session::get("user_id") == $getUinfo->user_id) {?>


              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <a class="btn btn-primary" href="changepass.php?user_id=<?php echo $getUinfo->user_id;?>">Password change</a>
              </div>
            <?php } elseif(Session::get("role_id") == '1') {?>

              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Update</button>

              </div>

              <?php   }else{ ?>
                  <div class="form-group">

                    <a class="btn btn-primary" href="index.php">Ok</a>
                  </div>
                <?php } ?>


          </form>
        </div>

      <?php }else{

        header('Location:index.php');
      } ?>



      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
