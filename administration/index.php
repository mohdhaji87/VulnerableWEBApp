<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['delete'])) {
  $delete = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['delete']);
  $deleteUser = $users->deleteUserById($delete);
}

if (isset($deleteUser)) {
  echo $deleteUser;
}
if (isset($_GET['disable'])) {
  $disable = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['disable']);
  $disableId = $users->userDisableByAdmin($disable);
}

if (isset($disableId)) {
  echo $disableId;
}
if (isset($_GET['enable'])) {
  $enable = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['enable']);
  $enableId = $users->userEnableByAdmin($enable);
}

if (isset($enableId)) {
  echo $enableId;
}


 ?>
      <div class="card ">
        <div class="card-header">
          <h3><i class="fas fa-users mr-2"></i>Userlist <span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$username = Session::get('username');
if (isset($username)) {
  echo $username;
}
 ?></span>

          </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">#</th>
                      <th  class="text-center">Username</th>
                      <th  class="text-center">Email address</th>
                      <th  class="text-center">Status</th>
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $allUser = $users->selectAllUserData();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;

                     ?>

                      <tr class="text-center"
                      <?php if (Session::get("user_id") == $value->user_id) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                      >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->username; ?> <br>
                          <?php if ($value->role_id  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                        } elseif ($value->role_id == '2') {
                          echo "<span class='badge badge-lg badge-dark text-white'>User</span>";
                        } ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td>
                          <?php if ($value->isEnabled == '1') { ?>
                          <span class="badge badge-lg badge-info text-white">Active</span>
                        <?php }else{ ?>
                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                        <?php } ?>
                        </td>

                        <td>
                          <?php if ( Session::get("role_id") == '1') {?>
                            <a class="btn btn-info btn-sm " href="profile.php?user_id=<?php echo $value->user_id;?>">Edit</a>
                            <a onclick="return confirm('Are you sure you wish to delete this user?')" class="btn btn-danger
                    <?php if (Session::get("user_id") == $value->user_id) {
                      echo "deleted";
                    } ?>
                             btn-sm " href="?delete=<?php echo $value->user_id;?>">Delete</a>

                             <?php if ($value->isEnabled == '1') {  ?>
                               <a onclick="return confirm('Are you sure you wish to disable this user?')" class="btn btn-warning
                       <?php if (Session::get("user_id") == $value->user_id) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?disable=<?php echo $value->user_id;?>">Disable</a>
                             <?php } elseif($value->isEnabled == '0'){?>
                               <a onclick="return confirm('Are you sure you wish to enable this user?')" class="btn btn-secondary
                       <?php if (Session::get("user_id") == $value->user_id) {
                         echo "enabled";
                       } ?>
                                btn-sm " href="?enable=<?php echo $value->user_id;?>">Enable</a>
                             <?php } ?>
                        <?php }else{ ?>
                          <a class="btn btn-success btn-sm
                          " href="profile.php?user_id=<?php echo $value->user_id;?>">View</a>

                        <?php } ?>

                        </td>
                      </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td>No user availabe now !</td>
                    </tr>
                    <?php } ?>

                  </tbody>

              </table>









        </div>
      </div>



  <?php
  include 'inc/footer.php';

  ?>
