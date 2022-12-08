<?php
    $page_title = "Registration Page";
    include ("header.php");
    (isset($_SESSION['id'])) ? header('Location:index.php') : '';
?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['registration'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST["Sub"])) {
                            $Name     = $_POST['Name'];
                            $Name_ar  = $_POST['Name_ar'];
                            $Email    = $_POST['Email'];
                            $Phone    = $_POST['Phone'];
                            $Date     = $_POST['Date'];
                            $Pass     = md5($_POST['Pass']);
                            if (empty($Name) or $Name == " " or empty($Email) or $Email == " " or empty($Pass) or $Pass == " "
                                or empty($Phone) or $Phone == " " or empty($Date) or $Date == " ") {
                                $nn = $t['You_can\'t_leave_any_or_all'];
                                $f  = $t['fields_blank'];
                                echo '<div class="alert alert-danger">'
                                    .$nn. ' <strong>'.$f.'</strong>'.
                                    '</div>';
                            } else {
                                $stmt = $db->prepare("INSERT INTO clients(NameOfClient,nameOfClient_ar,Email,PhoneNumber,BirthdayDate,Password)
                                                                VALUES(:N,:n_ar,:E,:Ph,:D,:P)");
                                $stmt->execute(array(
                                        'N'  => $Name, 'n_ar'  => $Name_ar, 'E'  => $Email, 'Ph' => $Phone, 'D'  => $Date, 'P'  => $Pass
                                    )
                                );
                                $r = $t['Register_is'];
                                $das = $t['Done_and_Successfully'];
                                echo '<div class="alert alert-success">' .$r.' <strong>'.$das. '</strong>'.
                                      '</div>';
                                echo '<meta http-equiv="Refresh" content="5; URL=login.php">';
                            }
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Name_Of_Client'] ?>* </label></b>
                        <input type="text" name="Name" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter_Your_name'] ?> "><br>

                        <b><label> <?= $t['Name_Of_client_in_arabic'] ?>* </label></b>
                        <input type="text" name="Name_ar" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter your name in arabic'] ?> "><br>

                        <b><label> <?= $t['Email_Address'] ?>* </label></b><br>
                        <p><input type="email" name="Email" class="form-control"
                                  placeholder="<?= $t['Enter_your_email'] ?>"></p>

                        <b><label> <?= $t['Phone_Number'] ?>* </label></b>
                        <input type="tel" name="Phone" class="form-control" placeholder="<?= $t['Enter_Your_Phone_Number'] ?>"><br>

                        <b><label> <?= $t['Birth_Date'] ?>* </label></b>
                        <input type="date" name="Date" class="form-control" placeholder="<?= $t['Enter_Your_birthday_date'] ?>"><br>

                        <b><label> <?= $t['Password'] ?>* </label></b>
                        <input type="password" name="Pass" class="form-control" placeholder="<?= $t['Enter_your_password'] ?>"><br>

                        <b><label> <?= $t['Confirm_password'] ?>* </label></b>
                        <input type="password" name="Pass2" class="form-control" placeholder="<?= $t['Enter_your_confirm_password'] ?>"><br>

                        <b><input type="submit" name="Sub" class="btn btn-primary btn-block" value="<?= $t['register'] ?>" ></b>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
include ("footer.php");
