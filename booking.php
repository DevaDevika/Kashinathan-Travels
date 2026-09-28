<?php
include "config.php";
?>
<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_name = $_POST["customer_name"];
    $phone = $_POST["phone"];
    $travel_date = $_POST["travel_date"];
    $starting_place = $_POST["starting_place"];
    $destination = $_POST["destination"];
    $passengers = $_POST["passengers"];

    $food = $_POST["food"];

    $veg_passengers = 0;
    $nonveg_passengers = 0;

    if ($food == "Veg") {
        $veg_passengers = $passengers;
    } else {
        $nonveg_passengers = $passengers;
    }

    $vehicle = $_POST["vehicle"];

    $vehicle_id = 0;

    if ($vehicle == "49 Seat Bus") {
        $vehicle_id = 1;
    } elseif ($vehicle == "17 Seat Traveller") {
        $vehicle_id = 2;
    } elseif ($vehicle == "Car") {
        $vehicle_id = 3;
    }

    $sql = "INSERT INTO bookings
    (vehicle_id, customer_name, phone, travel_date, starting_place,
    destination, passengers, veg_passengers, nonveg_passengers, status)

    VALUES
    ('$vehicle_id', '$customer_name', '$phone', '$travel_date',
    '$starting_place', '$destination', '$passengers',
    '$veg_passengers', '$nonveg_passengers', 'Pending')";

   if (mysqli_query($conn, $sql)) {

    $booking_id = mysqli_insert_id($conn);

    echo "<script>
            alert('Booking submitted successfully! Your Booking ID is: $booking_id');
            window.location.href='booking_status.php';
          </script>";

    } else {

        echo "Booking failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Your Journey - Kashinathan Travels</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .booking-page {
            min-height: 100vh;
            padding: 120px 5% 70px;
            background: #f4f0e7;
        }

        .booking-container {
            max-width: 900px;
            margin: auto;
        }

        .booking-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .booking-heading span {
            font-family: Arial, sans-serif;
            font-size: 10px;
            letter-spacing: 4px;
            color: #b18227;
        }

        .booking-heading h1 {
            margin-top: 15px;
            font-size: 48px;
            font-weight: normal;
            color: #183638;
        }

        .booking-heading p {
            margin-top: 12px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #687777;
        }

        .booking-card {
            background: white;
            padding: 45px;

            box-shadow: 0 20px 60px rgba(24, 54, 56, 0.12);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            margin-bottom: 8px;

            font-family: Arial, sans-serif;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;

            color: #183638;
        }

        .form-group input,
        .form-group select {
            width: 100%;

            padding: 14px;

            border: 1px solid #d8d2c6;
            background: #faf8f3;

            font-family: Arial, sans-serif;
            font-size: 13px;

            color: #183638;

            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #b18227;
        }

        .food-section {
            margin-top: 30px;
        }

        .food-section h3 {
            margin-bottom: 15px;

            font-family: Arial, sans-serif;
            font-size: 10px;
            letter-spacing: 2px;
            color: #183638;
        }

        .food-options {
            display: flex;
            gap: 20px;
        }

        .food-option {
            display: flex;
            align-items: center;
            gap: 8px;

            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #687777;
        }

        .food-option input {
            accent-color: #b18227;
        }

        .submit-btn {
            width: 100%;

            margin-top: 35px;
            padding: 16px;

            border: none;

            background: #d9a441;
            color: #183638;

            font-family: Arial, sans-serif;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;

            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: #183638;
            color: white;
        }

        .back-home {
            display: block;
            width: fit-content;

            margin: 25px auto 0;

            font-family: Arial, sans-serif;
            font-size: 10px;
            letter-spacing: 1px;

            color: #687777;
        }

        .back-home:hover {
            color: #b18227;
        }

        @media (max-width: 600px) {

            .booking-page {
                padding: 100px 5% 50px;
            }

            .booking-heading h1 {
                font-size: 36px;
            }

            .booking-heading p {
                font-size: 12px;
            }

            .booking-card {
                padding: 28px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .form-group.full {
                grid-column: auto;
            }

            .food-options {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>

</head>

<body>

<section class="booking-page">

    <div class="booking-container">

        <!-- HEADING -->

        <div class="booking-heading">

            <span>BOOKING</span>

            <h1>Plan Your Journey</h1>

            <p>
                Fill in your travel details and send your booking request.
            </p>

        </div>


        <!-- BOOKING FORM -->

        <div class="booking-card">

            <form action="#" method="post">

                <div class="form-grid">

                    <!-- NAME -->

                    <div class="form-group">

                        <label>FULL NAME</label>

                        <input
                            type="text"
                            name="customer_name"
                            placeholder="Enter your name"
                            required>

                    </div>


                    <!-- PHONE -->

                    <div class="form-group">

                        <label>PHONE NUMBER</label>

                        <input
                            type="tel"
                            name="phone"
                            placeholder="Enter phone number"
                            required>

                    </div>


                    <!-- TRAVEL DATE -->

                    <div class="form-group">

                        <label>TRAVEL DATE</label>

                        <input
                            type="date"
                            name="travel_date"
                            required>

                    </div>


                    <!-- VEHICLE -->

                    <div class="form-group">

                        <label>VEHICLE</label>

                        <select name="vehicle" required>

                            <option value="">Select vehicle</option>

                            <option value="49 Seat Bus">
                                49 Seat Bus
                            </option>

                            <option value="17 Seat Traveller">
                                17 Seat Traveller
                            </option>

                            <option value="Car">
                                Car
                            </option>

                        </select>

                    </div>


                    <!-- STARTING PLACE -->

                    <div class="form-group">

                        <label>STARTING PLACE</label>

                        <input
                            type="text"
                            name="starting_place"
                            placeholder="Where will you start?"
                            required>

                    </div>


                    <!-- DESTINATION -->

                    <div class="form-group">

                        <label>DESTINATION</label>

                        <input
                            type="text"
                            name="destination"
                            placeholder="Where are you going?"
                            required>

                    </div>


                    <!-- PASSENGERS -->

                    <div class="form-group full">

                        <label>NUMBER OF PASSENGERS</label>

                        <input
                            type="number"
                            name="passengers"
                            min="1"
                            placeholder="Number of passengers"
                            required>

                    </div>

                </div>


                <!-- FOOD -->

                <div class="food-section">

                    <h3>FOOD PREFERENCE</h3>

                    <div class="food-options">

                        <label class="food-option">

                            <input
                                type="radio"
                                name="food"
                                value="Veg"
                                required>

                            Vegetarian

                        </label>


                        <label class="food-option">

                            <input
                                type="radio"
                                name="food"
                                value="Non-Veg">

                            Non-Vegetarian

                        </label>

                    </div>

                </div>


                <!-- SUBMIT -->

                <button
                    type="submit"
                    class="submit-btn">

                    SUBMIT BOOKING REQUEST →

                </button>

            </form>


            <a
                href="index.php"
                class="back-home">

                ← BACK TO HOME

            </a>

        </div>

    </div>

</section>

</body>

</html>