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
        background-color: white;
    }

    @import url(‘https://fonts.googleapis.com/css?family=Josefin+Sans’);

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        list-style: none;
        text-decoration: none;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    .button {
        border-radius: 5px;
        font-size: 17px;
        font-weight: 700;
        box-shadow: -4px -4px 7px rgba(204, 204, 204, 0.42), 3px 3px 5px rgba(96, 96, 96, 0.16);
        background: #F17E21;
        border: none;
        padding: 12px;
        text-align: center;
        width: 100%;
        font-family: sans-serif;
        margin-bottom: 20px;
    }

    .button:hover {
        box-shadow: inset -3px -3px 7px #ffffffb0,
            inset 3px 3px 5px rgba(11, 11, 11, 0.69);
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
        color: #F17E21;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        position: relative;
        transition: all 0.5s ease;
    }

    .tabs ul li.active {
        background: #fff;
        color: rgba(0, 0, 0, 0.76);
        box-shadow: inset 2px 2px 5px #b0b4c4,
            inset -5px -5px 10px #ffffff73;
    }

    .history {
        display: none;
    }

    .form-popup {
        display: none;
        position: fixed;
        align-items: center;
        justify-content: center;
        top: 7%;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.79);
        z-index: 999;
        transform: translateY(-10%);  

    }

    .form-container {
        width: 300px;
        align-items: center;
        justify-content: center;
        margin-top: 25%;
        margin-left: auto;
        margin-right: auto;
        border-radius: 10px;
        padding: 30px 35px 40px;
        background-color: white;
        box-sizing: border-box;
        position: relative;
    }

    label {
        display: block;
        margin-top: 15px;
        margin-bottom: 5px;
        font-size: 15px;
        font-weight: 500;
    }

    .form-container input[type=text],
    .form-container input[type=password],
    .form-container input[type=number],
    .form-container textarea
     {
        width: 100%;
        display: block;
        height: 43px;
        padding: 15px;
        margin-top: 8px;
        margin-bottom: 15px;
        border: #000;
        border-radius: 3px;
        width: 100%;
        font-size: 14px;
        font-weight: 500;
        padding: 10px;
        padding-left: 15px;
        background-color: rgba(22, 22, 22, 0.07);
        box-shadow: inset 2px 2px 5px #babecc, inset -5px -5px 10px #ffffff73;
    }

    ::placeholder {
        color: #000000;
    }

    .form-container .btn {
        padding: 5px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        font-size: 25px;
        box-shadow: -4px -4px 7px #fffdfdb7, 3px 3px 5px rgba(94, 104, 121, 0.388);
        margin-top: 10px;
        margin-bottom: 10px;
        background: white ;
        opacity: 0.8;
        font-weight: 700px;
        color: #000;
    }

    .text {
        font-size: 16px;
        color: #000000;
        font-weight: 800px;
        text-align: center;
        margin-bottom: 30px;
    }
    ::placeholder {
  color:rgba(105, 106, 109, 0.39);
</style>

<body>
    <div class="modal-content"
        style=" position: fixed; top: 0; width: 100%; background-color: white;  box-shadow: -4px -4px 7px #fffdfdb7, 3px 3px 5px rgba(94, 104, 121, 0.388); height:105px; z-index: 999;">
        <div class="modal-body" style="padding:0px 0px 0px 0px;">
            <a href="MyHome">
                <center>
                    <h3 style="font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;">CART</h3>
                </center>
            </a>
            <div class="tabs">
                <ul>
                    <a href="MyHome">
                        <li style="width:20%;padding-left:20px;padding-right:20px;"><i class="fa fa-chevron-left"
                                aria-hidden="true"></i></li>
                    </a>
                    <li style="width:50%;" class="orders_li">Cart Items</li>
                    <li style="width:50%;" class="history_li">Order History</li>
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
                $stmt1 = $conn->prepare("SELECT * FROM items left join admin on admin_id=item_chef_id WHERE items_id=:items_id");
                $stmt1->execute(['items_id' => $items_id]);
                foreach ($stmt1 as $row1) {
                    ?>
                    <section class="content" style=" min-height: 10px; padding: 10px 15px 3px 15px; ">
                        <div class="modal-content"
                            style="border-radius:15px; background-color: #fff;  box-shadow: -4px -4px 7px rgba(224, 220, 220, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388); ">
                            <div class="modal-body" style="padding:10px 15px 10px 15px;">
                                <b style="color: #f17E21;">
                                    <?php echo "Kitchen: "; ?>
                                </b>
                                <b style="text-transform: capitalize; border-radius:8px;padding:4px;color:#000;">
                                    <?php echo $row1['admin_name']; ?>
                                </b>
                                <table style="width: 100%;">

                                    <tr>
                                        <td rowspan="2" width="20%"> <img style=" border-radius: 10px; "
                                                src="./items_images/<?php echo $row1['items_image']; ?>" height="60px" width="60px">
                                        </td>

                                        <td width="50%" style="padding-left: 10px;">
                                            <?php echo "<span style='text-transform: capitalize; color:black'>" . $row1['items_name'] . "</span>"; ?>
                                        </td>
                                        <td rowspan="2" width="35%">
                                            <form method="POST" action="Minus">
                                                <center>
                                                    <input type="hidden" name="id" value="<?php echo $row11['cart_id']; ?>">
                                                    <?php if ($row11['cart_qty'] == '1') { ?>
                                                        <button style="color:#F17E21;border: none; background-color:#fff;"
                                                            type="submit" name="remove"><i style="font-size:20px"
                                                                class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                                    <?php } else { ?>
                                                        <button style="color:#000;border: none; background-color:#fff;"
                                                            type="submit" name="minus"><i style="font-size:20px"
                                                                class="fa fa-minus-circle fa-lg" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    <input type="hidden" name="qty" value="<?php echo $row11['cart_qty']; ?>">
                                                    <b style="font-size:1.5rem;font-size:15px;margin:0px 5px 0px 5px">
                                                        <?php echo $row11['cart_qty']; ?>
                                                    </b>
                                                    <button style="color:#3d981e;border: none; background-color:#fff;"
                                                        type="submit" name="add"><i style="font-size:20px"
                                                            class="fa fa-plus-circle fa-lg" aria-hidden="true"></i></button>
                                                </center>
                                            </form>
                                        </td>
                                    <tr>
                                        <td style="padding-left: 10px;">
                                            <?php
                                            $total += $row11['cart_qty'] * $row1['item_commission_cost'];
                                            echo '&#8377;' . $row11['cart_qty'] * $row1['item_commission_cost'] . '/-'; ?>
                                        </td>
                                    </tr>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </section>
                <?php }
            } ?>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <?php if ($i == 1) { ?>
                <div class="modal-content"
                    style=" position: fixed; bottom: 0; width: 100%; background-color:#fff;box-shadow: -4px -4px 7px rgba(155, 155, 155, 0.72), 3px 3px 5px rgba(174, 174, 175, 0.39); border-top-left-radius: 25px;border-top-right-radius: 25px;">
                    <div class="modal-body">
                        <table>
                            <tr>
                                <th width="80%" style="padding-left:15px;color:#000;padding-top:10px;">
                                    Item Total
                                </th>
                                <th>
                                    <b style="color:#000;padding-top:10px;">
                                        <?php echo '&#8377;' .$total.'/-'; ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <th width="80%" style="padding-left:15px;color:#000;padding-top:10px;">
                                    Tax
                                </th>
                                <th>
                                    <b style="color:#000;padding-top:10px;">
                                        <?php
                                        $tax = $total * 5 / 100;
                                        echo '&#8377;' . $tax.'/-';
                                        $total += $tax;
                                        ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <th width="80%" style="padding-left:15px;color:#000;padding-top:10px;">
                                    Delivery
                                </th>
                                <th>
                                    <b style="color:#000;padding-top:10px;">
                                        <?php
                                        $stmt1 = $conn->prepare("SELECT `message` FROM `message` WHERE `message_id`=:id");
                                        $stmt1->execute(['id' => 3]);
                                        foreach ($stmt1 as $row1)
                                            $delivery = $row1['message'];
                                        if (!isset($delivery) || $delivery == 0)
                                            echo "Free";
                                        else {
                                            echo '&#8377;' . $delivery.'/-';
                                            $total += $delivery;
                                        } ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" style="">
                                <hr style=" border: .5px solid #2f2f2f; ">
                                </th>
                            </tr>
                            <tr>
                                <th width="80%" style="padding-bottom:20px;padding-left:15px; color:#000">
                                    Total
                                </th>
                                <th style="padding-bottom:20px;color:#3d981e">
                                    <b> 
                                        <?php echo '&#8377;' .$total.'/-'; ?>
                                    </b>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button style="color: #ffffff; " class="button" onclick="openForm()">
                                       Place your Order
                                    </button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            <?php } else {
                ?>
                <a href="MyHome">
                    <div class="button" style="padding:10px;background-color:white;">No food in my stomach. <br><i class="fa fa-frown-o"
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
                    style="border-radius: 15px; background: #fff; box-shadow: -4px -4px 10px rgba(148, 146, 142, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388); border:0.5px solid black">
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
                                            echo '<i class="fa fa-home" aria-hidden="true"></i> Order Placed..';
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
                            <tr style="">
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
        <?php } else { ?>
            <a href="MyHome">
                <div class="button" style="padding:10px;background-color:white;">My stomach is empty. <br><i class="fa fa-frown-o"
                        aria-hidden="true"></i></div>
            </a>
        <?php }
        }
        $pdo->close();
        ?>
    </div>
    <div class="form-popup" id="myForm">
        <form action="Address" method="POST" class="form-container">


            <div class="text">
                <h1><p style="font-size: 30px;">Delivery Details</p></h1>
            </div>

            <label for="Name">Name</label>
            <input type="text" placeholder="Enter Your name." id="username" name="username" required>

            <label for="phone">Contact</label>
            <input type="number" placeholder="Enter Your Contact Number" id="phone" name="phone" required>

            <label for="address-line-2">Address</label>
            <textarea id="address-line-2" name="address-line-2"  rows="4" cols="50" style=" height: 60px;"
                required>

            </textarea>

            <label for="address-line-1">Land Mark</label>
            <input type="text" placeholder="Enter Your Land Mark" id="address-line-1"
                name="address-line-1" required>
                
            <button type="submit" style=" background: #F17E21;font-size: 20px;color: #ffffff;" class="button">Procced To Pay</button>

        </form>
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

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
  
</script>

</html>