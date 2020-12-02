<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<?php
    require_once('db.php');

    $sql_ask = "SELECT * FROM ask_answer ORDER BY ask_answer.IDPost ASC";
    $sql_poster = "SELECT * FROM poster ORDER BY poster.IDPost ASC";
    if (isset($_GET["IDPost"])) {
        $idAsk = $_GET["IDPost"];
        $idPost = $_GET["IDPost"];
        $sql_poster .= " WHERE IDPost='$idPost'";
        $sql_ask .= " WHERE IDPost='$idAsk'";
    }

    $result_poster = $conn->query($sql_poster);
    $result_ask = $conn->query($sql_ask);
    while ($post=$result_poster->fetch_assoc() ) {
        while ($ask = $result_ask->fetch_assoc()) {

            if ($ask['IDPost'] == $post['IDPost']) {
            ?>
                <div class="post">
                <a class="card-title"><?= $ask['ID'] ?></a>
                <p class="card-text"><?= $ask['Content'] ?></p>
                </div>
            <?php
            } $ask['IDPost']++;print_r($ask);
        }$post['IDPost']++;


    }

?>




<form method="post" novalidate enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" id="idPost" name="idPost" value="<?=$idAsk = $ask['IDPost']?>">
        <input type="hidden" id="id" name="id" value="01">

        <label for="content"></label>
        <input type="text" id="content" name="content" value="" class="form-control" placeholder="Message">

    </div>

    <div class="form-group">
        <?php
        if (!empty($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
        ?>
        <button type="submit" class="btn btn-success">Send</button>
    </div>
</form>



