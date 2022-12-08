<?php
    $page_title = "Add New Laundry Worker Page";
    include("header.php");

        if (isset($_POST["Sub"])) {
            if ($_POST['nameOfLW'] != '' && $_POST['emailOfLW'] != '' && $_POST['phnumOfLW'] != ''
                                            && $_POST['birthOfLW'] != '' && $_POST['passOfLW'] != '') {
                $nameOfLW    = $_POST['nameOfLW'];
                $nameOfLW_ar = $_POST['nameOfLW_ar'];
                $emailOfLW   = $_POST['emailOfLW'];
                $phnumOfLW   = $_POST['phnumOfLW'];
                $birthOfLW   = $_POST['birthOfLW'];
                $passOfLW    = md5($_POST['passOfLW']);

                $param = "%{$nameOfLW}%";
                $stmt = $db->prepare("SELECT * FROM laundryworker WHERE NameOfLaundryWorker LIKE :s");
                $stmt->bindParam("s", $param);
                $stmt->execute();
                $number_of_rows = $stmt->fetchColumn();
                if($number_of_rows == 0){
                    $stmt = $db->prepare("INSERT INTO laundryworker(NameOfLaundryWorker,nameOflaundryworker_ar,EmailOfLaundryWorker,
                          PhoneNumOfLaundryWorker,BirthdayDateOfLaundryWorker,Password)
                                                            VALUES(:N,:nlw_ar,:E,:Ph,:D,:P)");
                    $stmt->execute(array(
                            'N'       => $nameOfLW,
                            'nlw_ar'  => $nameOfLW_ar,
                            'E'       => $emailOfLW,
                            'Ph'      => $phnumOfLW,
                            'D'       => $birthOfLW,
                            'P'       => $passOfLW
                        )
                    );
                    if ($stmt) {
                        $tt1 = $t['The'];
                        $tt2 = $t['laundry worker is Added'];
                        $tt3 = $t['Successfully'];
                        echo '<div class="alert alert-success text-center">' . $tt1 .' '. $nameOfLW. ' ' . $tt2 .
                                                                                        ' <strong>'.$tt3.'</strong></div>';
                        echo '<meta http-equiv="Refresh" content="10; URL=ShowLaundryWorkers.php">';
                    } else {
                        $natN = $t['Something wrong try again!'];
                        echo '<div class="alert alert-danger text-center">'.$natN.'</div>';
                    }
                } else{
                    $tt4 = $t['The'];
                    $tt5 = $t['laundry worker is already'];
                    $tt6 = $t['Exist'];
                    echo '<div class="alert alert-danger text-center">' . $tt4 . ' ' . $nameOfLW . ' ' .$tt5 .
                                                                                        ' <strong>'. $tt6 .'</strong></div>';
                }
            } else{
                $tc = $t['All_filed_have_(*)_required!'];
                echo '<div class="alert alert-danger text-center">'.$tc.'</div>';
            }
        }
?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <h3 class="login-header"> <?= $t['Add new laundry worker'] ?>  </h3>
                </div>
                <div class="card-body">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Name_of_Laundry_Worker'] ?>* </label></b>
                        <input type="text" name="nameOfLW" class="form-control" autocomplete="off"
                                   placeholder="<?= $t['Enter name of laundry worker'] ?>"><br>

                        <b><label> <?= $t['Name_Of_laundryWorker_in_arabic'] ?>* </label></b>
                        <input type="text" name="nameOfLW_ar" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter name of laundry worker in arabic'] ?>"><br>

                        <b><label> <?= $t['Email_Address'] ?>* </label></b>
                        <input type="email" name="emailOfLW" class="form-control" autocomplete="off"
                                   placeholder="<?= $t['Enter email of laundry worker'] ?>"><br>

                        <b><label> <?= $t['Phone_Number'] ?>* </label></b>
                        <input type="tel" name="phnumOfLW" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter phone of laundry worker'] ?>"><br>

                        <b><label> <?= $t['Birth_Date'] ?>* </label></b>
                        <input type="date" name="birthOfLW" class="form-control" autocomplete="off"
                                   placeholder="<?= $t['Enter birth date of laundry worker'] ?>"><br>

                        <b><label> <?= $t['Password'] ?>* </label></b>
                        <input type="password" name="passOfLW" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter password of laundry worker'] ?>"><br>

                        <input type="submit" name="Sub" class="btn btn-primary btn-block" value="<?= $t['Add new laundry worker'] ?>">
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
