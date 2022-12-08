<?php
    $page_title = "Show categories Page";
    include("header.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : '';
    $d = (isset($_GET['d'])) ? $_GET['d'] : '';

?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="login-header"> <?= $t['Show Categories'] ?> </h3>
                    </div>

                    <div class="card-body">

                        <?php
                        if($id != '' && $d == 1){
                            $del = $db->query("DELETE FROM categories WHERE id='$id'");
                            if ($del){
                                echo '<meta http-equiv="Refresh" content="0; URL=ShowCategories.php">';
                            } else {
                                $m = $t['There_is_a_problem,_please_try_again'];
                                echo '<div class="alert alert-danger text-center">'. $m .'</div>';
                            }
                        }
                        ?>

                        <table class="table">
                                <thead class="thead-light table-bordered">
                                <th><?= $t['Category_ID'] ?></th>
                                <th><?= $t['Category_Name'] ?></th>
                                <th><?= $t['Control'] ?></th>
                            </thead>

                            <tbody class="table-bordered">

                                <?php
                                    $getUser = $db->query("SELECT * FROM categories ORDER BY sort");
                                    while ($info = $getUser->fetch()) {
                                        $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                             ?  $info['nameOfCategory_ar'] : $info['nameOfCategory'];
                                        $x = $t['Delete'];
                                        echo '
                                               <tr>
                                                   <td>' . $info['id'] . '</td>
                                                   <td>' . $n . '</td>
                                                   <td>
                                                       <a href="ShowCategories.php?id=' . $info['id'] . '&d=1">
                                                            '.$x.'
                                                       </a>
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
