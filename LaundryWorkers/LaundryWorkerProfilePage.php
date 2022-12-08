<?php
    $page_title = "Laundry Worker Profile Page";
    include("header.php");

    if(isset($_SESSION['laundryworker_id'])) {

        $id = $_SESSION['laundryworker_id'];
        $getUser = $db->query("SELECT * FROM laundryworker WHERE id = '$id'");
        $info = $getUser->fetch();

        $nameOfLW     = $info['NameOfLaundryWorker'];
        $nameOfLW_ar  = $info['nameOflaundryworker_ar'];
        $emailOfLW    = $info['EmailOfLaundryWorker'];
        $phnumOfLW    = $info['PhoneNumOfLaundryWorker'];
        $birthOfLW    = $info['BirthdayDateOfLaundryWorker'];
        $passOfLW     = $info['Password'];

?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['My_Profile'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Name_Of_laundryWorker'] ?> </label></b>
                        <input type="text" name="nameOfLW" class="form-control" autocomplete="off"
                               value="<?= $nameOfLW ?>" required="required" placeholder="<?= $t['Your_name'] ?>">
                        <br>

                        <b><label> <?= $t['Name_Of_laundryWorker_in_arabic'] ?> </label></b>
                        <input type="text" name="nameOfLW" class="form-control" autocomplete="off"
                               value="<?= $nameOfLW_ar ?>" required="required" placeholder="<?= $t['Your_name'] ?>">
                        <br>

                        <b><label> <?= $t['Email_Address'] ?> </label></b>
                        <input type="email" name="emailOfLW" class="form-control" autocomplete="off"
                               value="<?= $emailOfLW ?>" required="required" placeholder="<?= $t['Your_Email_Address'] ?>">
                        <br>

                        <b><label> <?= $t['Phone_Number'] ?> </label></b>
                        <input type="tel" name="phnumOfLW" class="form-control" autocomplete="off"
                               value="<?= $phnumOfLW ?>" required="required" placeholder="<?= $t['Your_Phone_Number'] ?>">
                        <br>

                        <b><label> <?= $t['Birth_Date'] ?> </label></b>
                        <input type="date" name="birthOfLW" class="form-control" autocomplete="off"
                               value="<?= $birthOfLW ?>" required="required" placeholder="<?= $t['Your_Birth_Date'] ?>">
                        <br>

                        <b><label> <?= $t['Password'] ?> </label></b>
                        <input type="password" name="passOfLW" class="form-control" autocomplete="off"
                               value="" required="required" placeholder="<?= $t['Your_Password'] ?>">
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    } else {
        header('Location:LWlogin.php');
    }
include("footer.php");
?>