<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
  <title>People</title>
</head>
<body>


  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
      aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <a class="navbar-brand" href="#">
      <img src="https://img.icons8.com/plasticine/2x/google-classroom.png" width="50" height="50" class="d-inline-block "
        alt="">
      Classroom
    </a>
  
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="./intoClass.php">Luồng</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./people.php">Mọi người</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="./discuss.php">Thảo luận</a>
            </li>
        </ul>
    </div>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="fas fa-sign-out-alt"></span> Logout</a></li>
    </ul>
  </nav>


  <?php
    require_once('../base/db.php');
    $email = '';
    $name = '';
    $message = '';
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if ($action == 'invite' && isset($_POST['name']) && isset($_POST['email'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            if (empty($email)) {
                $error = 'Please input email you want to invite ';
            }
            else {
                $result=invite_user($name,$email);
                if ($result['code']==0){
                    $message = 'Invite success.';
                }else if ($result['code']==1){
                    $error = 'This email already exits';
                }else{
                    $error = 'An error occured. Please try again later';
                }
            }
        }else if ($action == 'delete' && isset($_POST['name']) && isset($_POST['email'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            if (empty($email)) {
                $error = 'Please input email you want to kick out ';
            }
            else {
                $message = 'Kick out success';
                kick_user($name,$email);
            }
        }else{
            //nothing..
        }
    }

  ?>

  <!--body-->
  <div class="container mt-3">
      <div class="row">
          <div class="col-10">
              <div class="d-flex justify-content-between mt-2 text-success ">
                  <h3 >Teacher</h3>
              </div>
              <hr>
              <div class="card-deck teacher">
                  <?php
                  $sql_user= "SELECT * FROM user_class where ID = 'gv' and active = 1";
                  $result_gv = $conn->query($sql_user);
                  while ($post=$result_gv->fetch_assoc()) {
                  ?>
                  <div class="card">
                      <div class="card-body">
                          <a class="card-title"><?= $post['email'] ?></a>
                      </div>
                  </div>
                  <?php
                  }
                  ?>
              </div>
              <div class="d-flex justify-content-between mt-4 text-success ">
                  <h3 >Student</h3>
              </div>
              <hr>
              <div class="card-deck student">
                  <!--Card Student ID-->
                  <?php
                  $sql_user= "SELECT * FROM user_class where ID = 'st' and active = 1";
                  $result_st = $conn->query($sql_user);
                  while ($post=$result_st->fetch_assoc()) {
                  ?>
                  <div class="card">
                      <div class="card-body">
                          <a class="card-title"><?= $post['email'] ?></a>
                      </div>
                  </div>
                      <?php
                  }
                  ?>
                  <!--end card-->
              </div>
          </div>

          <div class="col-2">
                <button name="submit"  type="button" class="btn btn-outline-success fas fa-plus" data-toggle="modal" data-target="#new-user-dialog"> Invite</button>
                <button type="button" class="btn btn-outline-danger fas fa-user-slash mt-3" data-toggle="modal" data-target="#confirm-delete"> Delete</button>
              <div class="error mt-3">
                  <?php
                  if (!empty($error)) {
                      echo "<div class='alert alert-danger text-center'>$error</div>";
                  }else if(!empty($message)){
                      echo "<div class='alert alert-success text-center'>$message</div>";
                  }else{
                      //nothing
                  }
                  ?>
              </div>

          </div>
      </div>
  </div>



    <!-- New user dialog -->
    <div class="modal fade" id="new-user-dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <form method="post">
                  <div class="modal-header">
                      <h4 class="modal-title">Invite user</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" value="<?= $email ?>" name="email" placeholder="name@example.com" class="form-control" id="email"/>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" name="action" value="invite">
                      <button type="submit" value="<?= $name = 'gv' ?>" name="name"  class="btn btn-success" >Invite Teacher</button>
                      <button type="submit" value="<?= $name = 'st' ?>" name="name"  class="btn btn-success" >Invite Student</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
    <!-- Delete dialog -->
    <div class="modal fade" id="confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete user</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="<?= $email ?>" name="email" placeholder="name@example.com" class="form-control" id="email"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <label >Who you want to kick out ?</label>
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" value="<?= $name = 'gv'?>" name="name" class="btn btn-danger">Teacher</button>
                        <button type="submit" value="<?= $name = 'st'?>" name="name" class="btn btn-danger">Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>