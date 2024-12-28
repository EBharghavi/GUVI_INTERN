document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    // Perform client-side validation if necessary
    if (email && password) {
        // For this example, use sessionStorage to simulate login (replace with real login logic)
        sessionStorage.setItem('email', email);
        alert('Login successful');
        window.location.href = 'profile.html'; // Redirect to profile page
    } else {
        alert('Invalid login credentials.');
    }
});
