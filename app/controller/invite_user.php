<?php
require_once('db.php');

$error = '';
$email_invite = '';
$name_invite = '';
if (isset($_POST['name_invite']) && isset($_POST['email_invite']) )
{

    $name_invite = $_POST['name_invite'];
    $email_invite = $_POST['email_invite'];

    if (empty($email)) {
        $error = 'Please input email you want to invite ';
    }
    else {
        echo "OKE";
        invite_user($name_invite,$email_invite);
    }

}
?>
<form method="post">
    <div class="modal-header">
        <h4 class="modal-title">Invite user</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="<?= $email_invite ?>" name="email_invite" placeholder="name@example.com" class="form-control" id="email_invite"/>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" value="invite">
        <button type="submit" value="<?= $email_invite = 'gv' ?>" name="name_invite" id="name_invite"  class="btn btn-success" >Invite Teacher</button>
        <button type="submit" value="<?= $email_invite = 'st' ?>" name="name_invite" id="name_invite" class="btn btn-success" >Invite Student</button>
    </div>
</form>

