<?php
    include ('header.php');
    $page_title = "Admin Profile Page";

    if (isset($_SESSION['admin_id'])) {

        $e = $_SESSION['admin_id'];
        $getUser = $db->query("SELECT * FROM admins WHERE id = '$e'");
        $info = $getUser->fetch();

        $nameOfA            = $info['nameOfAdmin'];
        $nameOfAdmin_ar     = $info['nameOfAdmin_ar'];
        $emailOfA           = $info['EmailOfAdmin'];
        $phoneNumOfA        = $info['PhoneNumOfAdmin'];
        $birthDDOOfA        = $info['BirthdaydateOfAdmin'];

?>

    <div class="row" style="margin-top: 50px;">

        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['My_Profile'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <label> <?= $t['Name_Of_Admin'] ?> </label>
                        <input type="text" name="nameOfA" class="form-control" autocomplete="off"
                               value="<?= $nameOfA ?>" required="required" placeholder="<?= $t['Your_name'] ?>"><br/>

                        <b><label> <?= $t['Name_Of_admin_in_arabic'] ?> </label></b>
                        <input type="text" class="form-control" name="nameOfAdmin_ar" value="<?= $nameOfAdmin_ar ?>"
                               required="required" placeholder="<?= $t['Your_name'] ?>"><br>

                        <label> <?= $t['Email_Address'] ?> </label>
                        <input type="email" name="emailOfA" class="form-control" autocomplete="off"
                               value="<?= $emailOfA ?>" required="required" placeholder="<?= $t['Your_Email_Address'] ?>"><br/>

                        <label> <?= $t['Phone_Number'] ?> </label>
                        <input type="tel" name="phoneNumOfA" class="form-control" autocomplete="off"
                               value="<?= $phoneNumOfA ?>" required="required" placeholder="<?= $t['Your_Phone_Number'] ?>">
                        <br/>

                        <label> <?= $t['Birth_Date'] ?> </label>
                        <p><input type="date" name="birthDDOOfA" class="form-control" autocomplete="off"
                                  value="<?= $birthDDOOfA ?>" required="required" placeholder="<?= $t['Your_Birth_Date'] ?>">
                        <br/>

                        <label>  <?= $t['Password'] ?> </label>
                        <input type="password" name="passOfA" class="form-control" autocomplete="off"
                               value="" placeholder="<?= $t['Your_Password'] ?>">

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    } else {
        echo "<script> window.location.href= 'ALogin.php';</script>";
    }
include ("footer.php");
?>