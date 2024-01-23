<!DOCTYPE html>
<?php
include 'includes/session.php';
include 'includes/header.php';
?>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Vending Machine</title>
    <link rel="stylesheet" href="./style_nav_bar.css">

</head>
<style>
    body {
        background:
            <?php if (isset($_COOKIE["theme"]))
                echo "linear-gradient( to right, #c6eaff 50%, #38b6ff 50%, #c6eaff 0%, #38b6ff 0%)";
            else
                echo "linear-gradient(to right, rgba(235, 224, 232, 1) 52%, rgba(254, 191, 1, 1) 53%, rgba(254, 191, 1, 1) 100%)";
            ?>
        ;
        font-family: 'Roboto', sans-serif;
    }
    .nav__link--active {
        color:
            <?php if (isset($_COOKIE["theme"]))
                echo "#38b6ff";
            else
                echo "rgba(254, 191, 1, 1)";
            ?>
        ;
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

    h5 {
        margin-left: 10px;
        color: darkgreen;
        font-family: bold;
    }

    .hr_last {
        border-style: dot-dash;
        border-width: 4px;
        color: #181914;
        width: 98%;
    }

    div.scrollmenu {
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
    }

    div.scrollmenu a {
        display: inline-block;
        text-align: center;
        padding: 14px;
        color: white;
        text-decoration: none;
        text-decoration-color: snow;
    }

    .back_ground {
        background-color: #777;

    }

    div.scrollmenu a:hover {
        background-color: #777;
    }

    p {
        float: right;
        color: darkgray;
        margin-top: -10px;
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

    .vend_btn {
        display: inline-block;
        padding: 5px 100px 5px 100px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: orange;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px #999;
        margin-bottom: 7px;
    }

    .vend_btn:hover {
        background-color: #3e8e41
    }

    .vend_btn:active {
        background-color: #3e8e41;
        box-shadow: 0 3px #666;
        transform: translateY(4px);
    }
</style>

<body>
    <!-- partial:index.partial.html -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <center>
        <div style="background-color: #333;">
            <img src="logo.png" width="100%" height="70px">
        </div>


        <div style="background-color: #001a35;color: #89E6C4;">CART</div>
        <?php
        if (isset($_SESSION['vm_user'])) {
            $user_id = $_SESSION['vm_id'];
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
                                    <a href="Delivery">
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
                    <?php if ($i == 0) {
                        echo "<center>"; ?>
                        <?php
                        try {
                            $stmt = $conn->prepare("SELECT * FROM slogan ORDER BY RAND() LIMIT 1");
                            $stmt->execute(); ?>
                            <h4 style="font-size:30px;font-family: cursive;text-transform: capitalize;">
                                <?php
                                foreach ($stmt as $row)
                                    echo $row['slogan_sentance']; ?>
                            </h4>
                        <?php } catch (PDOException $e) {
                            $_SESSION['error'] = "Something Went Wrong.";
                        }
                        $pdo->close();
                        echo "<img src='./images/hunger.png'>";
                        echo "<h2 style='font-family: cursive;'>Order Somthing..</h2></center>";
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <center style="margin-top:20rem;">
            <?php
            $conn = $pdo->open();
            try {
                $stmt = $conn->prepare("SELECT * FROM slogan ORDER BY RAND() LIMIT 1");
                $stmt->execute(); ?>
                <h4 style="color:red;font-size:30px;font-family: cursive;text-transform: capitalize;">
                    <?php
                    foreach ($stmt as $row)
                        echo $row['slogan_sentance']; ?>
                </h4>
            <?php } catch (PDOException $e) {
                $_SESSION['error'] = "Something Went Wrong.";
            }
            $pdo->close(); ?>
            <a href="LogMe">
                <button
                    style=" background-color: #d24026; border: none; color: white; padding: 18px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 10px;">
                    LOGIN</button>
            </a>

        </center>
    <?php } ?>
    <br><br><br><br>
    <nav class="nav">

        <a href="MyHome" class="nav__link ">
            <i class="material-icons nav__icon">home</i>
            <span class="nav__text">Home</span>
        </a>

        <a href="MyProfile" class="nav__link">
            <i class="material-icons nav__icon">person</i>
            <span class="nav__text">Profile</span>
        </a>

        <a href="MyCart" class="nav__link nav__link--active">
            <?php
            $i = 0;
            if (isset($_SESSION['vm_id'])) {
                $stmt = $conn->prepare("SELECT * FROM cart WHERE cart_user_id=:user_id");
                $stmt->execute(['user_id' => $_SESSION['vm_id']]);
                foreach ($stmt as $row)
                    $i++;
                ?>

            <?php } ?>
            <div class="container_cart">
                <i class="material-icons nav__icon">shopping_cart</i>
                <?php if ($i != 0) { ?>
                    <span class="badge_cart">
                        <?php echo $i; ?>
                    </span>
                <?php } ?>
            </div>
            <span class="nav__text">Cart</span>
        </a>

        <a href="MySettings" class="nav__link">
            <i class="material-icons nav__icon">settings</i>
            <span class="nav__text">Settings</span>
        </a>

    </nav>

</body>
<?php include './cart_module.php'; ?>
<?php include 'includes/scripts.php'; ?>
<script>
    $(function () {
        $(document).on('click', '.buy', function (e) {
            e.preventDefault();
            $('#buy').modal('show');
        });
        $(document).on('click', '.history', function (e) {
            e.preventDefault();
            $('#history').modal('show');
        });
    });
</script>
<?php include './includes/req_end.php'; ?>

</html>