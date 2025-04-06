<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Welcome</h1>
    <div id="loginContainer">
        <h2>Login</h2>
        <form id="loginForm">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" required>
            </div>
            <button type="button" id="loginBtn">Login</button>
        </form>
        <p>Don't have an account?</p>
        <button type="button" id="createAccountBtn">Create Account</button>
        
    </div>
    <script src="app.js"></script>
</body>
</html>