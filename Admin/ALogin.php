<?php
    session_start();
    include ("../connect.php");
    include ("../init.php");
    (isset($_SESSION['admin_id'])) ? header("Location: index.php") : '';
    $page_title = "Admin Login Page";
?>
<!DOCTYPE html>
<html <?= (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') ? 'dir="rtl"' : 'dir="ltr"'; ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://thenounproject.com/search/icons/?iconspage=1&q=ironing" rel="stylesheet">
    <title> To Do Laundry <?= (isset($page_title)) ? " - " .$page_title:"";  ?> </title>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" >
    <link href="../css/all.min.css" rel="stylesheet" type="text/css" >
    <style>

        body {
            background: #f6f6f6;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .body_bg {
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            height: auto;
            position: absolute;
            top: 0;
            display: block;
            bottom: 0;
        }

        img:hover {
            opacity: 0.5;
        }

        element.style {
        }
        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }
        .btn-primary {
            color: #fff;
            background-color: #e89f58;
            border-color: #e89f58;
        }

        .btn-primary:hover{
            background: #08b0d6;
            border-color: #08b0d6;
        }

        label{
            font-weight: bold;
        }

        .card-header {
            background-color: #e89f58;
            color: #ffffff;
        }
        a{
            color: #08b0d6;
            margin-bottom: 20px;
        }
        a:hover{
            color: #e89f58;
        }
        .card{
            border: 1px solid #e89f58 !important;
        }

        .services img{
            height: 50px;
            margin-bottom: 10px;
            color: #08b0d6;
        }

        .services .card{
            background-color: transparent;
        }

        h3, .h3{
            color: white !important;
        }

        h2, .h2{
            color: #08b0d6 !important;
        }

        .logo{
            height: 150px;
        }

        .C{
            color: #08b0d6;
        }

        .card, .s{
            margin-bottom: 20px;
        }

        <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar'){ ?>
        body{
            direction: rtl;
            text-align: right;
        }

        <?php } ?>

    </style>
</head>

<body>

    <div class="row" style="margin-top: 50px;">

        <div class="col-md-4 m-auto ">

            <div class="text-center">

                <p><img class="logo" src="../image/logo.png" ></p>

                <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar'){ ?>
                    <b><a href="../lang.php?lang=en&redirect=<?=  $_SERVER['REQUEST_URI'] ?>" class="btn btn-primary" > English </a></b>
                <?php }else{ ?>
                    <a href="../lang.php?lang=ar&redirect=<?=  $_SERVER['REQUEST_URI'] ?>" class="btn btn-primary"> العربية </a>
                <?php } ?>

            </div>

            <br>
            <br>

            <div class="card">
                <div class="card-header">
                    <h3 class="login-header"> <?= $t['Log_in'] ?> </h3>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_POST['login'])){

                        $email = $_POST['emailOfA'];
                        $pass  = md5($_POST['passA']);

                    if(empty($email) or $email == " " or empty($pass) or $pass == " "){
                        $nn = $t['You_can\'t_leave_any_or_all'];
                        $f  = $t['fields_blank'];
                        echo '<div class="alert alert-danger">'
                            .$nn. ' <strong>'.$f.'</strong>'.
                            '</div>';
                    } else {
                            $stmt = $db->query("SELECT * FROM admins WHERE EmailOfAdmin = '$email' 
                                                                                            AND Password = '$pass'");
                            $count = $stmt->rowCount();


                            if ($count > 0) {
                                $data = $stmt->fetch();
                                $_SESSION['admin_id'] = $data['id'];
                                header("Location: index.php");
                            } else {
                                $n = $t['User_not_found'];
                                echo '<div class="alert alert-danger">' . $n . '</div>';
                            }
                        }
                    }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >

                        <label> <?= $t['Email_of_A'] ?> </label><br>
                        <input type="email" name="emailOfA" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter_your_email'] ?>"><br>

                        <label> <?= $t['Password'] ?> </label><br>
                        <input type="password" name="passA" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter_your_password'] ?>"><br>

                        <input type="submit" class="btn btn-primary btn-block" value="<?= $t['Log_in'] ?>" name="login">
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php
include ("footer.php");
?>
