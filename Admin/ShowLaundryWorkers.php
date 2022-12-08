<?php
    $page_title = "Show Laundry Workers Page";
    include("header.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : '';
    $d = (isset($_GET['d'])) ? $_GET['d'] : '';

?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="login-header"> <?= $t['Show laundry workers'] ?> </h3>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="card-body">

                            <?php
                            if($id != '' && $d == 1){
                                $del = $db->query("DELETE FROM laundryworker WHERE id='$id'");
                                if ($del){
                                    echo '<meta http-equiv="Refresh" content="0; URL=ShowLaundryWorkers.php">';
                                } else {
                                    $m = $t['There_is_a_problem,_please_try_again'];
                                    echo '<div class="alert alert-danger text-center">'. $m .'</div>';
                                }
                            }
                            ?>

                            <table class="table">
                                    <thead class="thead-light table-bordered">
                                    <th width="20%"><?= $t['Laundry_Worker_ID'] ?></th>
                                    <th width="20%"><?= $t['Laundry_Worker_Name'] ?></th>
                                    <th width="20%"><?= $t['Laundry_Worker_Email'] ?></th>
                                    <th width="30%"><?= $t['Laundry_Worker_PhoneNumber'] ?></th>
                                    <th width="20%"><?= $t['Control'] ?></th>
                                </thead>

                                <tbody class="table-bordered">
                                <tr>
                                    <?php
                                        $getUser = $db->query("SELECT * FROM laundryworker");
                                        while ($info = $getUser->fetch()) {
                                            $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                                        ?  $info['nameOflaundryworker_ar'] : $info['NameOfLaundryWorker'];
                                            $x = $t['Delete'];
                                            echo '
                                                    <tr>
                                                        <td>' . $info['id'] . '</td>
                                                        <td>' . $n . '</td>
                                                        <td>' . $info['EmailOfLaundryWorker'] . '</td>
                                                        <td>' . $info['PhoneNumOfLaundryWorker'] . '</td>
                                                        <td>
                                                             <a href="ShowLaundryWorkers.php?id=' . $info['id'] . '&d=1">'.$x.'</a>
                                                        </td>
                                                    </tr>
                                                ';
                                        }
                                    ?>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");
