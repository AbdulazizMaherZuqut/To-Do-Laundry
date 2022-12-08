<?php

    include("header.php");
    $page_title = "Driver Profile Page";

    if(isset($_SESSION['driver_id'])) {

        $id = $_SESSION['driver_id'];
        $getUser = $db->query("SELECT * FROM drivers WHERE id = '$id'");
        $info = $getUser->fetch();

        $nameOfD    = $info['nameOfDriver'];
        $nameOfD_ar = $info['nameOflDriver_ar'];
        $emailOfD   = $info['EmailOfDriver'];
        $phnumOfD   = $info['PhoneNumOfDriver'];
        $birthOfD   = $info['BirthDayDateOfDriver'];
        $passOfD    = $info['Password'];

?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['My_Profile'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Name_Of_Driver'] ?></label></b>
                        <input type="text" name="nameOfD" class="form-control" autocomplete="off"
                               value="<?= $nameOfD ?>" required="required" placeholder="<?= $t['Your_name'] ?>">
                        <br>

                        <b><label> <?= $t['Name_Of_driver_in_arabic'] ?></label></b>
                        <input type="text" name="nameOfD_ar" class="form-control" autocomplete="off"
                               value="<?= $nameOfD_ar ?>" required="required" placeholder="<?= $t['Your_name'] ?>">
                        <br>

                        <b><label> <?= $t['Email_Address'] ?> </label></b>
                        <input type="email" name="emailOfD" class="form-control" autocomplete="off"
                               value="<?= $emailOfD ?>" required="required" placeholder="<?= $t['Your_Email_Address'] ?>">
                        <br>

                        <b><label> <?= $t['Phone_Number'] ?> </label></b>
                        <input type="tel" name="phnumOfD" class="form-control" autocomplete="off"
                               value="<?= $phnumOfD ?>" required="required" placeholder="<?= $t['Your_Phone_Number'] ?>">
                        <br>

                        <p><b><label> <?= $t['Birth_Date'] ?> </label></b></p>
                        <input type="date" name="birthOfD" class="form-control" autocomplete="off"
                               value="<?= $birthOfD ?>" required="required" placeholder="<?= $t['Your_Birth_Date'] ?>">
                        <br>

                        <b><label> <?= $t['Password'] ?> </label></b>
                        <input type="password" name="passOfD" class="form-control" autocomplete="off"
                               value="" required="required" placeholder="<?= $t['Your_Password'] ?>">
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    } else {
        header('Location:Dlogin.php');
    }
include("footer.php");
