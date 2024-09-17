<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Lanka Travel Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-banner {
            background-color: #ffcc00;
            color: #003d34;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.2em;
        }
        .trip-card, .widget, .itinerary-card, .notifications, .support, .interactive-map, .budget-tracking {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .destination-card img {
            width: 100%;
            height: 150px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .destination-card {
            border: 2px solid #ffcc00;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
        }
        .theme-toggle {
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ffcc00;
            border-color: #ffcc00;
        }
        .btn-primary:hover {
            background-color: #e6b800;
            border-color: #e6b800;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <!-- Welcome Banner -->
    <div class="row">
        <div class="col-md-12">
            <div class="welcome-banner">
                <h1>Ayubowan, [User Name]!</h1>
                <p>Get ready to explore the beauty of Sri Lanka!</p>
            </div>
        </div>
    </div>

    <!-- Current Trip Overview & Budget Tracking -->
    <div class="row">
        <div class="col-md-6">
            <div class="trip-overview">
                <h2>Upcoming Trips</h2>
                <div class="trip-card">
                    <h3>Trip to Sri Lanka</h3>
                    <p>Date: 25th August 2024</p>
                    <p>Days Left: 5</p>
                    <p>Destinations: Colombo, Kandy, Galle</p>
                    <a href="#">View Trip Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="budget-tracking">
                <h2>Current Budget</h2>
                <p>Total Budget: LKR 30000</p>
                <p>Spent: LKR 15000</p>
                <p>Remaining: LKR 15000</p>
                <div class="spending-categories">
                    <h3>Spending Categories</h3>
                    <ul>
                        <li>Accommodation: LKR 8000</li>
                        <li>Transport: LKR 4000</li>
                        <li>Food: LKR20000</li>
                        <li>Activities: LKR 10000</li>
                    </ul>
                    <a href="#">View Detailed Budget</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Explore Destinations & Widgets -->
    <div class="row">
        <div class="col-md-8">
            <div class="explore-destinations">
                <h2>Explore Destinations</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="destination-card">
                            <img src="https://via.placeholder.com/300x150?text=Sri+Lanka+Beach" alt="Sri Lankan Beach">
                            <h4>Galle</h4>
                            <p>Historic Fort City with stunning coastal views.</p>
                            <a href="#">Explore Galle</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="destination-card">
                            <img src="https://via.placeholder.com/300x150?text=Tea+Plantations" alt="Tea Plantations">
                            <h4>Ella</h4>
                            <p>Beautiful hills and tea plantations.</p>
                            <a href="#">Explore Ella</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widgets">
                <h2>Widgets</h2>
                <div class="widget">
                    <h3>Weather in Colombo</h3>
                    <p>27°C, Sunny</p>
                </div>
                <div class="widget">
                    <h3>Travel Deals</h3>
                    <p>Save 20% on Sri Lankan Packages!</p>
                </div>
                <div class="widget">
                    <h3>Travel News</h3>
                    <p>New visa requirements for Sri Lanka</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Saved Itineraries -->
    <div class="row">
        <div class="col-md-12">
            <div class="saved-itineraries">
                <h2>My Itineraries</h2>
                <div class="itinerary-card">
                    <h3>Cultural Journey</h3>
                    <p>Destinations: Colombo, Kandy, Sigiriya</p>
                    <a href="#">Edit Itinerary</a>
                    <a href="#">Delete Itinerary</a>
                </div>
                <button class="btn btn-primary">Create New Itinerary</button>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Notifications -->
    <div class="row">
        <div class="col-md-8">
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <ul>
                    <li>Viewed Galle Beach Package on 20th August</li>
                    <li>Booked Hotel in Ella on 18th August</li>
                    <li>Reviewed Trip to Colombo on 15th August</li>
                </ul>
                <a href="#">See All Activity</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="notifications">
                <h2>Notifications & Alerts</h2>
                <ul>
                    <li>Flight to Colombo delayed by 2 hours</li>
                    <li>Reminder: Apply for Sri Lanka Visa by 22nd August</li>
                    <li>New Hotel Booking Confirmation</li>
                </ul>
                <a href="#">View All Notifications</a>
            </div>
        </div>
    </div>

    <!-- Interactive Map & Support -->
    <div class="row">
        <div class="col-md-6">
            <div class="interactive-map">
                <h2>Your Travel Map</h2>
                <img src="https://via.placeholder.com/500x300?text=Sri+Lanka+Map" alt="Travel Map" class="img-fluid">
                <a href="#">View Full Map</a>
                <a href="#">Add New Destination</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="support">
                <h2>Support & Assistance</h2>
                <p>Need help? <a href="#">Visit Help Center</a> or chat with our <a href="#">AI Chatbot</a>.</p>
                <a href="#">Join Community Forum</a>
            </div>
        </div>
    </div>

    <!-- Dark/Light Mode Toggle -->
    <div class="row">
        <div class="col-md-12">
            <div class="theme-toggle">
                <label for="theme-switch">Dark Mode:</label>
                <input type="checkbox" id="theme-switch" name="theme-switch">
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
