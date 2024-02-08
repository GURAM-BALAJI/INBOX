<?php
include 'includes/session.php';
include 'includes/header.php';
?>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Inbox</title>
</head>
<style>
    body {

        font-family: 'Roboto', sans-serif;
        background-color: white;
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
        box-sizing: border-box;
    }

    .inner-container {
        display: flex;
        flex-wrap: wrap;
        margin: -1%;

    }

    .kitchen {
        flex: 0 0 calc(25% - 2%);
        background-color: white;
        box-shadow: -4px -4px 7px rgba(255, 253, 253, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388);
        /* Four kitchens per row */
        box-sizing: border-box;
        padding: 10px;
        padding-bottom: 0px;
        /* Adjusted padding to account for margin */
        border: 2px solid #ccc;
        /* Border for each kitchen */
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
            flex: 0 0 45%;
            /* One kitchen per row on smaller screens */
            margin: 2%;
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
        margin-top: 50px;
        z-index: 999;
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



    @keyframes letterDrop {
        to {
            color: black;
            /* Change text color to white at the end of the animation */
            transform: translateY(0);
        }
    }

    .kitchen-label {
        border: 0.5px solid #c4c3c3;
        margin: 10px 0 5px 10px;
        border-radius: 5px;
        padding: 10px;
        background-color: white;
        box-shadow: -4px -4px 7px rgba(255, 253, 253, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388);
        text-transform: capitalize;
        font-weight: 700;
        text-align: left;
        animation: kitchen-label 3s linear forwards;
    }

    @keyframes kitchen-label {
        0% {
            transform: translateX(-100%);
        }

        30% {
            transform: translateX(0);
        }
    }


    .movie-container {
        margin-left: 10px;
        flex: 0 0 auto;
        width: 150px;
        background-color: white;
        padding: 7px;
        margin-right: 5px;
        box-sizing: border-box;
        border-radius: 8px;
        position: relative;
        display: flex;
        flex-direction: row;
        align-items: center;
        font-weight: normal;
    }

    .movie {
        margin-left: 10px;
        flex: 0 0 auto;
        width: 150px;
        background-color: rgb(242, 241, 241);
        padding: 7px;
        margin-right: 5px;
        margin-bottom: 5px;
        box-sizing: border-box;
        border-radius: 5px;
        position: relative;
        display: flex;
        flex-direction: column;
        /* Change flex-direction to column */
        align-items: center;
        font-weight: normal;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 0.5px solid #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 200px;
        /* Fixed height */
    }

    .movie img {
        padding: 5px;
        width: 90%;
        height: 60%;
        border-radius: 8px;
    }

    .movie .price {

        display: flex;
        align-items: center;
        /* Align items vertically centered */

        flex-wrap: nowrap;
        justify-content: center;
    }

    .movie .price h2 {
        text-align: left;
        font-size: 20px;
        margin-top: 5px;
        margin-bottom: 2px;
        margin-right: 3px;
        font-weight: bold;
        flex-shrink: 0;
        /* Prevent the price from shrinking */
    }

    .movie button:hover {
        background-color: #000;
    }

    .movie .description-container {
        margin-top: 0px;
        margin-bottom: 2px;
        font-size: 12px;
        width: 90%;
        text-align: center;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        word-wrap: break-word;
        word-break: break-all;
        text-overflow: ellipsis;
        flex-grow: 1;
        font-family: 'Lato', sans-serif;
        font-weight: bold;

    }

    .movie-block-container {
        display: flex;
        overflow-x: auto;
        box-sizing: border-box;
        animation: scaleIn 1s ease;

    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
        }

        to {
            transform: scale(1);
        }
    }




    .offer-tag {
        position: absolute;
        margin-top: 15px;
        left: 14px;
        background-color: orange;
        color: white;
        padding: 3px;
        font-size: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        animation: scrollLeft 7s linear forwards;
        /* Adjust the duration and timing function as needed */
    }

    @keyframes scrollLeft {
        0% {
            transform: translateX(-100%);
        }

        30% {
            transform: translateX(0);
        }
    }

    .offer-tag1 {
        position: absolute;
        margin-top: 15px;
        left: 14px;
        background-color: orangered;
        color: white;
        padding: 3px;
        font-size: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }


    .star-ratings {
        width: 40%;
        margin-top: -11px;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        /* Align the star ratings to the bottom */
        box-sizing: border-box;
        background-color: #feb64d
            /* Background color with some transparency */
    }


    .star {
        align-items: center;
        font-size: 10px;
        color: white;
        margin-top: -2px;
        /* Add some spacing between stars */
    }

    .star-ratings-kitchen {
        margin-left: 90px;
        width: 20%;
        border-radius: 15px;
        display: flex;
        align-items: flex-end;
        box-sizing: border-box;
        justify-content: center;
        float: right;
        background-color: #feb64d;
    }

    .star-kitchen {

        align-items: center;
        font-size: 12px;
        color: white;
    }

    .buttons {
        display: inline-block;
    }

    .fa-cart-shopping {
        font-size: 25px;
        color: orange;
        margin-top: 0px;
        margin-left: 25px;
        animation: zoomInOut 5s infinite;
    }

    @keyframes zoomInOut {
        0% {
            transform: scale(0.7);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(0.7);
        }
    }
    .initial-hidden {
    display: none;
}
.admin-options {
    display: none;
}
</style>

<body>
    <!-- partial:index.partial.html -->

    <center>
        <a href="MyHome">
            <div>
                <img src="logo.png" width="100%" height="70px"
                    style="box-shadow: -4px -4px 7px rgba(255, 253, 253, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388);">
            </div>
        </a>
        <?php
        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT * FROM message");
        $stmt->execute();
        foreach ($stmt as $row) {
            if ($row['message_id'] == 1 && !empty($row['message'])) { ?>
                <marquee style="color:black;">
                    <?php echo $row['message']; ?>
                </marquee>
            <?php }
            if ($row['message_id'] == 2 && !empty($row['message'])) { ?>
                <marquee style="color:black;">
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
                                    <h2 style="color:black;">
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
            <div class="main">


                <?php
                if (isset($_GET['meal_type'])) {
                    $meal_type = $_GET['meal_type'];
                    $conn = $pdo->open();

                    $stmt = $conn->prepare("SELECT admin_id,items_image, admin_name, items_name,item_meal_type,item_commission_cost,items_id FROM admin  LEFT JOIN items ON admin_id = item_chef_id
        WHERE admin_type = 2 AND item_meal_type = :meal_type AND item_status = 1 AND items_ack = 1");
                    $stmt->execute([':meal_type' => $meal_type]);
                    $allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $displayedAdmins = [];
                    $noItemsExist = true; // Assume there are no items for any admin
            
                    foreach ($allRows as $row) {
                        $admin_id = $row['admin_id'];
                        $admin_name = $row['admin_name'];

                        if (!in_array($admin_id, $displayedAdmins)) {
                            ?>

                            <div class="kitchen-label">
                                <?php echo $admin_name; ?>
                                <div class="star-ratings-kitchen"><span class="star-kitchen">☆</span><span
                                        class="star-kitchen">☆</span><span class="star-kitchen">☆</span><span
                                        class="star-kitchen">☆</span><span class="star-kitchen">☆</span>
                                </div>
                            </div>
                            <div class="movie-block-container admin-options initial-hidden">

                                <?php
                                foreach ($allRows as $itemRow) {
                                    if ($admin_id == $itemRow['admin_id']) {
                                        $noItemsExist = false; // There are items for at least one admin
                                        ?>
                                        <div class="movie"
                                            style="background-color: white;  box-shadow: -4px -4px 7px rgba(255, 253, 253, 0.92), 3px 3px 5px rgba(94, 104, 121, 0.388);">
                                            <!-- <div class="offer-tag">5% OFF</div> -->
                                            <img src="<?php echo './items_images/' . $itemRow['items_image']; ?>" alt="Dosa">
                                            <div class="star-ratings">
                                                <span class="star">☆</span>
                                                <span class="star">☆</span>
                                                <span class="star">☆</span>
                                                <span class="star">☆</span>
                                                <span class="star">☆</span>
                                            </div>
                                            <div class="description-container ">
                                                <?php echo $itemRow['items_name']; ?>
                                            </div>
                                            <div class="price">
                                                <h2>&#8377;&nbsp;
                                                    <?php echo $itemRow['item_commission_cost']; ?>/-
                                                </h2>
                                                <a
                                                    href="AddCart?id=<?php echo $itemRow['items_id']; ?>&return_id=<?php echo $itemRow['item_meal_type']; ?>">
                                                    <div> <i class="fas fa-cart-shopping"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }

                                ?>

                            <?php
                        }
                        ?>
                    </div>
                    </div>
                    <?php
                    $displayedAdmins[] = $admin_id;
                    }
                }

                if ($noItemsExist) {
                    // Display a message if there are no items for any admin
                    ?>
                <div class="no-items-message"
                    style="text-align: center; justify-content:center;margin-top:90%; font-size:20px; color:#f17E21;">
                    Sorry, we don't have any Kitchen available today. 😔
                </div>
                <?php
                }

                $pdo->close();

                ?>
        <?php } ?>
    </section>
    <?php
    $i = 0;
    if (isset($_COOKIE['inbox_id'])) {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE cart_user_id=:user_id");
        if ($stmt->execute(['user_id' => $_COOKIE['inbox_id']]))
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
            <a class="cartimag" href="MyCart"><i class="fa fa-shopping-cart"
                    style="font-size:48px;color: #eb8334; position: relative;"></i></a>

        </div>
        <?php
    } ?>
</body>
<?php include 'includes/scripts.php'; ?>
<script>
    var movieStars = document.querySelectorAll('.star');
    var movieRated = false;

    movieStars.forEach(function (star, index) {
        star.addEventListener('click', function () {
            if (!movieRated) {
                for (var i = 0; i < movieStars.length; i++) {
                    if (i <= index) {
                        movieStars[i].textContent = '★';
                    } else {
                        movieStars[i].textContent = '☆';
                    }
                }
                movieRated = true;
            } else {
                for (var i = 0; i < movieStars.length; i++) {
                    movieStars[i].textContent = '☆';
                }
                movieRated = false;
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var adminLabels = document.querySelectorAll(".kitchen-label");
        var lastAdminLabel = adminLabels[adminLabels.length - 1]; // Get the last admin label
        var lastAdminOptions = lastAdminLabel.nextElementSibling; // Get the options for the last admin

        adminLabels.forEach(function (adminLabel) {
            var adminOptions = adminLabel.nextElementSibling;
            adminOptions.style.display = "none"; // Initially hide the admin options
            adminOptions.style.flexWrap = "wrap"; // Set flex-wrap to wrap

            adminLabel.addEventListener("click", function (event) {
                // Move the clicked admin's options below the clicked label
                adminLabel.parentNode.insertBefore(adminOptions, adminLabel.nextElementSibling);

                adminOptions.style.display = (adminOptions.style.display === "flex") ? "none" : "flex";
                event.stopPropagation();
            });

            adminOptions.addEventListener("click", function (event) {
                event.stopPropagation();
            });

            // Iterate over each movie and apply styles
            var movies = adminOptions.querySelectorAll(".movie");
            movies.forEach(function (movie) {
                movie.style.width = "calc(50% - 20px)"; // Adjust the width as needed
                movie.style.margin = "10px"; // Adjust the margin as needed
                movie.style.boxSizing = "border-box";
                movie.style.color = "";
            });
        });

        // Open the options for the last admin by default
        lastAdminOptions.style.display = "flex";
    });
</script>
<?php 
include 'footer/footer.php';
?>


</html>