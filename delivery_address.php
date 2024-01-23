<!DOCTYPE html>
<?php
include 'includes/session.php';
$conn = $pdo->open();

// Assuming you've retrieved user ID as $id
$id = $_SESSION['vm_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = test_input($_POST["phone"]);
    $landmark = test_input($_POST["address-line-1"]);
    $address = test_input($_POST["address-line-2"]);

    try {
        $stmt = $conn->prepare("INSERT INTO address_details (phone, Landmark, address,user_id) VALUES (:phone, :landmark, :address, :user_id)");
        $stmt->execute(['phone' => $phone, 'landmark' => $landmark, 'address' => $address, 'user_id' => $id]);
        header('location: payment.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$pdo->close();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
            text-align: center;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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


        h1 {
            color: #333;
            margin-top: 20px;
        }

        .checkout-container {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .step-container {
            text-align: cenetr;
            margin-bottom: 20px;
        }

        .step {
            display: inline-block;
            margin-right: 20px;
            color: #ccc;
            font-weight: bolder;
            text-decoration: none;
        }

        .step.active {
            color: #4caf50;
        }

        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="checkout-container">
        <h1>Checkout</h1>
        <div class="step-container">
            <a href="delivery.php" class="step active">Address </a>
            <a class="step">></a>
            <a class="step">Payment</a>
        </div>

        <!-- Step 1: Delivery Address -->
        <div id="delivery-address-form" class="form-container active">
            <form method="post" action="">
                <label for="phone">Phone</label>
                <input type="text" placeholder="Enter Phone" id="phone" name="phone" required>

                <label for="address-line-1">Land Mark</label>
                <input type="text" placeholder="Enter Flat No/Appartment Name/House No" id="address-line-1"
                    name="address-line-1" required>

                <label for="address-line-2">Address</label>
                <input type="text" placeholder="Enter Area/Street/Land Mark" id="address-line-2" name="address-line-2">

                <button onclick="nextStep()">Last Step</button>
            </form>
        </div>

    </div>


</body>

</html>