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
    <script src=”https://code.jquery.com/jquery-3.6.0.js”></script>

    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css”>
</head>
<style>
    body {

        font-family: 'Roboto', sans-serif;
        background-color: #dcdff1;
    }

    @import url(‘https://fonts.googleapis.com/css?family=Josefin+Sans’);

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        list-style: none;
        text-decoration: none;
        font-family: ‘Josefin Sans’, sans-serif;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .button {
        border-radius: 5px;
        font-size: 17px;
        font-weight: 700;
        box-shadow: -4px -4px 7px #fffdfdb7, 3px 3px 5px rgba(94, 104, 121, 0.388);
        background: #d8dbed;
        border: none;
        padding: 12px;
        text-align: center;
        width: 100%;
        font-family: sans-serif;
        margin-bottom: 20px;
    }

    .button:hover {
        box-shadow: inset -3px -3px 7px #ffffffb0,
            inset 3px 3px 5px rgba(94, 104, 121, 0.692);
    }

    .tabs ul {
        width: 100%;
        box-shadow: 2px 2px 5px #babecc,
            -5px -5px 10px #ffffff73;
        display: flex;
    }


    .tabs ul li {
        padding: 15px 0;
        text-align: center;
        font-size: 14px;
        color: #767678;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        position: relative;
        transition: all 0.5s ease;
    }

    .tabs ul li.active {
        background: #dde1e7;
        color: rgba(0, 0, 0, 0.76);
        box-shadow: inset 2px 2px 5px #babecc,
            inset -5px -5px 10px #ffffff73;
    }

    .history {
        display: none;
    }
</style>

<body>
    <div class="modal-content"
        style=" position: fixed; top: 0; width: 100%; background-color: #d5d8e8;  box-shadow: -4px -4px 7px #fffdfdb7, 3px 3px 5px rgba(94, 104, 121, 0.388); height:105px;">
        <div class="modal-body" style="padding:0px 0px 0px 0px;">
            <center>
                <h3 style="font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;">CART</h3>
            </center>
            <div class="tabs">
                <ul>
                    <a href="MyHome">
                        <li style="width:20%;padding-left:20px;padding-right:20px;"><i class="fa fa-chevron-left"
                                aria-hidden="true"></i></li>
                    </a>
                    <li style="width:50%;" class="orders_li">Orders</li>
                    <li style="width:50%;" class="history_li">History</li>
                </ul>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <center>
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
    <div class="orders">
        <?php
        if (isset($_COOKIE['inbox_id'])) {
            $user_id = $_COOKIE['inbox_id'];
            $conn = $pdo->open();
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
                    <section class="content" style=" min-height: 10px; padding: 10px 15px 3px 15px; ">
                        <div class="modal-content"
                            style="border-radius:15px; background-color: #dcdff1;  box-shadow: -4px -4px 7px rgba(255, 253, 253, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388); ">
                            <div class="modal-body" style="padding:10px 15px 10px 15px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td rowspan="2" width="20%"> <img style=" border-radius: 10px; "
                                                src="./items_images/<?php echo $row1['items_image']; ?>" height="60px" width="60px">
                                        </td>

                                        <td width="50%" style="padding-left: 10px;">
                                            <?php echo "<span style='text-transform: capitalize;font-weight:bold; color:black'>" . $row1['items_name'] . "</span>"; ?>
                                        </td>
                                        <td rowspan="2" width="30%">
                                            <form method="POST" action="Minus">
                                                <center>
                                                    <input type="hidden" name="id" value="<?php echo $row11['cart_id']; ?>">
                                                    <?php if ($row11['cart_qty'] == '1') { ?>
                                                        <button style="color:#767678;border: none; background-color:#dcdff1;"
                                                            type="submit" name="remove"><i class="fa fa-trash fa-lg"
                                                                aria-hidden="true"></i></button>
                                                    <?php } else { ?>
                                                        <button style="color:#767678;border: none; background-color:#dcdff1;"
                                                            type="submit" name="minus"><i class="fa fa-minus-circle fa-lg"
                                                                aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    <input type="hidden" name="qty" value="<?php echo $row11['cart_qty']; ?>">
                                                    <b style="font-size:1.5rem;">
                                                        <?php echo $row11['cart_qty']; ?>
                                                    </b>
                                                    <button style="color:#767678;border: none; background-color:#dcdff1;"
                                                        type="submit" name="add"><i class="fa fa-plus-circle fa-lg"
                                                            aria-hidden="true"></i></button>
                                                </center>
                                            </form>
                                        </td>
                                    <tr>
                                        <td style="padding-left: 10px;color:#767678;">
                                            <?php
                                            $total += $row11['cart_qty'] * $row1['items_cost'];
                                            echo '<b>&#8377;' . $row11['cart_qty'] * $row1['items_cost'] . '</b>'; ?>
                                        </td>
                                    </tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </section>
                <?php }
            } ?>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <?php if ($i == 1) { ?>
                <div class="modal-content"
                    style=" position: fixed; bottom: 0; width: 100%; background-color: #d5d8e8;  box-shadow: -4px -4px 7px #fffdfdb7, 3px 3px 5px rgba(94, 104, 121, 0.388); border-top-left-radius: 25px;border-top-right-radius: 25px;">
                    <div class="modal-body">
                        <table>
                            <tr>
                                <th width="80%" style="padding-left:15px;color:#767678;padding-top:10px;">
                                    Cart Total
                                </th>
                                <th>
                                    <b style="color:#767678;padding-top:10px;"> &#8377;
                                        <?php echo $total; ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <th width="80%" style="padding-left:15px;color:#767678;padding-top:10px;">
                                    Delivery
                                </th>
                                <th>
                                    <b style="color:#767678;padding-top:10px;">
                                        <?php echo 'Free'; ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <th width="80%" style="padding-bottom:20px;padding-top:20px;padding-left:15px">
                                    Total Cost
                                </th>
                                <th style="padding-bottom:20px;padding-top:20px;">
                                    <b> &#8377;
                                        <?php echo $total; ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="Address">
                                        <button class="button">
                                            Checkout
                                        </button>
                                    </a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            <?php } else {
                ?>
                <a href="MyHome">
                    <div class="button" style="padding:10px;">No food in my stomach. <br><i class="fa fa-frown-o"
                            aria-hidden="true"></i></div>
                </a>

            <?php } ?>
        <?php } ?>
    </div>
    <div class="history">
        <?php if (isset($_COOKIE['inbox_id'])) {

            $user_id = $_COOKIE['inbox_id'];

            $stmt = $conn->prepare("SELECT 
            ad.address_id,
            ad.Landmark,
            ad.address,
            o.orders_id AS record_id,
            o.orders_qty AS record_qty,
            o.orders_cost AS record_cost,
            i_o.items_name AS record_item_name,
            DATE_FORMAT(o.orders_date, '%W %e, %Y') AS record_date,
            o.orders_delivered AS record_delivered,
            o.orders_accept AS record_accept
        FROM
            (
                SELECT *
                FROM address_details
                WHERE user_id = :user1
                LIMIT 7
            ) ad
        JOIN
            orders o ON ad.address_id = o.orders_address_id AND ad.user_id = o.orders_user_id
        LEFT JOIN
            items i_o ON o.orders_items = i_o.items_id
        
        UNION
        
        SELECT 
            ad.address_id,
            ad.Landmark,
            ad.address,
            h.history_id AS record_id,
            h.history_qty AS record_qty,
            h.history_cost AS record_cost,
            i_h.items_name AS record_item_name,
            DATE_FORMAT(h.history_date, '%W %e, %Y') AS record_date,
            h.history_delivered AS record_delivered,
            h.history_accept AS record_accept
        FROM
            (
                SELECT *
                FROM address_details
                WHERE user_id = :user2
                LIMIT 7
            ) ad
        JOIN
            history h ON ad.address_id = h.history_address_id AND ad.user_id = h.history_user_id
        LEFT JOIN
            items i_h ON h.history_item = i_h.items_id;
        ");
            $stmt->execute(['user1' => $user_id, 'user2' => $user_id]);
            $next_id = 0;
            foreach ($stmt as $row) {
                ?>
                <?php if ($next_id != $row['address_id']) {
                    if ($next_id != 0) {
                        ?>
                        <tr style="background-color: #caccdb;">
                            <td width="70%"
                                style=" padding:4px 10px 4px 10px;adding-bottom:20px;font: 1.2rem 'Fira Sans', sans-serif;text-transform: capitalize;">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php echo $row['address']; ?>
                            </td>
                            <td width="30%" style=" padding:4px 10px 4px 10px;">
                                <?php echo '<b>Total </b> <b style="float:right"> &#8377;' . $total . '</b>'; ?>
                            </td>
                        </tr>
                        </table>
                    </div>
                    </div>
                    </section>
                <?php }
                    $total = 0; ?>
                <section class="content" style=" min-height: 10px; padding: 10px 15px 3px 15px; ">
                        <div class="modal-content"
                            style="border-radius:15px; background-color: #dcdff1;  box-shadow: -4px -4px 7px rgba(255, 253, 253, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388); ">
                            <div class="modal-body" style="padding:10px 15px 10px 15px;">
                            <table>
                                <tr>
                                    <td width="50%" style=" font-weight:bold; font-size:20px;font: bold 20px/1 sans-serif;">Order
                                        <?php echo '#' . $row['record_id']; ?>
                                    </td>
                                    <td style="font-size:14px; float:right; color:#a29696;">
                                        <?php echo $row['record_date']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2' style="color:#9f9f9f; padding-bottom:10px; font-size:12px;">
                                        <?php if ($row['record_accept'] == 1 && $row['record_delivered'] == 0)
                                            echo '<i class="fa fa-home" aria-hidden="true"></i> Acepted order and Preparing..';
                                        elseif ($row['record_accept'] == 1 && $row['record_delivered'] == 1)
                                            echo '<i class="fa fa-gift" aria-hidden="true"></i> Delivered.'; ?>
                                    </td>
                                </tr>
                                <?php $next_id = $row['address_id'];
                } ?>
                            <tr>
                                <td width="70%"
                                    style="padding-bottom:20px;font: 1.2rem 'Fira Sans', sans-serif;text-transform: capitalize;">
                                    <?php echo '<b>' . $row['record_item_name'] . '</b>'; ?>
                                </td>
                                <td width="30%"
                                    style="color: #767678;adding-bottom:20px;font: 1.2rem 'Fira Sans', sans-serif;text-transform: capitalize;">
                                    <?php echo '<b>' . $row['record_qty'] . ' Plate</b> <b style="float:right"> &#8377;' . $row['record_qty'] * $row['record_cost'] . '</b>'; ?>
                                </td>
                            </tr>

                            <?php
                            $total += $row['record_qty'] * $row['record_cost'];
            }
            if ($next_id != 0) {
                ?>
                            <tr style="background-color: #caccdb;">
                                <td width="70%"
                                    style="padding:4px 10px 4px 10px;adding-bottom:20px;font: 1.2rem 'Fira Sans', sans-serif;text-transform: capitalize;">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <?php echo $row['address']; ?>
                                </td>
                                <td width="30%" style=" padding:4px 10px 4px 10px;">
                                    <?php echo '<b>Total </b> <b style="float:right">&#8377;' . $total . '</b>'; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
        <?php }else{?>
            <a href="MyHome">
                    <div class="button" style="padding:10px;">My stomach is empty. <br><i class="fa fa-frown-o"
                            aria-hidden="true"></i></div>
                </a>
        <?php }}
        $pdo->close();
        ?>
    </div>

</body>
<?php include 'includes/scripts.php'; ?>
<script>
    $(".history").hide();
    $(".orders_li").addClass("active");

    $(".history_li").click(function () {
        $(this).addClass("active");
        $(".orders_li").removeClass("active");
        $(".history").show();
        $(".orders").hide();
    })

    $(".orders_li").click(function () {
        $(this).addClass("active");
        $(".history_li").removeClass("active");
        $(".orders").show();
        $(".history").hide();
    })
</script>

</html>