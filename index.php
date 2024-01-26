<?php
include 'includes/session.php';
include 'includes/header.php';
?>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Inbox</title>
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

    .outer-container {
        max-width: 1000px;
        margin-top: -30px;
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
        padding-bottom: 0px;
        /* Adjusted padding to account for margin */
        border: 2px solid #ccc;
        /* Border for each kitchen */
        margin: 1%;
        /* Added margin for space between kitchens */
        border-radius: 8px;
        position: relative;
        /* Added relative positioning */
    }

    .kitchen img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
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
        }

        .kitchen {
            flex: 0 0 48%;
            /* One kitchen per row on smaller screens */
            margin: 1%;
        }

        /* Adjust styles for images in smaller screens if needed */
        .kitchen img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

    }

    h2:hover {
        color: orange;
    }

    #cart-icon {
        position: fixed;
        bottom: 20px;
        right: 10px;
        font-size: 50px;
        color: #000;
        color: '#0f0f0f';
        animation: moveCart 2s linear infinite;
    }

    @keyframes moveCart {
        0% {
            transform: translateX();
        }

        50% {
            transform: translateX(-20px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .badge_cart {
        position: absolute;
        width: 1.1em;
        height: 1.1em;
        font-size: 20px;
        margin-left: 30px;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background-color: rgb(255, 75, 75);
        color: white;
    }

    .cartimag {
        text-decoration: none;
        font-size: 60px;
    }

</style>

<body>
    <!-- partial:index.partial.html -->

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
                    <?php
                    $stmt_categories = $conn->query("SELECT *FROM category");

                    while ($row = $stmt_categories->fetch(PDO::FETCH_ASSOC)) {
                        $image = (!empty($row['category_image'])) ? 'category_images/' . $row['category_image'] : 'category_images/noimage.jpg';
                        ?>
                        <div class="kitchen">
                            <a href="MyHome?meal_type=<?php echo $row['category_id']; ?>">

                                <img src="<?php echo $image ?>" alt="<?php echo $row['category_name']; ?> ">
                                <center>
                                    <h2>
                                        <?php echo $row['category_name']; ?>
                                    </h2>
                                </center>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
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
    <?php
    $i = 0;
    if (isset($_SESSION['vm_id'])) {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE cart_user_id=:user_id");
        if ($stmt->execute(['user_id' => $_SESSION['vm_id']]))
            $result = $stmt->fetch();
        if ($result !== false)
            $i = $result['count'];
        ?>

        <div id="cart-icon">
            <?php if ($i != 0) { ?>
                <p class="badge_cart">
                    <?php echo $i; ?>
                </p>
                <?php
            } ?>
            <a class="cartimag" href="MyCart">🍽️</a>
          
        </div>
        <?php
    } ?>
</body>
<?php include 'includes/scripts.php'; ?>

</html>