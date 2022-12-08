<?php
    (isset($_SESSION['id'])) ? header('Location:index.php') : '';
    $page_title = "Client Login Page";
    include ("header.php");
?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 m-auto ">
            <div class="card">
                <div class="card-header">
                    <h3 class="login-header"> <?= $t['Log_in'] ?> </h3>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST['login'])){

                            $email = $_POST['email'];
                            $pass  = md5($_POST['pass']);

                            if(empty($email) or $email == " " or empty($pass) or $pass == " "){
                                $nn = $t['You_can\'t_leave_any_or_all'];
                                $f  = $t['fields_blank'];
                                echo '<div class="alert alert-danger">'
                                         .$nn. ' <strong>'.$f.'</strong>'.
                                      '</div>';
                            } else {

                                $stmt = $db->query("SELECT * FROM clients WHERE Email = '$email' 
                                                                        AND Password = '$pass'");
                                $count = $stmt->rowCount();

                                if($count > 0 ){
                                    $data = $stmt->fetch();
                                    $_SESSION['id'] = $data['id'];
                                    echo '<meta http-equiv="Refresh" content="0; URL=index.php">';
                                } else{
                                    $n = $t['User_not_found'];
                                    echo '<div class="alert alert-danger">' . $n . '</div>';
                                }
                            }
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >

                        <label> <?= $t['Email_of_Client'] ?> </label><br>
                        <input type="email" name="email" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter_your_email'] ?>"><br>

                        <label> <?= $t['Password'] ?> </label><br>
                        <input type="password" name="pass" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter_your_password'] ?>"><br>

                        <input type="submit" class="btn btn-primary btn-block" value="<?= $t['Log_in'] ?>" name="login">

                    </form>
                    <br>

                </div>
            </div>
        </div>
    </div>

<?php
include ("footer.php");
?>