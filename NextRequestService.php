<?php
    $page_title = "Continue order Page";
    include("header.php");

    (!isset($_SESSION['id'])) ? header('Location:login.php') : '';

    $service  = (isset($_GET['services'] )) ? $_GET['services'] : '';
    $category = (isset($_GET['categories'] )) ? $_GET['categories'] : '';

    if(empty($service) || empty($category)){
        header("Location: requestServiceForm.php");
        exit;
    }
?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-12">
            <?php
            if(isset($_POST['submitOrder'])){
                if($_POST['subcategories'] != '' && $_POST['NorQ'] != '' && $_POST['address'] != ''){

                        $namePrice = array();
                        $selectedSubcategory = $_POST['subcategories'];
                        $selectedSubcategoryP = $_POST['subPrice'];
                        $selectedSubcategoryQ = $_POST['subQty'];

                        for($i=0;$i<count($selectedSubcategory);$i++){
                            if($selectedSubcategory[$i] != '') {
                                $namePrice[] = array(
                                    'n' => $selectedSubcategory[$i],
                                    'p' => $selectedSubcategoryP[$i],
                                    'q' => ($selectedSubcategoryQ[$i] <= 0) ? 1 : $selectedSubcategoryQ[$i]
                                );
                            }
                        }
                        //var_dump($namePrice);
                        $item = json_encode($namePrice,JSON_UNESCAPED_UNICODE);
                        $typeOfService       = $_POST['NorQ'];
                        $address             = $_POST['address'];
                        $orderDate           = date('Y-m-d');
                        $clientId            = $_SESSION['id'];

                        $add = $db->query("INSERT INTO requestservices (selectedService,selectedCategory,
                            selectedSubcategory,typeOfService,address,orderDate,client_id) 
                                                VALUES ('$service', '$category', '$item',
                                                        '$typeOfService','$address','$orderDate','$clientId')");
                        if ($add){
                            //echo '<div class="alert alert-success"> The order submitted successfully </div>';
                            $last_in = $db->lastInsertId();
                            $cN = $db->query("SELECT * FROM clients WHERE id='$clientId'");
                            $cNf = $cN->fetch();
                            $cName = $cNf['NameOfClient'];
                              $db->query("INSERT INTO order_log (user_name, order_id, order_action, date) 
                                                VALUES ('$cName', '$last_in', 'Submit order.', '$orderDate')");
                            header("Location: OrderDetails.php?id=" . $last_in);
                        } else {
                            $m = $t['There_is_a_problem,_please_try_again'];
                            echo '<div class="alert alert-danger text-center">'. $m .'</div>';
                        }

                }else {
                    $h = $t['You must fill all field'];
                    echo '<div class="alert alert-danger">'. $h .' </div>';
                }
            }
            ?>
        </div>
        <div class="col-md-7 m-auto ">
            <div class="card">
                <div class="card-header">
                    <b><h3 class="login-header"> <?= $t['Request_Service'] ?> </h3></b>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                        <b><label> <?= $t['Select the subcategory:'] ?> </label></b>
                        <div class="container services">
                            <div class="row" style="margin-top: 10px;">
                                <?php
                                $getSubcategory = $db->query("Select * from subcategory WHERE category_id='$category'");
                                if($getSubcategory->rowCount() != 0 ){
                                    while ($info = $getSubcategory->fetch()){
                                        $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                                    ?  $info['nameOfSubcategory_ar'] : $info['nameOfSubcategory'];
                                        ?>

                                        <div class="col-md-6">
                                            <input type="checkbox" name="subcategories[]" value="<?= $n ?>">
                                            <label style="font-weight: normal; font-size: 13px;"> <?= $n ?> </label>
                                            <label style="font-weight: normal; font-size: 12px; color: #888;"> <?= $t['(Price:'] ?> <?= $info['priceOfSubcategory'] ?>) </label>
                                            <input type="number" name="subQty[]" class="form-control" placeholder="<?= $n ?> <?= $t['Qty'] ?>" />
                                            <input type="hidden" name="subPrice[]" value="<?= str_replace("RS", '', $info['priceOfSubcategory']); ?>" />
                                        </div>

                                        <?php
                                    }
                                } else{
                                    $y = $t['We can not found Subcategory!'];
                                    echo '<div class="alert alert-danger">'. $y . '</div>';
                                }

                                ?>
                            </div>
                        </div><br>

                        <b><label> <?= $t['Select_type_of_Service'] ?> </label></b>
                        <div class="container services">
                            <div class="row text-center" style="margin-top: 10px;">
                                <div class="col-md-6 m-auto" >
                                    <img src="image/Normal.png" ><br/>
                                    <input type="radio" name="NorQ" id="N" value="1"> <?= $t['Normal_Service'] ?> <br/>
                                    <label> <?= $t['(Price: 5 RS)'] ?> </label>
                                </div>

                                <div class="col-md-6 m-auto" >
                                    <img src="image/Faster.png"><br/>
                                    <input type="radio" name="NorQ" id="Q" value="2"> <?= $t['Quick_Service'] ?> <br/>
                                    <label> <?= $t['(Price: 10 RS)'] ?> </label>
                                </div>
                            </div>
                        </div><br/>

                        <b><label> <?= $t['Enter your Address:'] ?> </label></b>
                        <p><input type="text" class="form-control" name="address" placeholder="<?= $t['Enter your Address:'] ?>"></p>
                        <input type="Submit" name="submitOrder" class="btn btn-primary btn-block"
                               value="<?= $t['Submit Order'] ?>" style="margin-top: 20px;" >

                    </form>
                </div>
            </div>
         </div>
    </div>

<?php
include("footer.php");

