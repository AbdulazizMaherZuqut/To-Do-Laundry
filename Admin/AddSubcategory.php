<?php
    $page_title = "Add Subcategory Page";
    include("header.php");

        if (isset($_POST['AddSubcategory'])) {

            if ($_POST['category'] != '' && $_POST['SubcategoryName'] != '' && $_POST['SubcategoryPrice'] != '') {

                $category       = $_POST['category'];
                $nameOfSC       = $_POST['SubcategoryName'];
                $nameOfSC_ar    = $_POST['SubcategoryName_ar'];
                $priceOfSC      = $_POST['SubcategoryPrice'];

                $param = "%{$nameOfSC}%";
                $stmt = $db->prepare("SELECT * FROM subcategory WHERE nameOfSubcategory LIKE :s");
                $stmt->bindParam("s", $param);
                $stmt->execute();
                $number_of_rows = $stmt->fetchColumn();

                if ($number_of_rows == 0) {
                    $stmt = $db->prepare("INSERT INTO subcategory(category_id,nameOfSubcategory,nameOfSubcategory_ar,priceOfSubcategory)
                                                                    VALUES(:ci,:n,:ns_ar,:Ph)");
                    $stmt->execute(array(
                            'ci'     => $category,
                            'n'      => $nameOfSC,
                            'ns_ar'  => $nameOfSC_ar,
                            'Ph'     => $priceOfSC
                        )
                    );

                    if ($stmt) {
                        $tt1 = $t['The'];
                        $tt2 = $t['subcategory is Added'];
                        $tt3 = $t['Successfully'];

                            echo '<div class="alert alert-success text-center">' . $tt1 . ' ' . $nameOfSC . ' ' . $tt2 .
                                ' <strong>' . $tt3 . '</strong></div>';
                            echo '<meta http-equiv="Refresh" content="10; URL=showSubcategories.php">';

                    } else {
                        $natN = $t['Something wrong try again!'];
                        echo '<div class="alert alert-danger text-center">'.$natN.'</div>';
                    }
                } else {
                    $tt4 = $t['The'];
                    $tt5 = $t['subcategory is already'];
                    $tt6 = $t['Exist'];
                    echo '<div class="alert alert-danger text-center">' . $tt4 . ' ' . $nameOfSC . ' ' .$tt5 .
                                                                                ' <strong>'. $tt6 .'</strong></div>';
                }
            }else{
                $tc = $t['All_filed_have_(*)_required!'];
                echo '<div class="alert alert-danger text-center">'.$tc.'</div>';
            }
        }
?>

    <div class="row" style="margin-top: 50px;" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-4 m-auto ">
            <div class="card">
                <div class="card-header">
                    <h3 class="login-header"> <?= $t['Add Subcategory'] ?> </h3>
                </div>
                <div class="card-body">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                        <b><label> <?= $t['Category'] ?>* </label></b>
                        <select class="form-control" name="category">
                            <option value="">--<?= $t['Select_The_service:'] ?>--</option>
                            <?php
                            $getCategory = $db->query("Select * from categories order by Sort");
                            if($getCategory->rowCount() != 0 ){
                                while ($info = $getCategory->fetch()){
                                    $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                                ?  $info['nameOfCategory_ar'] : $info['nameOfCategory'];
                                    ?>
                                    <option value="<?= $info['id'] ?>"> <?= $n ?> </option>
                                    <?php
                                }
                            }
                            ?>
                        </select><br>

                        <b><label> <?= $t['Name of Subcategory'] ?>* </label></b>
                        <input type="text" name="SubcategoryName" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter name of subcategory'] ?>"><br/>

                        <b><label> <?= $t['Name_Of_subcategory_in_arabic'] ?>* </label></b>
                        <input type="text" name="SubcategoryName_ar" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter name of subcategory in arabic'] ?>"><br/>

                        <b><label> <?= $t['Price of Subcategory'] ?>* </label></b>
                        <input type="text" name="SubcategoryPrice" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter price of Subcategory'] ?>"><br/>

                        <input type="submit" name="AddSubcategory" class="btn btn-primary btn-block"
                               value="<?= $t['Add new Subcategory'] ?>">

                    </form>

                </div>
            </div>
        </div>
    </div>
<?php
include("footer.php");
