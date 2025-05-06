<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIDOY_LD1_FINALS</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url(https://thumbs.dreamstime.com/b/coastal-laundry-room-design-modern-stylish-decor-featuring-white-blue-cabinets-large-rug-comfortable-bench-suitable-351175525.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 65%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .toggle-password img {
            width: 20px;
            height: 20px;
        }

        .login-button, .create-account-button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button {
            background-color: #7851A9;
            color: white;
        }

        .login-button:hover {
            background-color: #9966CC;
        }

        .create-account-button {
            background-color: #4CAF50;
            color: white;
            margin-top: 10px;
        }

        .create-account-button:hover {
            background-color: #45a049;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #1877F2;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Log In</h2>
        <form id="login-form">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Enter your username">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
                <button type="button" id="togglePassword" class="toggle-password">
                    <img id="eyeIcon" src="https://cdn-icons-png.flaticon.com/512/159/159604.png" alt="Show Password">
                </button>
            </div>

            <p class="forgot-password">
                <a href="#">Forgot Password?</a>
            </p>

            <button type="submit" id="loginButton" class="login-button">Log In</button>
            <button type="button" id="createAccountButton" class="create-account-button">Create New Account</button>
            <p id="error-message" class="error-message"></p>
        </form>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById("togglePassword").addEventListener("click", function () {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "https://cdn-icons-png.flaticon.com/512/3507/3507619.png"; 
                eyeIcon.alt = "Hide Password";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "https://cdn-icons-png.flaticon.com/512/159/159604.png"; 
                eyeIcon.alt = "Show Password";
            }
        });

        // Redirect to account creation page
        document.getElementById("createAccountButton").addEventListener("click", function () {
            window.location.assign("menu.html");  // Relative path for GitHub Pages
        });

        // Login form submission and validation
        document.getElementById("login-form").addEventListener("submit", function (event) {
            event.preventDefault();

            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            const correctUsername = 'admin123';
            const correctPassword = 'admin123';

            const errorMessage = document.getElementById("error-message");

            if (username === correctUsername && password === correctPassword) {
                // Successful login, redirect to another page (e.g., dashboard or home)
                errorMessage.style.display = 'none';
                window.location.href = "menu.html";  // Relative path for GitHub Pages
            } else {
                // Incorrect credentials
                errorMessage.style.display = 'block';
                errorMessage.textContent = 'Incorrect username or password. Please try again.';
            }
        });
    </script>
</body>
</html>
