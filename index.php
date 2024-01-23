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

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        border: 2px solid #fff;
        border-radius: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(254, 191, 1, 1);
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #38b6ff;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #000;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .container123456 {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .column123 {
        text-align: center;
    }

    .outer-container {
        max-width: 1000px;
        margin: 0 auto;
        box-sizing: border-box;
    }

    .inner-container {
        display: flex;
        flex-wrap: wrap;
        margin: -1%;
        /* Adjusted margin to account for padding */
    }

    .kitchen {
        flex: 0 0 calc(25% - 2%);
        background-color: #fff;
        /* Four kitchens per row */
        box-sizing: border-box;
        padding: 10px;
        /* Adjusted padding to account for margin */
        border: 2px solid #ccc;
        /* Border for each kitchen */
        margin: 1%;
        /* Added margin for space between kitchens */
        border-radius: 8px;
        position: relative;
        /* Added relative positioning */
    }

    /* Adjust styles based on your design preferences */
    .kitchen img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        /* Box shadow for each image */
        box-shadow: 0px 10px 10px rgba(183, 178, 178, 0.945);
        transition: opacity 0.3s ease-in-out;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .kitchen h2 {
        margin-top: 10px;
        font-size: 18px;
    }

    @media (max-width: 500px) {
        .inner-container {
            margin: 0.7%;
            /* Remove negative margin on smaller screens */
        }

        .kitchen {
            flex: 0 0 48%;
            /* One kitchen per row on smaller screens */
            margin: 1%;
            /* Adjusted margin for space between kitchens in mobile view */

        }

        /* Adjust styles for images in smaller screens if needed */
        .kitchen img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            /* Box shadow for each image */
            box-shadow: 0px 10px 10px rgba(183, 178, 178, 0.945);
        }

    }

    h2:hover {
        color: orange;
    }
</style>

<body>
    <!-- partial:index.partial.html -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <center>
        <div style="background-color: #333;">
            <img src="logo.png" width="100%" height="70px">
        </div>


        <div style="background-color: #001a35;color: #89E6C4;">
            <?php if (isset($_GET['meal_type'])) {
                switch ($_GET['meal_type']) {
                    case 1:
                        echo 'BREAKFAST MENU';
                        break;
                    case 2:
                        echo 'LUNCH MENU';
                        break;
                    case 3:
                        echo 'DINNER MENU';
                        break;
                    case 4:
                        echo 'SINGLES MENU';
                        break;
                    case 5:
                        echo 'SNACKS MENU';
                        break;
                    default:
                        echo 'UNKNOWN MENU';
                        break;
                }
                ;

            } else
                echo "MENU"; ?>
        </div>
        <?php
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
        <?php if (!isset($_GET['meal_type'])) { ?>
            <div class="outer-container">
                <div class="inner-container">
                    <div class="kitchen">
                        <a href="MyHome?meal_type=1">
                            <img src="menu_img/Breakfast.jpg" alt="Kitchen 1">
                            <center>
                                <h2>Breakfast</h2>
                            </center>
                        </a>
                    </div>
                    <div class="kitchen">
                        <a href="MyHome?meal_type=2">
                            <img src="menu_img/Lunch.jpeg" alt="Kitchen 2">
                            <center>
                                <h2>Lunch</h2>
                            </center>
                        </a>
                    </div>
                    <div class="kitchen">
                        <a href="MyHome?meal_type=3">
                            <img src="menu_img/Dinner.jpeg" alt="Kitchen 3">
                            <center>
                                <h2>Dinner</h2>
                            </center>
                        </a>
                    </div>
                    <div class="kitchen">
                        <a href="MyHome?meal_type=4">
                            <img src="menu_img/Singles.jpg" alt="Kitchen 4">
                            <center>
                                <h2>Singles</h2>
                            </center>
                        </a>
                    </div>
                    <div class="kitchen">
                        <a href="MyHome?meal_type=5">
                            <img src="menu_img/Snacks.jpg" alt="Kitchen 5">
                            <center>
                                <h2>Snacks</h2>
                            </center>
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="modal-content" style="background-color:rgba(255, 255, 255)">
                <div class="modal-body">
                    <?php
                    $item_meal_type = $_GET['meal_type'];
                    $stmt1 = $conn->prepare("SELECT item_chef_id, admin_name, items_id, items_name, item_status, items_image, items_cost
                    FROM items left join admin on item_chef_id=admin_id
                    WHERE item_status = :item_status AND item_meal_type=:item_meal_type
                    ORDER BY item_chef_id, items_id
                    ");
                    $stmt1->execute(['item_status' => 1, 'item_meal_type' => $item_meal_type]);
                    $CID = 0;
                    foreach ($stmt1 as $row1) {
                        if ($CID != $row1['item_chef_id']) { ?>
                            </table>
                            <table style="width: 100%;">
                                <h3
                                    style="background-color:gold; padding:2px 5px 2px 5px; border-radius: 8px; text-align: center;  ">
                                    <?php echo $row1['admin_name']; ?>
                                </h3>
                            <?php }
                        ?>

                            <form method="POST" action="AddCart">
                                <tr>
                                    <td rowspan="2" style="width:35%">
                                        <img style="border-radius:1.5rem"
                                            src="./items_images/<?php echo $row1['items_image']; ?>" height="100rem"
                                            width="100rem">
                                    </td>
                                    <td colspan="2">
                                        <?php echo "<span style='text-transform: capitalize;font-weight:bold; color:black'>" . $row1['items_name'] . "</span>"; ?>
                                    </td>
                                <tr>
                                    <td>
                                        <?php echo "<b style='font-size:2rem;'> &#8377;" . $row1['items_cost'] . "</b>"; ?>
                                    </td>
                                    <td style="width:30%">
                                        <input type="hidden" name="id" value="<?php echo $row1['items_id']; ?>">
                                        <input type="hidden" name="return_id" value="<?php echo $item_meal_type; ?>">
                                        <button name='add_cart' class='btn btn-warning btn' style="font-size:0.9rem"><i
                                                class='fa fa-cart-plust'></i>Add To Cart</button>
                                    </td>
                                </tr>

                            </form>

                            <?php if ($CID != $row1['item_chef_id']) {
                                $CID = $row1['item_chef_id'];
                            }

                    } ?>
                    </table>
                </div>
            </div>
        <?php } ?>
    </section>

    <br><br><br><br>
    <nav class="nav">

        <a href="MyHome" class="nav__link nav__link--active">
            <i class="material-icons nav__icon">home</i>
            <span class="nav__text">Home</span>
        </a>

        <a href="MyProfile" class="nav__link">
            <i class="material-icons nav__icon">person</i>
            <span class="nav__text">Profile</span>
        </a>

        <a href="MyCart" class="nav__link">
            <?php
            $i = 0;
            if (isset($_SESSION['vm_id'])) {
                $stmt = $conn->prepare("SELECT * FROM cart WHERE cart_user_id=:user_id");
                $stmt->execute(['user_id' => $_SESSION['vm_id']]);
                foreach ($stmt as $row)
                    $i++;
                ?>

            <?php }
            $pdo->close(); ?>
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
    <!-- partial -->

</body>
<?php include 'includes/scripts.php'; ?>
<?php include './includes/req_end.php'; ?>
<script>
    $("#toggleTheme").on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            document.cookie = "theme=2; Max-Age=" + 365 * 24 * 60 * 60;
        } else {
            $(this).attr('value', 'false');
            document.cookie = 'theme=; Max-Age=0';
        }
        location.reload();
    });

</script>

</html>