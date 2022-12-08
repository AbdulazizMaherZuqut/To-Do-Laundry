<?php
    $page_title = "Admin Browse Order Page";
    include("header.php");
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="login-header"> <?= $t['Admin_Show_Order'] ?> </h3>
                    </div>

                    <div class="card-body">

                        <table class="table">

                            <thead class="thead-light table-bordered">
                                <th width="10%"> <?= $t['ID'] ?> </th>
                                <th> <?= $t['Client_Name'] ?> </th>
                                <th> <?= $t['Date'] ?> </th>
                                <th> <?= $t['Status'] ?> </th>
                                <th width="20%"> <?= $t['Show'] ?> </th>
                            </thead>

                            <tbody class="table-bordered">

                            <?php
                                $get_order = $db->query("SELECT * FROM requestservices ORDER BY id DESC");
                                while($order = $get_order->fetch()){

                                    $clientId = $order['client_id'];
                                    $cN = $db->query("SELECT * FROM clients WHERE id='$clientId'");
                                    $cNf = $cN->fetch();
                                    $n = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') ?  $cNf['nameOfClient_ar'] : $cNf['NameOfClient'];
                                    ?>
                                    <tr>
                                        <td><?= $order['id'] ?></td>
                                        <td> <?= $n ?> </td>
                                        <td><?= $order['orderDate'] ?></td>
                                        <td><?= $order['orderStatus'] ?></td>
                                        <td><a href="OrderDetails.php?id=<?= $order['id'] ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
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
