<?php
    $page_title = "Edit Profile Page";
    include ("header.php");

    if(isset($_SESSION['driver_id'])){

    $id = $_SESSION['driver_id'];
    $getUser = $db->query("SELECT * FROM drivers WHERE id='$id'");
    $info = $getUser->fetch();

    $nameOfDriver        = $info['nameOfDriver'];
    $nameOfDriver_ar     = $info['nameOflDriver_ar'];
    $emailOfDriver       = $info['EmailOfDriver'];
    $phoneNumberOfDriver = $info['PhoneNumOfDriver'];
    $birthDdOfDriver     = $info['BirthDayDateOfDriver'];
    $passOfDriver        = $info['Password'];

    if (isset($_POST['edit'])) {

        $nameOfDriver        = $_POST['nOfDriver'];
        $nameOfDriver_ar     = $_POST['nOfDriver_ar'];
        $emailOfDriver       = $_POST['eOfDriver'];
        $phoneNumberOfDriver = $_POST['phNberOfDriver'];
        $birthDdOfDriver     = $_POST['bDdOfDriver'];
        $passOfDriver        = md5($_POST['pOfDriver']);

        $res = $info['id'];
        if ($res === $id) {
            $update = $db->query("UPDATE drivers SET nameOfDriver='$nameOfDriver',nameOflDriver_ar='$nameOfDriver_ar',
                   EmailOfDriver='$emailOfDriver',PhoneNumOfDriver='$phoneNumberOfDriver',BirthDayDateOfDriver='$birthDdOfDriver',
                   Password='$passOfDriver' WHERE id='$id'");
        }
    }
?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['Edit_My_Profile'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Name_Of_Driver'] ?> </label></b>
                        <input type="text" name="nOfDriver" class="form-control" autocomplete="off"
                               value="<?= $nameOfDriver ?>" required="required" placeholder="<?= $t['Your_name'] ?>">
                        <br>

                        <b><label> <?= $t['Name_Of_driver_in_arabic'] ?> </label></b>
                        <input type="text" name="nOfDriver_ar" class="form-control" autocomplete="off"
                               value="<?= $nameOfDriver_ar ?>" required="required" placeholder="<?= $t['Your_name'] ?>">
                        <br>

                        <b><label> <?= $t['Email_Address'] ?>  </label></b>
                        <input type="email" name="eOfDriver" class="form-control" autocomplete="off"
                               value="<?= $emailOfDriver ?>" required="required" placeholder="<?= $t['Your_Email_Address'] ?>">
                        <br>

                        <b><label> <?= $t['Phone_Number'] ?> </label></b>
                        <input type="tel" name="phNberOfDriver" class="form-control" autocomplete="off"
                               value="<?= $phoneNumberOfDriver ?>" required="required" placeholder="<?= $t['Your_Phone_Number'] ?>">
                        <br>

                        <p><b><label> <?= $t['Birth_Date'] ?> </label></b></p>
                        <input type="date" name="bDdOfDriver" class="form-control" autocomplete="off"
                               value="<?= $birthDdOfDriver ?>" required="required" placeholder="<?= $t['Your_Birth_Date'] ?>">
                        <br>

                        <b><label> <?= $t['Password'] ?> </label></b>
                        <input type="password" name="pOfDriver" class="form-control" autocomplete="off"
                               value=""  placeholder="<?= $t['Your_Password'] ?>">
                        <br>

                        <b><input type="submit" name="edit" class="btn btn-primary btn-block" value="<?= $t['Edit'] ?>" ></b>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    } else {
        echo "<script> window.location.href= 'Dlogin.php';</script>";
    }
include ("footer.php");
?>