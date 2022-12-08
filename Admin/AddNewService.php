<?php
    $page_title = "Add New Service Page";
    include("header.php");


    if (isset($_POST['AddService'])){

        if($_FILES['pictureOfService']['size'] != 0 && $_POST['serviceName'] != ''){


            $pictureOfService    = $_FILES['pictureOfService']['name'];
            $tmp                 = $_FILES['pictureOfService']['tmp_name'];
            $folder              = "../image/" . $pictureOfService;
            $serviceName         =  $_POST['serviceName'];
            $serviceName_ar      =  $_POST['serviceName_ar'];


            $param = "%{$serviceName}%";
            $stmt = $db->prepare("SELECT * FROM services WHERE nameOfService LIKE :s");
            $stmt->bindParam("s", $param);
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn();

            if($number_of_rows == 0) {
                if (move_uploaded_file($tmp, $folder)) {
                    $stmt = $db->prepare("INSERT INTO services(pictureOfService,nameOfService,nameOfService_ar)
                                                        VALUES(:Pic,:N,:ns_ar)");

                    $stmt->execute(array(

                            'Pic'     => $pictureOfService,
                            'N'       => $serviceName,
                            'ns_ar'   => $serviceName_ar
                        )
                    );

                    if($stmt){
                        $tt1 = $t['The'];
                        $tt2 = $t['service is Added'];
                        $tt3 = $t['Successfully'];
                        echo '<div class="alert alert-success text-center">' . $tt1 .' '.$serviceName. ' ' . $tt2 .
                                                                                         ' <strong>'.$tt3.'</strong></div>';
                        echo '<meta http-equiv="Refresh" content="10; URL=showService.php">';
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
                $tt5 = $t['service is already'];
                $tt6 = $t['Exist'];
                echo '<div class="alert alert-danger text-center">' . $tt4 . ' ' . $serviceName . ' ' .$tt5 .
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
                    <h3 class="login-header"> <?= $t['Add new service'] ?> </h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                        <p><b><label> <?= $t['Picture of Service'] ?>* </label></b></p>
                        <input type="file" name="pictureOfService" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter Picture of service'] ?>"><br>

                        <p><b><label> <?= $t['Name of Service'] ?>* </label></b></p>
                        <input type="text" name="serviceName" class="form-control" autocomplete="off"
                                placeholder="<?= $t['Enter name of service'] ?>"><br>

                        <p><b><label> <?= $t['Name_Of_service_in_arabic'] ?>* </label></b></p>
                        <input type="text" name="serviceName_ar" class="form-control" autocomplete="off"
                               placeholder="<?= $t['Enter name of service in arabic'] ?>"><br>

                        <input type="submit" name="AddService" class="btn btn-primary btn-block"
                               value="<?= $t['Add new service'] ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
