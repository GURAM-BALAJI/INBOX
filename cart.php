<!DOCTYPE html>
<?php
include 'includes/session.php';
include 'includes/header.php';
?>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Inbox - Cart</title>
</head>
<style>
    body {
    
        font-family: 'Roboto', sans-serif;
    }
    
    hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: dot-dot-dash;
        border-width: 2px;
        color: #0E2231;
        width: 98%;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 0.8px solid #dddddd;
        text-align: center;
        padding: 3px;
    }
</style>

<body>
    <center>
        <div style="background-color: #333;">
            <img src="logo.png" width="100%" height="70px">
        </div>


        <div style="background-color: #001a35;color: #89E6C4;">CART</div>
        <?php
        if (isset($_SESSION['inbox_id'])) {
            $user_id = $_SESSION['inbox_id'];
            $conn = $pdo->open();
            $stmt = $conn->prepare("SELECT * FROM message");
            $stmt->execute();
            foreach ($stmt as $row) {
                if ($row['message_id'] == 1 && !empty($row['message'])) { ?>
                    <marquee style="color:yellow;">
                        <?php echo $row['message']; ?>
                    </marquee>
                <?php }
                if ($row['message_id'] == 2 && !empty($row['message'])) { ?>
                    <marquee style="color:yellow;">
                        <?php echo $row['message']; ?>
                    </marquee>
                <?php }
            } ?>
            <?php
            if (isset($_SESSION['error'])) {
                echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                unset($_SESSION['success']);
            }
            ?>
        </center>
        <section class="content">
            <button
                style="width:100%;height:50px;border:2px solid black;margin-bottom:8px;border-radius :15px;background-color:lightblue;"
                class="btn btn-sm history btn-flat "><b>ORDERS HISTORY</b></button>
            <div class="modal-content">
                <div class="modal-body">
                    <table style="width: 100%;">
                        <?php

                        $total = $i = 0;
                        $stmt = $conn->prepare("SELECT * FROM cart left join items on items_id=cart_items_id WHERE cart_user_id=:user_id");
                        $stmt->execute(['user_id' => $user_id]);
                        foreach ($stmt as $row11) {
                            $i = 1;
                            $items_id = $row11['items_id'];
                            $stmt1 = $conn->prepare("SELECT * FROM items WHERE items_id=:items_id");
                            $stmt1->execute(['items_id' => $items_id]);
                            foreach ($stmt1 as $row1) {
                                ?>
                                <tr>
                                    <td rowspan="3"> <img style=" border-radius: 10px; "
                                            src="./items_images/<?php echo $row1['items_image']; ?>" height="100px" width="100px">
                                    </td>
                                    <td colspan="2">
                                        <?php echo "<span style='text-transform: capitalize;font-weight:bold; color:black'>" . $row1['items_name'] . "</span>"; ?>
                                    </td>
                                <tr>
                                    <td colspan="2">
                                        <form method="POST" action="Minus">
                                            <center>
                                                <input type="hidden" name="id" value="<?php echo $row11['cart_id']; ?>">
                                                <?php if ($row11['cart_qty'] == '1') { ?>
                                                    <input style="background-color:aliceblue;border: none;" type="submit" name="remove"
                                                        value="&#10060;">
                                                <?php } else { ?>
                                                    <input style="background-color: #d24026;border: none;" type="submit" name="minus"
                                                        value=" - ">
                                                <?php } ?>
                                                &nbsp;
                                                <input type="text" name="qty" size="1" onfocus="blur()"
                                                    value="<?php echo $row11['cart_qty']; ?>" style="border:none;">
                                                &nbsp;
                                                <input style="background-color:chartreuse;border: none;" type="submit" name="add"
                                                    value=" + ">
                                            </center>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Sub-Total
                                    </td>
                                    <td>
                                        <?php
                                        $total += $row11['cart_qty'] * $row1['items_cost'];
                                        echo '<b>&#8377;' . $row11['cart_qty'] * $row1['items_cost'] . '</b>'; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3">
                                    <hr>
                                </td>
                            </tr>
                            <?php
                        }
                        if ($i == 1) { ?>
                            <tr>
                                <th colspan='2'>
                                    <center>TOTAL AMOUNT:</center>
                                </th>
                                <th>
                                    <center>&#8377;
                                        <?php echo $total; ?>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                    <a href="Address">
                                        <button
                                            style="width:95%;height:50px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;border-radius:25px;"
                                            class="btn btn-success btn-sm btn-flat">
                                            Buy Now
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    <?php }?>


</body>
<?php include './cart_module.php'; ?>
<?php include 'includes/scripts.php'; ?>
</html>