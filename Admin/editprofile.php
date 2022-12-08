<?php
    include ("header.php");
    $page_title = "Edit Profile Page";

    if(isset($_SESSION['admin_id'])){

        $id = $_SESSION['admin_id'];
        $getUser = $db->query("SELECT * FROM admins WHERE id='$id'");
        $info = $getUser->fetch();

        $nameOfAdmin    = $info['nameOfAdmin'];
        $nameOfAdmin_ar = $info['nameOfAdmin_ar'];
        $emailOfAdmin   = $info['EmailOfAdmin'];
        $phonNumOfAdmin = $info['PhoneNumOfAdmin'];
        $birthDDOfAdmin = $info['BirthdaydateOfAdmin'];
        $passOfAdmin    = $info['Password'];

        if(isset($_POST['edit'])) {

            $nameOfAdmin    = $_POST['nameOfAdmin'];
            $nameOfAdmin_ar = $_POST['nameOfAdmin_ar'];
            $emailOfAdmin   = $_POST['emailOfAdmin'];
            $phonNumOfAdmin = $_POST['phonNumOfAdmin'];
            $birthDDOfAdmin = $_POST['birthDDOfAdmin'];
            $passOfAdmin    = md5($_POST['passOfAdmin']);

            $res = $info['id'];
            if ($res === $id) {
                $update = $db->query("UPDATE admins SET nameOfAdmin='$nameOfAdmin',nameOfAdmin_ar='$nameOfAdmin_ar',
                  EmailOfAdmin='$emailOfAdmin',PhoneNumOfAdmin='$phonNumOfAdmin',BirthdaydateOfAdmin='$birthDDOfAdmin',
                  Password='$passOfAdmin' WHERE id='$id'");

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

                        <b><label> <?= $t['Name_Of_Admin'] ?> </label></b>
                        <input type="text" class="form-control" name="nameOfAdmin" value="<?= $nameOfAdmin ?>"
                                required="required" placeholder="<?= $t['Your_name'] ?>"><br>

                        <b><label> <?= $t['Name_Of_admin_in_arabic'] ?> </label></b>
                        <input type="text" class="form-control" name="nameOfAdmin_ar" value="<?= $nameOfAdmin_ar ?>"
                               required="required" placeholder="<?= $t['Your_name'] ?>"><br>

                        <b><label> <?= $t['Email_Address'] ?> </label></b>
                        <input type="email" class="form-control" name="emailOfAdmin" value="<?= $emailOfAdmin ?>"
                               required="required" placeholder="<?= $t['Your_Email_Address'] ?>"><br>

                        <p><b><label>  <?= $t['Phone_Number'] ?> </label></b></p>
                        <input type="tel" class="form-control" name="phonNumOfAdmin" value="<?= $phonNumOfAdmin ?>"
                               required="required" placeholder="<?= $t['Your_Phone_Number'] ?>"><br>

                        <label> <?= $t['Birth_Date'] ?> </label>
                        <p><input type="date" name="birthDDOfAdmin" class="form-control" autocomplete="off"
                                  value="<?= $birthDDOfAdmin ?>" required="required" placeholder="<?= $t['Your_Birth_Date'] ?>">
                            <br/>

                        <b><label> <?= $t['Password'] ?> </label></b>
                        <input type="password" class="form-control" name="passOfAdmin" value=""
                                placeholder="<?= $t['Your_Password'] ?>"><br>

                        <b><input type="submit" name="edit" class="btn btn-primary btn-block" value="<?= $t['Edit'] ?>" ></b>

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
