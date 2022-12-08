<?php
    $page_title = "Show Drivers Page";
    include("header.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : '';
    $d = (isset($_GET['d'])) ? $_GET['d'] : '';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h1 class="login-header"> <?= $t['Show drivers'] ?> </h1>
                    </div>

                    <div class="card-body">

                        <?php
                            if($id != '' && $d == 1){
                                $del = $db->query("DELETE FROM drivers WHERE id='$id'");
                                if ($del){
                                    echo '<meta http-equiv="Refresh" content="0; URL=ShowDrivers.php">';
                                } else {
                                    $m = $t['There_is_a_problem,_please_try_again'];
                                    echo '<div class="alert alert-danger text-center">'. $m .'</div>';
                                }
                            }
                        ?>

                        <table class="table">
                            <thead class="thead-light table-bordered">
                                <th><?= $t['Driver_ID'] ?></th>
                                <th><?= $t['Driver_Name'] ?></th>
                                <th><?= $t['Driver_Email'] ?></th>
                                <th><?= $t['Driver_Phone'] ?></th>
                                <th><?= $t['Control'] ?></th>
                            </thead>

                            <tbody class="table-bordered">
                                <?php
                                    $getUser = $db->query("SELECT * FROM drivers");
                                    while ($info = $getUser->fetch()) {
                                        $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                                ?  $info['nameOflDriver_ar'] : $info['nameOfDriver'];
                                        $x = $t['Delete'];
                                        echo '
                                                    <tr>
                                                        <td>' . $info['id'] . '</td>
                                                        <td>' . $n . '</td>
                                                        <td>' . $info['EmailOfDriver'] . '</td>
                                                        <td>' . $info['PhoneNumOfDriver'] . '</td>
                                                        <td>
                                                            <a href="ShowDrivers.php?id=' . $info['id'] . '&d=1">'.$x.'</a>
                                                        </td>
                                                    </tr>
                                              ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php
include("footer.php");