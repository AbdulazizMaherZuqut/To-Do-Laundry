<?php
    $page_title = "Client Browse Order Page";
    include("header.php");
    (!isset($_SESSION['id'])) ? header('Location:login.php') : '';
?>

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="login-header"> <?= $t['Client_Show_Order'] ?> </h3>
                    </div>

                    <div class="card-body">

                        <table class="table">
                            <thead class="thead-light table-bordered">
                            <th> <?= $t['ID'] ?> </th>
                            <th> <?= $t['Date'] ?> </th>
                            <th width="30%"> <?= $t['Status'] ?> </th>
                            <th width="30%"> <?= $t['Show'] ?> </th>
                            </thead>

                            <tbody class="table-bordered">

                            <?php
                            $cId = $_SESSION['id'];
                            $get_order = $db->query("SELECT * FROM requestservices WHERE client_id='$cId' ORDER BY id DESC");

                            while($order = $get_order->fetch()){
                            ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['orderDate'] ?></td>
                                <td><?= $order['orderStatus'] ?></td>
                                <td><a href="OrderDetails.php?id=<?= $order['id'] ?>">
                                        <i class="fa fa-eye"></i>
                                    </a></td>
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