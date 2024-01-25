<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>/</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: white;
        }

        #success-container {
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-shadow: 5px 5px 10px 5px rgb(168, 168, 168);
        }

        #success-animation {
            width: 300px;
            height: 250px;
            border-radius: 15px;
            box-shadow: 5px 5px 5px 0px rgba(218, 151, 131, 0.776);
        }

        #additional-gif {
            width: 100px;
            height: 100px;
        }

        #success-message {
            display: inline-block;
            margin-right: 5px;
            font-size: 24px;
            color: rgb(14, 191, 14);
        }

        /* Style the anchor */
        #additional-gif-link {
            text-decoration: none;
            color: inherit; /* Inherit text color from parent */
            cursor: pointer; /* Change cursor to pointer on hover */
        }
    </style>
</head>

<body>
    <div id="success-container">
        <a id="additional-gif-link" href="index.php">
            <img id="success-animation" src="Delivery.gif" alt="Order Placed Successfully">
        </a>
        <br>
        <a id="additional-gif-link" href="MyHome">
            <img id="additional-gif" src="done.gif" alt="Additional GIF">
        </a>
        <br>
        <p id="success-message">Your order has <br>Been placed successfully!</p>
    </div>
</body>
</html>