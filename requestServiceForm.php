<?php
    $page_title = "Washing Only Page";
    include("header.php");

    (!isset($_SESSION['id'])) ? header('Location:login.php') : '';
?>
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-6 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['Request_Service'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="NextRequestService.php"  method="GET">

                        <b><label> <?= $t['Select_The_service:'] ?> </label></b>
                        <div class="container services">
                            <div class="row text-center" style="margin-top: 10px;">
                                <?php
                                    $getService = $db->query("Select * from services");
                                    if($getService->rowCount() != 0 ){
                                        while ($info = $getService->fetch()){
                                            $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                                    ?  $info['nameOfService_ar'] : $info['nameOfService'];
                                            ?>

                                            <div class="col-md-6 m-auto" >
                                                <img src="image/<?= $info['pictureOfService'] ?>" id="w" ><br/>
                                                <input type="radio" name="services" value="<?= $info['id'] ?>">
                                                <label for="W"> <?= $n ?> </label><br/>
                                            </div>

                                            <?php
                                        }
                                    } else{
                                        $mm = $t['We can not found this service!'];
                                        echo '<div class="alert alert-danger text-center">'.$mm.' </div>';
                                    }
                                ?>
                            </div>
                        </div>

                        <br/>

                        <b><label> <?= $t['Select_The_category:'] ?> </label></b><br/>
                        <div class="container services">
                            <div class="row text-center" style="margin-top: 10px;">
                                <?php
                                    $getCategory = $db->query("Select * from categories order by Sort");
                                    if($getCategory->rowCount() != 0 ){
                                        while ($info = $getCategory->fetch()){
                                            $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') ?  $info['nameOfCategory_ar'] : $info['nameOfCategory'];
                                            ?>

                                            <div class="col-md-6 m-auto" >
                                                <img src="image/<?= $info['pictureOfCategory'] ?>" id="w" ><br/>
                                                <input type="radio" name="categories" value="<?= $info['id'] ?>">
                                                <label> <?= $n ?> </label><br/>
                                            </div>

                                            <?php
                                        }
                                    } else{
                                        $mm = $t['We can not found this category!'];
                                        echo '<div class="alert alert-danger text-center">'.$mm.' </div>';
                                    }
                                ?>
                            </div>
                        </div>

                        <input type="Submit" name="nextOrder" class="btn btn-primary btn-block"
                               value="<?= $t['Next'] ?> " style="margin-top: 20px;" >

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
