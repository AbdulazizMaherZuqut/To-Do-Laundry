<?php
    $page_title = "Add New Category Page";
    include("header.php");

    if (isset($_POST['AddCategory'])) {

        if($_FILES['categoryPicture']['size'] != 0 && $_POST['categoryName'] != ''){

            $picOfC_name  = $_FILES['categoryPicture']['name'];
            $picOfC_tmp   = $_FILES['categoryPicture']['tmp_name'];
            $folder       = "../image/" .$picOfC_name;
            $nameOfC      = $_POST['categoryName'];
            $nameOfC_ar   = $_POST['categoryName_ar'];

            $param = "%{$nameOfC}%";
            $stmt = $db->prepare("SELECT * FROM categories WHERE nameOfCategory LIKE :s");

            $stmt->bindParam("s", $param);
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn();

            if($number_of_rows == 0) {
                if (move_uploaded_file($picOfC_tmp, $folder)) {

                    $stmt = $db->prepare("INSERT INTO categories(pictureOfCategory,nameOfCategory,nameOfCategory_ar)
                                                                    VALUES(:p,:n,:n_ar)");
                    $stmt->execute(array(
                            'p'    => $picOfC_name,
                            'n'    => $nameOfC,
                            'n_ar' => $nameOfC_ar
                        )
                    );

                    if($stmt){
                        $tt1 = $t['The'];
                        $tt2 = $t['category is Added'];
                        $tt3 = $t['Successfully'];
                        echo '<div class="alert alert-success text-center">' . $tt1 . ' ' .$nameOfC. ' ' . $tt2 .
                                                                                            ' <strong>'.$tt3.'</strong></div>';
                        echo '<meta http-equiv="Refresh" content="10; URL=ShowCategories.php">';
                    }else{
                        $natN = $t['Something wrong try again!'];
                        echo '<div class="alert alert-danger text-center">'.$natN.'</div>';
                    }
                } else {
                    $natP = $t['The Picture can not upload try again!'];
                    echo '<div class="alert alert-danger text-center">'.$natP.'</div>';
                }
            }else{
                $tt4 = $t['The'];
                $tt5 = $t['category is already'];
                $tt6 = $t['Exist'];
                echo '<div class="alert alert-danger text-center">' . $tt4 . ' ' . $nameOfC . ' ' . $tt5 .
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
                    <h3 class="login-header"> <?= $t['Add_New_Category'] ?> </h3>
                </div>
                <div class="card-body">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                        <b><label> <?= $t['Picture of Category'] ?>* </label></b>
                        <input type="file" name="categoryPicture" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter Picture of category'] ?>"><br/>

                        <b><label> <?= $t['Name of Category'] ?>* </label></b>
                        <input type="text" name="categoryName" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter name of category'] ?>"><br/>

                        <b><label> <?= $t['Name_Of_category_in_arabic'] ?>* </label></b>
                        <input type="text" name="categoryName_ar" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter name of category in arabic'] ?>"><br/>

                        <input type="submit" name="AddCategory" class="btn btn-primary btn-block"
                               value="<?= $t['Add_New_Category'] ?>">

                    </form>

                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");