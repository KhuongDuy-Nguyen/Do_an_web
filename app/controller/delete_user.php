<?php
require_once('db.php');

$error = '';
$email = '';
$name = '';
$message = '';
if (isset($_POST['name']) && isset($_POST['email']))
{

    $name = $_POST['name'];
    $email = $_POST['email'];

    if (empty($email)) {
        $error = 'Please input email you want to kick out ';
    }
    else {
        $message = 'Kick out success';
        kick_user($name,$email);
    }

}
?>
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
        <button type="submit" value="<?= $name = 'gv'?>" name="name" id="name" class="btn btn-danger">Teacher</button>
        <button type="submit" value="<?= $name = 'st'?>" name="name" id="name" class="btn btn-danger">Student</button>
    </div>
</form>
<?php
if (!empty($error)) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
}
?>
