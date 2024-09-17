<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - GO SERENDIP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: #ffffff;
        }

        nav {
            width: 100%;
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-weight: bold;
            color: #ffffff;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #f8f9fa;
        }

        .hero-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            background: url('image/pexels-shaani-sewwandi-1401278-2937148.jpg') no-repeat center center/cover;
            position: relative;
            z-index: 1;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(44, 62, 80, 0.7);
            z-index: 2;
        }

        .hero-content {
            text-align: center;
            z-index: 3;
            color: #ffffff;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin: 0;
        }

        .hero-content p {
            font-size: 1.25rem;
            margin: 15px 0;
        }

        .cta-button {
            background-color: #f39c12;
            color: #ffffff;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .cta-button:hover {
            background-color: #e67e22;
        }

        .container {
            padding: 80px 15px 40px; /* Adjusted for fixed nav bar */
        }

        .featured-destinations {
            margin: 40px 0;
        }

        .destination-cards {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap; /* Allow cards to wrap on smaller screens */
        }

        .card {
            background-color: #34495e;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            flex: 1;
            min-width: 300px; /* Ensure cards don’t get too small */
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 20px;
            text-align: center;
        }

        .card-content h3 {
            color: #f39c12;
            margin-bottom: 10px;
        }

        .card-content p {
            color: #ecf0f1;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .testimonials-section {
            background-color: #34495e;
            padding: 60px 20px;
            border-radius: 15px;
            margin: 40px 0;
        }

        .testimonials-section h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 40px;
            font-size: 2.5rem;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .testimonial-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .testimonial-content img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
            object-fit: cover;
            border: 3px solid #ffffff;
        }

        .testimonial-content p {
            font-size: 1.1rem;
            color: #666666;
            margin-bottom: 15px;
        }

        .testimonial-content h3 {
            font-size: 1.2rem;
            color: #333333;
            margin-bottom: 15px;
        }

        .testimonial-interaction {
            display: flex;
            align-items: center;
            justify-content: space-around;
            width: 100%;
            margin-top: 15px;
        }

        .heart-button {
    font-size: 1.5rem;
    color: #e74c3c; /* Red color for the heart */
    cursor: pointer;
    transition: transform 0.3s, color 0.3s;
     }

.heart-button:hover {
    color: #c0392b; /* Darker red on hover */
    transform: scale(1.2); /* Slightly enlarge on hover */
}


.star-rating {
            display: inline-block;
        }

        .star {
            font-size: 1.5rem;
            color: #ffc107;
            cursor: pointer;
        }

        .star:hover,
        .star:hover ~ .star {
            color: #ddd;
        }

        footer {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top: 5px solid #f39c12;
            margin-top: auto;
        }

        .footer-columns {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            flex-wrap: wrap;
        }

        .footer-column {
            flex: 1;
            margin: 0 15px;
        }

        .footer-column h4 {
            color: #f39c12;
            margin-bottom: 15px;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: #f39c12;
        }

        .footer-socials i {
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .footer-socials i:hover {
            color: #f39c12;
        }
    </style>

</head>

<body>
    <nav>
        <ul>
            <li><a href="Home1.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>

    <div class="hero-section">
        <div class="hero-content">
            <h1>Explore the Beauty of Sri Lanka</h1>
            <p>Discover breathtaking destinations and plan your dream vacation today.</p>
            <a href="trip_planner.php" class="cta-button">Plan Your Trip</a>
        </div>
    </div>

    <div class="container">
        <section class="featured-destinations">
            <h2 class="text-center mb-4">Featured Destinations</h2>
            <div class="destination-cards">
                <div class="card">
                    <img src="image/pexels-akos-helgert-82252426-9013701.jpg" alt="Sigiriya">
                    <div class="card-content">
                        <h3>Sigiriya</h3>
                        <p>Explore the ancient rock fortress with stunning views and rich history.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="image/pexels-genine-alyssa-pedreno-andrada-1263127-2403209.jpg" alt="Ella">
                    <div class="card-content">
                        <h3>Ella</h3>
                        <p>Immerse yourself in the lush greenery and enjoy breathtaking hikes.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="image/pexels-charithk-6624969.jpg" alt="Galle">
                    <div class="card-content">
                        <h3>Galle</h3>
                        <p>Stroll through the charming streets of Galle Fort and soak in the colonial architecture.</p>
                    </div>
                </div>
            </div>
        </section>

       <section class="testimonials-section">
    <h2>What Our Clients Say</h2>
    <div class="testimonials-grid">
        <div class="testimonial-card">
            <div class="testimonial-content">
                <img src="image/icons8-avatar-80 (1).png" alt="Sarah W.">
                <p>"GO SERENDIP made planning our trip to Sri Lanka so easy and enjoyable! Highly recommend."</p>
                <h3>- Sarah W.</h3>
                <!-- Heart Button and Star Rating -->
                <div class="testimonial-interaction">
                    <span class="heart-button"><i class="fas fa-heart"></i></span>
                    <div class="star-rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span> <!-- Empty star for rating -->
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-content">
                <img src="image/icons8-avatar-80.png" alt="John D.">
                <p>"Amazing experience! The recommendations were spot on and the itinerary was perfect."</p>
                <h3>- John D.</h3>
                <div class="testimonial-interaction">
                    <span class="heart-button"><i class="fas fa-heart"></i></span>
                    <div class="star-rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-card">
            <div class="testimonial-content">
                <img src="image/icons8-avatar-80 (1).png" alt="Emily R.">
                <p>"An unforgettable experience! GO SERENDIP made everything easy and stress-free."</p>
                <h3>- Emily R.</h3>
                <div class="testimonial-interaction">
                    <span class="heart-button"><i class="fas fa-heart"></i></span>
                    <div class="star-rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    </div>

    <footer>
        <div class="footer-columns">
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact Us</h4>
                <p>Email: info@goserendip.com</p>
                <p>Phone: +94 123 456 789</p>
            </div>
            <div class="footer-column">
                <h4>Follow Us</h4>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <p>&copy; 2024 GO SERENDIP. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
