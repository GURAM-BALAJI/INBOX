<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
$_SESSION['success'] = "Order Placed Successfully. ";
?>
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

        .success-container {
            text-align: center;
            padding: 10px;
            border-radius: 2%;
        }

        #success-animation {
            width: 350px;
            height: 300px;
        }

        #additional-gif {
            width: 100px;
            height: 100px;
        }

        #success-message {
            display: inline-block;
            margin-right: 5px;
            font-size: 10px;
            color: #F17E21
        }

        .text {
            color: black;
            font-weight: bolder;
        }

        @keyframes letter {
            0% {
                font-size: 30px;
            }
            50% {
                font-size: 40px;
            }
            100% {
                font-size: 30px;
            }
        }

        .letter {
            animation: letter 1s infinite;
        }

        .success-container .letter a {
            text-decoration: none;
            color: #F17E21;
        }

        .letter1 {
            animation-delay: 0s;
        }

        .letter2 {
            animation-delay: -0.9s;
        }

        .letter3 {
            animation-delay: -0.8s;
        }

        .letter4 {
            animation-delay: -0.7s;
        }

        .letter5 {
            animation-delay: -0.6s;
        }

        .letter6 {
            animation-delay: -0.5s;
        }

        .letter7 {
            animation-delay: -0.4s;
        }

        .letter8 {
            animation-delay: -0.3s;
        }

        .letter9 {
            animation-delay: -0.2s;
        }

        .letter10 {
            animation-delay: -0.1s;
        }

        @keyframes moveRight {
            0% {
                transform: translateX(-100%);
            }

            45% {
                transform: translateX(0);
            }

            55% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(100%);
            }
        }

        #success-animation.move {
            animation: moveRight 4s forwards; /* Changed duration to 4s */
        }


    </style>
</head>

<body>
    <div class="success-container">
        <a href="MyHome" id="myLink">
        <img id="success-animation" src="Delivery.webp"
            alt="Order Placed Successfully">
        <br>
        <p id="success-message">
            
            <span class="letter letter1">Y</span>
            <span class="letter letter2">o</span>
            <span class="letter letter3">u</span>
            <span class="letter letter4">r</span>
            &nbsp;
            <span class="letter letter5">O</span>
            <span class="letter letter6">r</span>
            <span class="letter letter7">d</span>
            <span class="letter letter8">e</span>
            <span class="letter letter9">r</span>
            &nbsp;
            <span class="letter letter10">P</span>
            <span class="letter letter11">l</span>
            <span class="letter letter12">a</span>
            <span class="letter letter13">c</span>
            <span class="letter letter14">e</span>
            <span class="letter letter15">d</span>
        
        </p>
    </a>
    </div>

    <script>
        // Add the class to trigger the animation
        document.getElementById("success-animation").classList.add("move");

        // Redirect after 5 seconds
        setTimeout(function () {
            window.location.href = "MyHome";
        }, 3000);

        // Redirect after 3 seconds when hyperlink is clicked
        document.getElementById("myLink").onclick = function (event) {
            // Prevent the default action of the link
            event.preventDefault();
            // Add the class to trigger the animation
            document.getElementById("success-animation").classList.add("move");
            // Redirect after 3 seconds
            setTimeout(function () {
                window.location.href = "MyHome";
            }, 1000);
        };
    </script>
</body>

</html>