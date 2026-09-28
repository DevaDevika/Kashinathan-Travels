<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>49 Seat Bus - Kashinathan Travels</title>

    <link rel="stylesheet" href="style.css">

    <style>
        /* =========================================
           VEHICLE DETAILS PAGE
        ========================================= */

        .vehicle-details {
            min-height: 100vh;
            padding: 140px 6% 80px;
            background: #f4f0e7;
        }

        .vehicle-detail-card {
            max-width: 1100px;
            margin: auto;

            display: grid;
            grid-template-columns: 1fr 1fr;

            background: white;

            box-shadow: 0 20px 60px rgba(24, 54, 56, 0.12);
        }

        /* IMAGE */

        .vehicle-detail-image {
            min-height: 500px;
            overflow: hidden;
        }

        .vehicle-detail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* DETAILS */

        .vehicle-detail-info {
            padding: 60px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .vehicle-detail-info > span {
            font-family: Arial, sans-serif;
            font-size: 10px;
            letter-spacing: 4px;
            color: #b18227;
        }

        .vehicle-detail-info h1 {
            margin: 18px 0;

            font-size: 48px;
            font-weight: normal;
            line-height: 1.1;

            color: #183638;
        }

        .vehicle-detail-info p {
            margin-bottom: 25px;

            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.8;

            color: #687777;
        }

        /* INFORMATION */

        .vehicle-info-list {
            margin-bottom: 30px;
        }

        .vehicle-info-list div {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 14px 0;

            border-bottom: 1px solid #ddd8cc;
        }

        .vehicle-info-list span {
            font-family: Arial, sans-serif;
            font-size: 9px;
            letter-spacing: 2px;
            color: #777;
        }

        .vehicle-info-list strong {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #183638;
        }

        /* BOOK BUTTON */

        .vehicle-book-btn {
            display: inline-block;
            width: fit-content;

            padding: 15px 25px;

            background: #d9a441;
            color: #183638;

            font-family: Arial, sans-serif;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 2px;

            transition: 0.3s;
        }

        .vehicle-book-btn:hover {
            background: #183638;
            color: white;
        }

        /* BACK */

        .back-link {
            display: inline-block;

            margin-top: 20px;

            font-family: Arial, sans-serif;
            font-size: 10px;
            letter-spacing: 1px;

            color: #687777;
        }

        .back-link:hover {
            color: #b18227;
        }

        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 700px) {

            .vehicle-details {
                padding: 105px 5% 50px;
            }

            .vehicle-detail-card {
                grid-template-columns: 1fr;
            }

            .vehicle-detail-image {
                min-height: 280px;
            }

            .vehicle-detail-info {
                padding: 35px 25px;
            }

            .vehicle-detail-info h1 {
                font-size: 36px;
            }

            .vehicle-detail-info p {
                font-size: 13px;
            }

            .vehicle-info-list div {
                padding: 13px 0;
            }

            .vehicle-book-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 380px) {

            .vehicle-detail-info {
                padding: 30px 20px;
            }

            .vehicle-detail-info h1 {
                font-size: 32px;
            }
        }
    </style>

</head>

<body>

    <!-- =========================================
         VEHICLE DETAILS
    ========================================= -->

    <section class="vehicle-details">

        <div class="vehicle-detail-card">

            <!-- VEHICLE IMAGE -->

            <div class="vehicle-detail-image">

                <img
                    src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=1200&q=85"
                    alt="49 Seat Bus">

            </div>


            <!-- VEHICLE INFORMATION -->

            <div class="vehicle-detail-info">

                <span>OUR FLEET</span>

                <h1>49 Seat Bus</h1>

                <p>
                    A spacious and comfortable bus suitable for
                    school trips, college tours, family journeys
                    and large group travel.
                </p>


                <!-- VEHICLE DETAILS -->

                <div class="vehicle-info-list">

                    <div>
                        <span>VEHICLE TYPE</span>
                        <strong>Bus</strong>
                    </div>

                    <div>
                        <span>SEATING CAPACITY</span>
                        <strong>49 Passengers</strong>
                    </div>

                    <div>
                        <span>STATUS</span>
                        <strong>Available</strong>
                    </div>

                </div>


                <!-- BOOK -->

                <a href="booking.php" class="vehicle-book-btn">
                    BOOK THIS VEHICLE →
                </a>


                <!-- BACK -->

                <a href="index.php#vehicles" class="back-link">
                    ← BACK TO VEHICLES
                </a>

            </div>

        </div>

    </section>

</body>

</html>