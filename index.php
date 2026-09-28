<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kashinathan Travels</title>

    <link rel="stylesheet" href="style.css">

<style>
/* Owner and Staff display fix */
.team-selector {
    display: block !important;
    padding: 70px 6% !important;
    background: #102a2a !important;
    color: white !important;
}

.team-buttons {
    display: flex !important;
    justify-content: center !important;
    gap: 15px !important;
    margin: 25px 0 35px !important;
}

.team-tab {
    display: inline-block !important;
    padding: 14px 30px !important;
    background: #c49a52 !important;
    color: #102a2a !important;
    border: 2px solid #c49a52 !important;
    border-radius: 30px !important;
    cursor: pointer !important;
    font-weight: bold !important;
}

.team-content {
    display: none !important;
    max-width: 1100px !important;
    margin: 0 auto !important;
}

.team-content.active {
    display: block !important;
}

.owner-card {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 35px !important;
    padding: 30px !important;
    background: #183b3b !important;
    border-radius: 20px !important;
}

.owner-card img {
    width: 260px !important;
    height: 300px !important;
    object-fit: cover !important;
    border-radius: 18px !important;
}

.staff-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)) !important;
    gap: 25px !important;
}

.staff-card {
    padding: 22px !important;
    text-align: center !important;
    background: #183b3b !important;
    border-radius: 20px !important;
}

.staff-card img {
    width: 220px !important;
    height: 250px !important;
    object-fit: cover !important;
    border-radius: 16px !important;
}

@media (max-width: 600px) {
    .owner-card {
        flex-direction: column !important;
        text-align: center !important;
    }

    .owner-card img {
        width: 220px !important;
        height: 260px !important;
    }

    .staff-card img {
        width: 180px !important;
        height: 210px !important;
    }
}
</style>

</head>

<body>

    <!-- NAVBAR -->

    <header class="navbar">

    <div class="logo">
        <span>✦</span>
        <h2>Kashinathan Travels</h2>
        <small>EXPLORE • TRAVEL • DISCOVER</small>
    </div>

    <nav id="navMenu">
        <a href="#home">HOME</a>
        <a href="#about">ABOUT</a>
        <a href="#vehicles">VEHICLES</a>
        <a href="#packages">PACKAGES</a>
        <a href="#gallery">GALLERY</a>
        <a href="#contact">CONTACT</a>
    </nav>

    <a href="booking.php" class="book-btn">BOOK NOW</a>

    <button class="menu-btn" onclick="toggleMenu()">
        ☰
    </button>

</header>


    <!-- HERO -->

    <section class="hero" id="home">

        <div class="hero-content">

            <div class="stars">✦ ✦ ✦ ✦ ✦</div>

            <h1>TRAVEL</h1>

            <p>WORLD TRAVEL EXPERIENCE</p>

            <div class="hero-line"></div>

            <h3>Discover • Journey • Memories</h3>

        </div>

    </section>


    <!-- MAIN INTRO -->

    <section class="welcome" id="about">

        <div class="welcome-card">

            <div class="welcome-text">

                <span class="section-label">WELCOME</span>

                <h2>Travel With<br>Kashinathan Travels</h2>

                <p>
                    Welcome to Kashinathan Travels, your trusted travel
                    partner for comfortable and memorable journeys.
                    Explore beautiful destinations, choose your perfect
                    vehicle and plan your next adventure with us.
                </p>

                <a href="#vehicles" class="outline-btn">
                    EXPLORE MORE →
                </a>

            </div>


            <div class="booking-preview">

                <span class="section-label">BOOKING</span>

                <h2>Plan Your Journey</h2>

                <div class="destination-images">

                    <div class="destination">
                        <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=500&q=80">
                        <span>Explore</span>
                    </div>

                    <div class="destination">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=500&q=80">
                        <span>Discover</span>
                    </div>

                    <div class="destination">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=500&q=80">
                        <span>Relax</span>
                    </div>

                </div>

                <a href="booking.php" class="book-link">
                    BOOK YOUR JOURNEY →
                </a>

            </div>

        </div>

    </section>


    <!-- VEHICLES -->

    <section class="vehicles" id="vehicles">

        <div class="section-title">

            <span>OUR FLEET</span>

            <h2>Choose Your Ride</h2>

            <p>
                Comfortable vehicles for every kind of journey.
            </p>

        </div>


        <div class="vehicle-grid">

            <div class="vehicle-card">

                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=700&q=80">
                </div>

               <h3>49 Seat Bus</h3>

                <p>Perfect for group journeys</p>

                <a href="vehicle_details.php">VIEW DETAILS →</a>

            </div>


            <div class="vehicle-card">

                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=700&q=80">
                </div>

                <h3>17 Seat Traveller</h3>

                <p>Comfortable family travel</p>

                <a href="#">VIEW DETAILS →</a>

            </div>


            <div class="vehicle-card">

                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=700&q=80">
                </div>

                <h3>Car</h3>

                <p>Easy and private journeys</p>

                <a href="#">VIEW DETAILS →</a>

            </div>

        </div>

    </section>


    <!-- PACKAGES -->

    <section class="packages" id="packages">

        <div class="section-title">

            <span>DESTINATIONS</span>

            <h2>Explore Beautiful Places</h2>

            <p>
                Discover unforgettable destinations with Kashinathan Travels.
            </p>

        </div>


        <div class="package-grid">

            <div class="package-card">
                <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=800&q=80">
                <h3>Mountain Escapes</h3>
                <p>Peaceful hills & beautiful views</p>
            </div>

            <div class="package-card">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80">
                <h3>Beach Holidays</h3>
                <p>Relax by the beautiful coast</p>
            </div>

            <div class="package-card">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80">
                <h3>Nature Trips</h3>
                <p>Experience the beauty of nature</p>
            </div>

        </div>

    </section>


    <!-- GALLERY -->

    <section class="gallery" id="gallery">

        <div class="section-title">

            <span>OUR MEMORIES</span>

            <h2>Previous Trips</h2>

            <p>
                A glimpse of the beautiful journeys we have made.
            </p>

        </div>

        <div class="gallery-grid">

            <img src="https://images.unsplash.com/photo-1527631746610-bca00a040d60?auto=format&fit=crop&w=700&q=80">

            <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?auto=format&fit=crop&w=700&q=80">

            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=700&q=80">

            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=700&q=80">

        </div>

    </section>



<!-- OWNER & STAFF SELECTOR -->

<section class="team-selector" id="team">

    <div class="section-title">

        <span>OUR TEAM</span>

        <h2>Meet Our People</h2>

        <p>
            Know the people behind Kashinathan Travels.
        </p>

    </div>

    <div class="team-buttons">

        <button type="button"
                class="team-tab active"
                onclick="showTeam('owner', this)">

            👑 OWNER

        </button>

    </div>


    <!-- OWNER CONTENT -->

    <div class="team-content active"
         id="owner">

        <?php
        $owner_result = mysqli_query(
            $conn,
            "SELECT * FROM owner ORDER BY id DESC LIMIT 1"
        );

        if ($owner = mysqli_fetch_assoc($owner_result)) {
        ?>

            <div class="owner-card">

                <?php if (!empty($owner["photo"])) { ?>

                    <img src="<?php echo htmlspecialchars($owner["photo"]); ?>"
                         alt="Owner Photo">

                <?php } ?>

                <div class="owner-info">

                    <span>RC OWNER</span>

                    <h3>
                        <?php echo htmlspecialchars($owner["owner_name"]); ?>
                    </h3>

                    <p>
                        Instagram:
                        <?php echo htmlspecialchars($owner["instagram_id"]); ?>
                    </p>

                </div>

            </div>

        <?php } else { ?>

            <p class="empty-team">
                Owner details will be updated soon.
            </p>

        <?php } ?>

    </div>


</section>
    <!-- CONTACT -->

    <section class="contact" id="contact">

        <div class="contact-content">

            <span>GET IN TOUCH</span>

            <h2>Let's Plan Your<br>Next Journey</h2>

            <p>
                Have a trip in mind? Get in touch with
                Kashinathan Travels and start planning.
            </p>

            <a href="booking.php" class="book-btn">
                BOOK YOUR JOURNEY →
            </a>

        </div>

    </section>


    <!-- FOOTER -->

    <footer>

        <div>
            <h2>Kashinathan Travels</h2>
            <p>Explore • Travel • Discover</p>
        </div>

        <div>
            <h3>QUICK LINKS</h3>
            <a href="#home">Home</a>
            <a href="#vehicles">Vehicles</a>
            <a href="#packages">Packages</a>
            <a href="#gallery">Gallery</a>
        </div>

        <div>
            <h3>CONTACT</h3>
            <p>📞 +91 XXXXX XXXXX</p>
            <p>📧 kashinathantravels@gmail.com</p>
            <p>📍 Palakkad, Kerala</p>
        </div>

    </footer>
<script>

function toggleMenu() {
    document.getElementById("navMenu").classList.toggle("active");
}


function showTeam(teamName, selectedButton) {

    document.querySelectorAll(".team-content")
        .forEach(function(content) {
            content.classList.remove("active");
        });

    document.querySelectorAll(".team-tab")
        .forEach(function(button) {
            button.classList.remove("active");
        });

    document.getElementById(teamName)
        .classList.add("active");

    selectedButton.classList.add("active");
}

</script>
</body>

</html>