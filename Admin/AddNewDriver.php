<?php
    $page_title = "Add New Driver Page";
    include("header.php");

        if (isset($_POST['Add'])) {
            if ($_POST['nameOfD'] != '' && $_POST['emailOfD'] != '' && $_POST['phnumOfD'] != ''
                                                && $_POST['birthOfD'] != '' && $_POST['passOfD'] != '') {

                $nameOfD    = $_POST['nameOfD'];
                $nameOfD_ar = $_POST['nameOfD_ar'];
                $emailOfD   = $_POST['emailOfD'];
                $phnumOfD   = $_POST['phnumOfD'];
                $birthOfD   = $_POST['birthOfD'];
                $passOfD    = $_POST['passOfD'];

                $param = "%{$nameOfD}%";
                $stmt = $db->prepare("SELECT * FROM drivers WHERE nameOfDriver LIKE :s");
                $stmt->bindParam("s", $param);
                $stmt->execute();
                $number_of_rows = $stmt->fetchColumn();

                if ($number_of_rows == 0) {

                    $stmt = $db->prepare("INSERT INTO drivers(nameOfDriver,nameOflDriver_ar,EmailOfDriver,PhoneNumOfDriver,
                                BirthdaydateOfDriver,Password)
                                                                VALUES(:N,:nd_ar,:E,:Ph,:D,:P)");
                    $stmt->execute(array(
                            'N'      => $nameOfD,
                            'nd_ar'  => $nameOfD_ar,
                            'E'      => $emailOfD,
                            'Ph'     => $phnumOfD,
                            'D'      => $birthOfD,
                            'P'      => $passOfD
                        )
                    );
                    if ($stmt) {
                        $tt1 = $t['The'];
                        $tt2 = $t['driver is Added'];
                        $tt3 = $t['Successfully'];
                        echo '<div class="alert alert-success text-center">' . $tt1 .' '. $nameOfD. ' ' . $tt2 .
                                                                                 ' <strong>'.$tt3.'</strong></div>';
                        echo '<meta http-equiv="Refresh" content="10; URL=ShowDrivers.php">';
                    } else {
                        $natN = $t['Something wrong try again!'];
                        echo '<div class="alert alert-danger text-center">'.$natN.'</div>';
                    }

                } else{
                    $tt4 = $t['The'];
                    $tt5 = $t['driver is already'];
                    $tt6 = $t['Exist'];
                    echo '<div class="alert alert-danger text-center">' . $tt4 . ' ' . $nameOfD . ' ' .$tt5 .
                                                                                            ' <strong>'. $tt6 .'</strong></div>';
                }

            }else{
                $tc = $t['All_filed_have_(*)_required!'];
                echo '<div class="alert alert-danger text-center">'.$tc.'</div>';
            }
        }


?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <h3 class="login-header"> <?= $t['Add new driver']?> </h3>
                </div>
                <div class="card-body">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Name of Driver']?>* </label></b>
                        <input type="text" name="nameOfD" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter name of driver']?>"><br>

                        <b><label> <?= $t['Name_Of_driver_in_arabic']?>* </label></b>
                        <input type="text" name="nameOfD_ar" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter name of driver in arabic']?>"><br>

                        <b><label> <?= $t['Email_Address'] ?>* </label></b>
                        <input type="email" name="emailOfD" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter email of driver'] ?>"><br>

                        <b><label> <?= $t['Phone_Number'] ?>* </label></b>
                        <input type="tel" name="phnumOfD" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter phone of driver'] ?>"><br/>

                        <b><label> <?= $t['Birth_Date'] ?>* </label></b>
                        <input type="date" name="birthOfD" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter birth date of driver'] ?>"><br>

                        <b><label> <?= $t['Password'] ?>* </label></b>
                        <input type="password" name="passOfD" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter password of driver'] ?>"><br>

                        <input type="submit" class="btn btn-primary btn-block" name="Add" value="<?= $t['Add new driver']?>">
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
