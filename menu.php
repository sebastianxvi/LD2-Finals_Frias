<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Cart</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://w0.peakpx.com/wallpaper/679/425/HD-wallpaper-taylor-swift-in-purple-dress-lady-purple-pink-dress-taylor-swift.jpg') no-repeat fixed;
            background-size: cover;
            background-position: center top;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        header {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            background: rgba(255, 255, 255, 0.3);
            padding: 12px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 18px;
            color: black;
            font-weight: bold;
            transition: 0.3s;
        }

        nav ul li a:hover {
            color: #c77cb4;
        }

        .logout-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-left: auto;
        }

        .logout-button:hover {
            background-color: #cc0000;
        }

        .content {
            width: 60%;
            background: rgba(0, 0, 0, 0.6);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .price-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .price-button:hover {
            background-color: #0056b3;
        }

        /* Spinner Loading Animation */
        #logoutSpinner {
            display: none;
            margin: 20px auto;
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#" onclick="goToProducts()">Products</a></li>
                <li><a href="Services.html">Services</a></li>
                <li><a href="About Us.html">About Us</a></li>
                <li><a href="Message.html">Message</a></li>
                <li><button class="logout-button" onclick="logout()">Log Out</button></li>
            </ul>
        </nav>
    </header>

    <div id="homeContent" class="content">
        <h2>Welcome to Laundry Fashion!</h2>
        <p>Your one-stop solution for all laundry needs.</p>
        <img src="https://media0.giphy.com/media/3ohzUi8jtM0l2NDFqU/200.gif?cid=6c09b952q194efl4jwtaus2cnwzc6cb2k82jam0yr3gsl17z&ep=v1_internal_gif_by_id&rid=200.gif&ct=g" alt="Laundry GIF" width="300">
        
        <p>Our laundry fashion business offers a unique combination of premium fabric care and stylish maintenance, ensuring that clothes not only stay fresh but also look their best.</p>
        <h3>Your Clothes. Our Care. Effortless Clean.</h3>
        <button class="price-button" onclick="seePrices()">See Prices</button>

        <!-- Spinner for Logging Out -->
        <div id="logoutSpinner"></div>
    </div>

    <script>
        function logout() {
            localStorage.clear();
            document.getElementById("logoutSpinner").style.display = "block";
            setTimeout(function() {
                window.location.href = "logout.html";
            }, 3000);
        }

        function seePrices() {
            setTimeout(function() {
                window.location.href = "price.html";
            }, 5000);
        }

        function goToProducts() {
            setTimeout(function() {
                window.location.href = "product.html";
            }, 5000);
        }
    </script>
</body>
</html>
