
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Project Name</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;

            /* Adjust according to the header height */

            /* Adjust according to the footer height */
        }

        footer {
            background: linear-gradient(to right, #ff8c00c7, rgba(108, 101, 99, 0.4));
            color: #ffffff;
            padding: 30px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer-logo {
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            /* Remove default text decoration */
        }

        .footer-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #ffffff;
            border-bottom: 2px solid #fbfbfb89;
            box-shadow: 15px 14px 16px rgba(0, 0, 0, 0.1);



        }

        .footer-links {
            list-style: none;
            padding: 0;
            font-size: 14px;
        }

        .footer-links li {
            display: inline;
            margin-right: 15px;
        }

        .footer-links a:hover {
            text-decoration: underline;
            color: #495057;
        }

        .social-icons {
            font-size: 24px;
            margin-right: 15px;
            color: #ffffff;
        }

        .fa-youtube {
            color: #ffffff;
            /* Change YouTube icon color to white */
        }


        .feedback-box {
            padding: 10px;
            border-radius: 15px;
            margin-top: 10px;


        }

        .feedback-form {
            display: flex;
            flex-direction: column;

        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #ffffff;
            margin-bottom: 5px;

        }

        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #ffffff;
            color: #495057;
        }

        .submit-btn {
            background-color: #ff8c00;
            color: #ffffff;
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            border-radius: 20px;


        }

        .submit-btn:hover {
            background-color: #ff5722;
        }



        .home-about-contact a {
            color: #ffffff;
            text-decoration: none;
        }

        .home-about-contact a:hover {
            text-decoration: underline;
        }

        .footer-logo {
            font-family: 'Arial', sans-serif;
            text-align: center;
            position: relative;
            transform: translateY(-50%);
            font-size: 24px;
            color: #ffffff;
            text-decoration: none;
            transition: font-size 0.1s ease-in-out, color 0.3s ease-in-out;
            opacity: 0;
            /* Initially hidden */
            display: inline-block;

        }

        .footer-logo.active {
            opacity: 1;
        }

        p {
            font-size: 15px;
            margin-bottom: 0.1rem;
            animation: animate__flip 1s ease-out;
        }

        .custom-duration1 {
            animation-duration: 2s;
            /* Adjust the duration as needed */
        }

        .custom-duration2 {
            animation-duration: 3s;
            /* Adjust the duration as needed */
        }

        .custom-duration3 {
            animation-duration: 4s;
            /* Adjust the duration as needed */
        }

        .col-md-4 {
            margin-bottom: 12px;
        }

        /* Add the following styles to your existing styles or create a new section for testimonials */

        .testimonial-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-top: 2px solid #fbfbfb89;
        }

        .testimonial {
            /* background: linear-gradient(to right, #ffffff70, #ffffff);  /*Gradient background  */

            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 30px;
            text-align: center;
            color: #ffffff;
            font-style: italic;
            font-weight: bold;

        }

        .testimonial-content {
            font-style: italic;
            /* Italicize the testimonial text */
        }

        /* Animation for testimonials */
        .animate__animated {
            animation-duration: 1s;
        }

        #banner {
            width: 90%;
            /* Adjust the width as needed */
            max-width: 900px;
            height: 200px;
            overflow: hidden;
            position: relative;
            border: 3px solid orange;
            /* Orange border */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* Glow effect */
            margin: 0 auto;
            margin-top: 30px;
            

        }
.caption{
    margin-bottom: 50px;
}
        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1s ease;
            position: absolute;

        }

        #controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            z-index: 999;
        }

        .control {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            color: black;
            font-size: 20px;
            transition: background-color 0.3s;
        }

        .control:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }

        .dot {
            width: 10px;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .active1 {
            background-color: white;
        }
    </style>
</head>

<body>
   

    <div id="banner">
        <img class="banner-img" src="https://source.unsplash.com/random/800x600/?food" alt="Food Banner">
        <img class="banner-img" src="https://source.unsplash.com/random/800x600/?recipe" alt="Food Banner">
        <img class="banner-img" src="https://source.unsplash.com/random/800x600/?chef" alt="Food Banner">
        <img class="banner-img" src="https://source.unsplash.com/random/800x600/?restaurant" alt="Food Banner">
        <img class="banner-img" src="https://source.unsplash.com/random/800x600/?dessert" alt="Food Banner">
        <div id="controls">
            <div class="control" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></div>
            <div class="control" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="dots"></div>
    </div>
    <div class="caption">
        <h2 style="color: black; text-align:center; font-weight:bold; font-size: 20px;">Homegrown Happiness</h2>
    </div>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-img');
        const dotsContainer = document.querySelector('.dots');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.transform = `translateX(${(i - index) * 100}%)`;
            });
            updateDots(index);
            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function updateDots(index) {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < slides.length; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                if (i === index) {
                    dot.classList.add('active1');
                }
                dotsContainer.appendChild(dot);
            }
        }

        // Auto slide
        setInterval(nextSlide, 5000); // Change slide every 5 seconds
    </script>
    <script>
        const phrases = [
            '<i class="fas fa-utensils"></i> INBOX FOOD',
            '<i class="fas fa-home"></i> HOME FOOD',
            '<i class="fas fa-carrot"></i> HEALTHY FOOD'
        ];

        let index = 0;

        function updateText() {
            document.getElementById("logo").innerHTML = phrases[index];
            document.getElementById("logo").classList.add("active");
            index = (index + 1) % phrases.length;
        }

        setInterval(updateText, 2000); // Change phrase every 2 seconds
    </script>

    <!-- Content of your webpage goes here -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4"><a href="#" class="footer-logo" id="logo"><i class="fas fa-utensils"></i> INBOX
                        FOOD</a>

                    <h6 class="footer-heading animate_animated animate_bounceInLeft custom-duration1">Contact
                        Information</h6>
                    <p class="animate_animated animate_zoomInDown ">Email:
                        your@email.com</p>
                </div>
                <div class="col-md-4">
                    <h6 class="footer-heading animate_animated animate_bounceInLeft custom-duration2">Pages</h6>
                    <ul class="footer-links animate_animated animate_zoomInDown">
                        <li class="home-about-contact "><a href="MyHome">Home</a></li>
                        <li class="home-about-contact"><a href="Footer/About.html">About
                                Us</a></li>
                        <li class="home-about-contact"><a href="Footer/help/form.php">Help &
                                Support</a></li>
                        <li class="home-about-contact "><a href="Footer/Return Policy.html">Return
                                Policy</a></li>
                        <li class="home-about-contact"><a href="Footer/Cancellations.html">Cancellation & Refund</a></li>
                        <li class="home-about-contact"><a href="footer/Shipping.html">Shipping
                                Policy</a></li>
                                
                        <li class="home-about-contact"><a href="footer/Privacy Policy.html">Privacy & Policy
                            </a></li>
                        <li class="home-about-contact"><a href="footer/Terms & Conditions.html">Terms & Conditions
                            </a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-heading animate_animated animate_bounceInLeft custom-duration3">Connect
                        with Us</h5>
                    <a href="#" class="social-icons animate_animated animate_zoomInDown"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icons animate_animated animate_zoomInDown"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icons animate_animated animate_zoomInDown"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icons animate_animated animate_zoomInDown"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Feedback box -->
            <div class="row feedback-box">
                <div class="col-md-6 offset-md-3">
                    <h4>Feedback</h4>
                    <form class="feedback-form">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder=" Dish out your Feedback!">
                        </div>

                        <button type="submit" class="submit-btn">Submit
                            Feedback</button>
                    </form>
                </div>
            </div>

            <!-- Image container -->

            <hr>

            <!-- Testimonials section -->
            <div class="row testimonials">
                <div class="col-md-12">
                    <h4>User Testimonials</h4>
                    <div class="testimonial-container">
                        <div class="testimonial">
                            <p>"Great app! Loved the variety of dishes and the quick delivery."</p>
                            <p>- Happy Customer</p>
                        </div>
                        <!-- Add more testimonials as needed -->
                        <div class="testimonial">
                            <p>"Inbox Food has truly made my life easier. The variety of dishes and the quick delivery service are outstanding! Highly recommended."</p>
                            <p>- Happy Customer</p>
                        </div>
                        <div class="testimonial">
                            <p>" appreciate the quality and freshness of the ingredients used in Inbox Food.."</p>
                            <p>- Happy Customer</p>
                        </div>
                        <!-- Add more testimonials as needed -->
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <!-- Copyright information -->
        <div class="row1" style="text-align: center;">
            <div class="col-md-12 text center " style="width: 100%;">
                <p>&copy; 2024 INBOX FOOD. All rights reserved.</p>
            </div>
        </div>
        </div>
    </footer>
    <script>
        $(document).ready(function() {
            let currentIndex = 0;
            const testimonials = $('.testimonial');

            function showTestimonial(index) {
                testimonials.hide().eq(index).fadeIn();
            }

            function nextTestimonial() {
                currentIndex = (currentIndex + 1) % testimonials.length;
                showTestimonial(currentIndex);
            }

            function autoSlide() {
                nextTestimonial();
            }

            setInterval(autoSlide, 2000); // Change testimonial every 2 seconds
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>