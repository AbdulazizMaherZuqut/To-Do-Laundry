<?php
    $page_title = "Home Page";
    include ("header.php");
?>
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-4 m-auto text-center">
                <b><h2 style="color: blue;"> <?= $t['Our_Services'] ?> </h2></b>
            </div>
        </div>
    </div>

    <div class="container services">
        <div class="row" style="margin-top: 20px; ">

            <?php
            $getService = $db->query("Select * from services");
            if($getService->rowCount() != 0 ){
                while ($info = $getService->fetch()){
                    $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') ?  $info['nameOfService_ar'] : $info['nameOfService'];
                    ?>

                    <div class="col-md-4 m-auto text-center" >
                        <div class="card">
                            <div class="card-body">

                                <img src="../image/<?= $info['pictureOfService'] ?>" id="w" ><br/>
                                <label style="color: #08b0d6; "><?= $n ?></label><br/>

                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>

            <div class="col-md-4 m-auto text-center">
                <div class="card s">
                    <div class="card-body">
                        <img src="../image/fasterEdit.png"/><br/>
                        <b><label class="C"> <?= $t['Quick_Service'] ?> </label></b><br>
                        <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card s">
                    <div class="card-body">
                        <img src="../image/image23.png"/><br/>
                        <b><label class="C"> <?= $t['Pay_on_delivery'] ?>  </label></b><br>
                        <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card s">
                    <div class="card-body">
                        <img src="../image/24_hours.png"/><br/>
                        <b><label class="C"> <?= $t['Available_on_24_hours'] ?> </label></b><br>
                        <b><label class="C"> <?= $t['No_price'] ?> </label></b>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4 m-auto text-center">
                <h2 style="color: blue;"> <?= $t['The_category'] ?> </h2>
            </div>
        </div>
    </div>

    <div class="container services">
        <div class="row" style="margin-top: 50px;">

            <?php
            $getCategory = $db->query("Select * from categories order by Sort");
            if($getCategory->rowCount() != 0 ){
                while ($info = $getCategory->fetch()){
                    $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') ?  $info['nameOfCategory_ar'] : $info['nameOfCategory'];
                    ?>

                    <div class="col-md-4 m-auto text-center" >
                        <div class="card">
                            <div class="card-body">
                                <img src="../image/<?= $info['pictureOfCategory'] ?>" id="w" ><br/>
                                <label style="color: #08b0d6; "> <?= $n ?> </label><br/>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
    </div>

    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4 m-auto text-center">
                <h3 style="color: #08b0d6 !important;"> <?= $t['The_subcategory_of_Clothes'] ?> </h3>
            </div>
        </div>
    </div>

    <div class="container services">
        <div class="row" style="margin-top: 50px;">

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <b><label class="C"> <?= $t['White_Thob'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Color_Thob'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Under_Shirt'] ?>- <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Sport_Suit'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Shemagh'] ?>    - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Pajama'] ?>     - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['School_Dress'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Suit'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <b><label class="C"> <?= $t['Jens'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Farwa'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Cap'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Coat'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Pullover'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Sock'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Shirt'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Trouser'] ?> - <?= $t['Price:_10RS'] ?> </label></b><br/>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <b><label class="C"> <?= $t['Dress'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Gutra'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Moroccan_Thob'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Abbaya'] ?>   - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Bath_Robe'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Tarha'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Basht'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Jacket'] ?>  - <?= $t['Price:_10RS'] ?> </label></b><br/>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4 m-auto text-center">
                <h3 style="color: #08b0d6 !important;"> <?= $t['The_subcategory_of_Carpets'] ?> </h3>
            </div>
        </div>
    </div>

    <div class="container services">
        <div class="row" style="margin-top: 50px;">

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <a href="">
                            <img  src="../image/image.png" ><br/>
                            <b><label class="C"> <?= $t['Prayer_Carpets'] ?> </label></b><br/>
                            <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">

                        <img src="../image/image1.png" ><br/>
                        <b><label class="C"> <?= $t['Doormat_Carpets'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>

                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <img src="../image/image2.png" ><br/>
                        <b><label class="C"> <?= $t['Long_or_Short_Carpets'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4 m-auto text-center">
                <h3 style="color: #08b0d6 !important;"> <?= $t['The_subcategory_of_Blankets_and_Sheets'] ?> </h3>
            </div>
        </div>
    </div>

    <div class="container services">
        <div class="row" style="margin-top: 50px;">

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <img src="../image/bedding.png" ><br/>
                        <b><label class="C"> <?= $t['Long_or_Short_blanket_of_bed'] ?> </label></b><br/>
                        <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                            <img src="../image/bedSheets.png" ><br/>
                            <b><label class="C"> <?= $t['Prayer_Sheets'] ?> </label></b><br/>
                            <b><label class="C"> <?= $t['Price:_10RS'] ?> </label></b>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <a href="">
                            <img src="../image/blanketTable.png" ><br/>
                            <b><label> <?= $t['Table_cloth'] ?> </label></b><br/>
                            <b><label> <?= $t['Price:_10RS'] ?> </label></b>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
include ("footer.php");
