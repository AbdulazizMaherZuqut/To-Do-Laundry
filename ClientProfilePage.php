<?php
    $page_title = "Client Profile Page";
    include ("header.php");

    if(isset($_SESSION['id'])) {

        $e = $_SESSION['id'];
        $getUser = $db->query("SELECT * FROM clients WHERE id = '$e'");
        $info = $getUser->fetch();

        $name     = $info['NameOfClient'];
        $name_ar  = $info['nameOfClient_ar'];
        $email    = $info['Email'];
        $Phone    = $info['PhoneNumber'];
        $dateB    = $info['BirthdayDate'];
        $pass     = $info['Password'];

?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-5 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['My_Profile'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                        <b><label> <?= $t['Name_Of_Client'] ?> </label></b>
                        <p><input type="text" name="nameOfClient" value="<?= $name ?>"
                                  class="form-control" placeholder="<?= $t['Your_name'] ?>"><br>

                            <label> <?= $t['Name_Of_client_in_arabic'] ?> </label>
                            <input type="text" class="form-control" name="nameOfClient_ar" value="<?= $name_ar ?>"
                                   placeholder="<?= $t['Your_name'] ?>"><br>

                        <b><label> <?= $t['Email_Address'] ?> </label></b>
                        <input type="email" value="<?= $email ?>"
                               class="form-control" placeholder="<?= $t['Your_Email_Address'] ?>"><br>

                        <b><label> <?= $t['Phone_Number'] ?> </label></b>
                        <input type="tel" value="<?= $Phone ?>"
                               class="form-control" placeholder="<?= $t['Your_Phone_Number'] ?>"><br>

                        <b><label> <?= $t['Birth_Date'] ?> </label></b>
                        <input type="date" value="<?= $dateB ?>"
                               class="form-control" placeholder="<?= $t['Your_Birth_Date'] ?>"><br>

                        <b><label> <?= $t['Password'] ?> </label></b>
                        <input type="password" value=""
                               class="form-control" placeholder="<?= $t['Your_Password'] ?>"><br>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    } else {
        header('Location:login.php');
    }
include ("footer.php");

