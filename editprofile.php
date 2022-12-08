<?php
    $page_title = "Edit Profile Page";
    include ("header.php");

    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $getUser = $db->query("SELECT * FROM clients WHERE id='$id'");
        $info = $getUser->fetch();

        $nameOfClient    = $info['NameOfClient'];
        $nameOfClient_ar = $info['nameOfClient_ar'];
        $emailOfClient   = $info['Email'];
        $phonNumOfClient = $info['PhoneNumber'];
        $birthDDOfClient = $info['BirthdayDate'];
        $passOfClient    = $info['Password'];

        if (isset($_POST['edit'])) {

            $nameOfClient    = $_POST['nameOfClient'];
            $nameOfClient_ar = $_POST['nameOfClient_ar'];
            $emailOfClient   = $_POST['emailOfClient'];
            $phonNumOfClient = $_POST['phonNumOfClient'];
            $birthDDOfClient = $_POST['birthDDOfClient'];
            $passOfClient    = md5($_POST['passOfClient']);

            $res = $info['id'];
            if ($res === $id) {
                $update = $db->query("UPDATE clients SET NameOfClient='$nameOfClient',nameOfClient_ar='$nameOfClient_ar',Email='$emailOfClient',
                                 PhoneNumber='$phonNumOfClient',BirthdayDate='$birthDDOfClient',Password='$passOfClient'
                                    WHERE id='$id'");

            }
        }

?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-5 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['Edit_My_Profile'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <label> <?= $t['Name_Of_Client'] ?> </label>
                        <input type="text" class="form-control" name="nameOfClient" value="<?= $nameOfClient ?>"
                                placeholder="<?= $t['Your_name'] ?>"><br>

                        <label> <?= $t['Name_Of_client_in_arabic'] ?> </label>
                        <input type="text" class="form-control" name="nameOfClient_ar" value="<?= $nameOfClient_ar ?>"
                               placeholder="<?= $t['Your_name'] ?>"><br>

                        <b><label> <?= $t['Email_Address'] ?> </label></b>
                        <input type="email" name="emailOfClient" value="<?= $emailOfClient ?>" class="form-control"
                               placeholder="<?= $t['Your_Email_Address'] ?>"><br>

                        <b><label> <?= $t['Phone_Number'] ?> </label></b>
                        <input type="tel" name="phonNumOfClient" value="<?= $phonNumOfClient ?>" class="form-control"
                                placeholder="<?= $t['Your_Phone_Number'] ?>"><br>

                        <b><label> <?= $t['Birth_Date'] ?> </label></b>
                        <input type="date" name="birthDDOfClient" value="<?= $birthDDOfClient ?>" class="form-control"
                                placeholder="<?= $t['Your_Birth_Date'] ?>"><br>

                        <b><label> <?= $t['Password'] ?> </label></b>
                        <input type="password" name="passOfClient" value="" class="form-control"
                                placeholder="<?= $t['Your_Password'] ?>"><br>

                        <input type="submit" name="edit" class="btn btn-primary btn-block" value="<?= $t['Edit'] ?>" >

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    } else {
        echo "<script>window.location.href= 'login.php';</script>";
    }
include ("footer.php");
