<?php
    $page_title = "Show Subcategories Page";
    include("header.php");

    $id = (isset($_GET['id'])) ? $_GET['id'] : '';
    $d = (isset($_GET['d'])) ? $_GET['d'] : '';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="login-header">  <?= $t['Show Subcategories'] ?> </h3>
                    </div>
                    <div class="card-body">

                        <?php
                        if($id != '' && $d == 1){
                            $del = $db->query("DELETE FROM subcategory WHERE id='$id'");
                            if ($del){
                                echo '<meta http-equiv="Refresh" content="0; URL=ShowSubcategories.php">';
                            } else {
                                $m = $t['There_is_a_problem,_please_try_again'];
                                echo '<div class="alert alert-danger text-center">'. $m .'</div>';
                            }
                        }
                        ?>

                        <table class="table">
                            <thead class="thead-light table-bordered">
                                <th><?= $t['Subcategory_ID'] ?></th>
                                <th><?= $t['Subcategory_Name'] ?></th>
                                <th><?= $t['Subcategory_Price'] ?></th>
                                <th><?= $t['Control'] ?></th>
                            </thead>

                            <tbody class="table-bordered">

                                <?php
                                        $getUser = $db->query("SELECT * FROM subcategory");
                                        while ($info = $getUser->fetch()) {
                                            $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar')
                                                     ?  $info['nameOfSubcategory_ar'] : $info['nameOfSubcategory'];
                                            $x = $t['Delete'];
                                            echo '
                                                      <tr>
                                                          <td>' . $info['id'] . '</td>
                                                          <td>' . $n . '</td>
                                                          <td>' . $info['priceOfSubcategory'] . '</td>
                                                          <td>
                                                              <a href="ShowSubcategories.php?id=' . $info['id'] . '&d=1">
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
