<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <?php
    include '../includes/session.php';
    $conn = $pdo->open();
    $id = $_SESSION['vm_id'];
    $total = 0;
    $stmt_check = $conn->prepare("SELECT items_cost,cart_qty FROM cart left join items on items_id=cart_items_id WHERE cart_user_id=:cart_user_id");
    $stmt_check->execute(['cart_user_id' => $id]);
    foreach ($stmt_check as $row_check)
        $total += $row_check['cart_qty'] * $row_check['items_cost'];
    $pdo->close();
    ?>

    <script>
        $(document).ready(function () {
            makePayment();
        });

        function showMessage(message, type, duration) {
            var messageContainer = $('#message-container');
            messageContainer.empty();
            var messageElement = $('<div>').text(message).addClass(type + '-message');
            messageContainer.append(messageElement);

            var countdown = duration / 1000; // Convert milliseconds to seconds
            var countdownInterval = setInterval(function () {
                countdown--;
                messageElement.text(message + ' Redirecting in ' + countdown + ' seconds...');
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = '../index.php';
                }
            }, 1000);
        }

        function makePayment() {
            var amount = <?php echo $total; ?>;

            $.ajax({
                method: 'POST',
                url: 'create_order.php',
                data: {
                    amount: amount
                },
                success: function (response) {
                    var options = {
                        key: 'rzp_test_orBgvTJ5F1VDkd',
                        amount: amount * 100,
                        currency: 'INR',
                        order_id: response.order_id,
                        handler: function (response) {
                            // Determine the action based on the payment response
                            var action = (response.razorpay_payment_id) ? 'store' : 'cancel';

                            $.ajax({
                                method: 'POST',
                                url: 'store_transaction.php',
                                data: {
                                    order_id: response.razorpay_order_id,
                                    payment_id: response.razorpay_payment_id,
                                    amount: amount,
                                    action: action // Include the action parameter
                                },
                                success: function () {
                                    if (action === 'store') {
                                        window.location.href = '../successfull.php';
                                    } else if (action === 'cancel') {
                                        showMessage('Payment canceled by user.', 'error', 5000);
                                        setTimeout(function () {
                                            window.location.href = '../index.php';
                                        }, 5000); // 5 seconds delay
                                    }
                                },
                                error: function () {
                                    showMessage('Payment failed. Please try again.', 'error', 5000);
                                    setTimeout(function () {
                                        window.location.href = '../index.php';
                                    }, 5000); // 5 seconds delay
                                }
                            });
                        },
                        modal: {
                            ondismiss: function () {
                                showMessage('Your Payment canceled.Try again....', 'error', 5000);
                                // Include the action parameter for canceled payment
                                $.ajax({
                                    method: 'POST',
                                    url: 'store_transaction.php',
                                    data: {
                                        order_id: response.razorpay_order_id,
                                        payment_id: response.razorpay_payment_id,
                                        amount: amount,
                                        action: 'cancel' // Include the action parameter
                                    },
                                    success: function () {
                                        setTimeout(function () {
                                            window.location.href = '../index.php';
                                        }, 5000); // 5 seconds delay
                                    },
                                    error: function () {
                                        setTimeout(function () {
                                            window.location.href = '../index.php';
                                        }, 5000); // 5 seconds delay
                                    }
                                });
                            }
                        }
                    };

                    var rzp = new Razorpay(options);
                    rzp.open();
                }
            });
        }
    </script>

</body>

</html>