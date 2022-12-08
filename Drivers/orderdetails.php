<?php
$page_title = " Order Details Page";
include("header.php");
$id = (isset($_GET['id'])) ? $_GET['id'] : '';

if($id != ''){

    $order = $db->query("SELECT * FROM requestservices WHERE id='$id'");

    if($order->rowCount() != 0){
        $totalOrder_price = 0;
        $oF = $order->fetch();
        ?>

        <div class="row" style="margin-top: 50px;">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="login-header"> <?= $t['Driver_Show_Order'] ?> </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <p><b><label> <?= $t['Order_ID:'] ?> </label></b><br><?= $oF['id'] ?></p>
                            <p><b><label> <?= $t['Order_Date:'] ?> </label></b><br><?= $oF['orderDate'] ?></p>

                            <p><b><label> <?= $t['The_service:'] ?> </label></b><br>
                                <?php
                                $se = $oF['selectedService'];
                                $gSe = $db->query("SELECT * FROM services WHERE id='$se'");
                                if($gSe->rowCount() != 0){
                                    $srF = $gSe->fetch();
                                    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') {
                                        echo $srF['nameOfService_ar'];
                                    }else {
                                        echo $srF['nameOfService'];
                                    }
                                }else{
                                    $mm = $t['We can not found this service!'];
                                    echo '<div class="alert alert-danger text-center">'.$mm.' </div>';
                                }
                                ?>
                            </p>

                            <p><b><label> <?= $t['The_category:'] ?> </label></b><br>
                                <?php
                                $ca = $oF['selectedCategory'];
                                $gCa = $db->query("SELECT * FROM categories WHERE id='$ca'");
                                if($gCa->rowCount() != 0){
                                    $getCategory = $gCa->fetch();
                                    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') {
                                        echo $getCategory['nameOfCategory_ar'];
                                    }else {
                                        echo $getCategory['nameOfCategory'];
                                    }
                                }else{
                                    $mm = $t['We can not found this category!'];
                                    echo '<div class="alert alert-danger text-center">'.$mm.' </div>';
                                }
                                ?>
                            </p>

                            <p><b><label> <?= $t['The_subcategory:'] ?> </label></b><br>

                                <?php
                                $su = json_decode($oF['selectedSubcategory'], true);
                                echo "<ul>";
                                foreach ($su as $suV){
                                    if($suV['n'] != '') {
                                        $RS1 = $t['(Price:'];
                                        $RS2 = $t['RS)'];
                                        $Qty = $t['Qty'];
                                        echo "<li>" . $suV['n'] . " <i> $RS1 ".$suV['p']." $RS2 - $Qty: ".$suV['q']."</i></li>";
                                        $totalOrder_price = $totalOrder_price + ((int)$suV['p']*(int)$suV['q']);
                                    }
                                }
                                echo "</ul>";
                                ?>

                            </p>


                            <p><b><label> <?= $t['The_type_of_service:'] ?> </label></b><br>
                                <?php
                                if($oF['typeOfService'] == 1){
                                    $n  = $t['Normal_Service'];
                                    $pp = $t['(Price: 5 RS)'];
                                    echo $n . ' <i>'.$pp.'</i>';
                                    $totalOrder_price = $totalOrder_price + 5;
                                }else{
                                    $q = $t['Quick_Service'];
                                    $p = $t['(Price: 10 RS)'];
                                    echo $q . ' <i>'.$p.'</i>';
                                    $totalOrder_price = $totalOrder_price + 10;
                                }

                                ?>
                            </p>

                            <p><b><label> <?= $t['Delivery_Price:'] ?> </label></b><br>
                                <?php
                                $rs = $t['RS'];
                                $pOfd = 10;
                                echo $pOfd . ' ' . $rs;
                                $totalOrder_price = $totalOrder_price + $pOfd;
                                ?>
                            </p>

                            <p><b><label> <?= $t['Vat_Price:'] ?> </label></b><br>
                                <?php
                                $Tax = ($totalOrder_price * 15)/100;
                                echo $Tax . ' ' . $rs;

                                ?>
                            </p>

                            <p><b><label> <?= $t['Total_Order_Price_without_Vat:'] ?> </label></b><br>
                                <?= number_format($totalOrder_price, 2) ?> <?= $t['RS'] ?>
                            </p>

                            <p><b><label> <?= $t['Total_Order_Price_with_Vat:'] ?> </label></b><br>
                                <?= number_format($totalOrder_price + $Tax, 2) ?> <?= $t['RS'] ?>
                            </p>

                            <p><b><label> <?= $t['Status:'] ?> </label></b><br>

                                <?= $oF['orderStatus'] ?>

                            </p>

                            <p><b><label> <?= $t['Change_Status:'] ?> </label></b><br>

                                <?php

                                if(isset($_POST['status'])){
                                    $st = $_POST['status'];
                                    $upSt = $db->query("UPDATE requestservices SET orderStatus='$st' WHERE id='$id'");
                                    if ($upSt){
                                        $upDate = date('Y-m-d');
                                        $c  = $t['Driver'];
                                        $ch = $t['Change order status to'];
                                        $db->query("INSERT INTO order_log (user_name, order_id, order_action, date) 
                                                VALUES ('$c', '$id', ' $ch $st', '$upDate')");
                                        echo '<meta http-equiv="Refresh" content="0; URL=orderdetails.php?id='.$id.'#status">';
                                    } else {
                                        $m = $t['There_is_a_problem,_please_try_again'];
                                        echo '<div class="alert alert-danger text-center">'. $m .'</div>';
                                    }
                                }

                                ?>

                                <input type="submit" name="status" value="picked-up" />
                                <input type="submit" name="status" value="on-delivery" />
                                <input type="submit" name="status" value="delivered" />

                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }else{
        $m1 = $t['We can not found this order!'];
        $p1 = $t['Back_to_orders_page'];
        echo '<div class="alert alert-danger text-center">'. $m1 .'</div>';
        echo '<center><a href="showorder.php" class="btn btn-warning">' .$p1.'</a></center>';
    }
}else{
    echo '<meta http-equiv="Refresh" content="0; URL=showorder.php">';
}
include("footer.php");
