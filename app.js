document.addEventListener('DOMContentLoaded', function() {
    const loginContainer = document.getElementById('loginContainer');
    const loginForm = document.getElementById('loginForm');
    const createAccountBtn = document.getElementById('createAccountBtn');
    const loginBtn = document.getElementById('loginBtn');

    // Handle create account button click
    createAccountBtn.addEventListener('click', function() {
        // Replace login form with registration form
        loginContainer.innerHTML = `
            <h2>Register</h2>

            <button type="button" id="backToLoginBtn">Back to Login</button>

            <form id="registerForm">
                <div>
                    <label for="newUsername">Username:</label>
                    <input type="text" id="newUsername" required>
                </div>
                <div>
                    <label for="newPassword">Password:</label>
                    <input type="password" id="newPassword" required>
                </div>
                <div>
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" required>
                </div>
                <button type="button" id="registerBtn">Register</button>
                
            </form>
        `;

        // Add event listener for the new back button
        document.getElementById('backToLoginBtn').addEventListener('click', function() {
            // Reload the page to return to login form (simple solution)
            location.reload();
        });
    });

    // Handle login button click (basic functionality)
    loginBtn.addEventListener('click', function() {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        alert(`Login attempt with username: ${username}`);
    });
});