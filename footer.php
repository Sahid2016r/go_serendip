<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        .footer {
            background-color: #00796b;
            color: #ffffff;
            padding: 20px 0;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 15px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .footer .social-icons i {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #ffffff;
        }
        .footer .social-icons i:hover {
            color: #007bff;
        }
        .footer .contact-info {
            margin-bottom: 20px;
        }
        .footer .contact-info p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> 123 Travel St, Wanderlust City, WT 12345</p>
                        <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:info@goserendip.com">info@goserendip.com</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <a href="home1.php">Home</a>
                    <a href="about.php">About</a>
                    <a href="contact.php">Contact</a>
                    <a href="privacy_policy.php">Privacy Policy</a>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <p>&copy; <?php echo date('Y'); ?> GO SERENDIP. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
