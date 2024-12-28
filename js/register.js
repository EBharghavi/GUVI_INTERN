document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Perform client-side validation if necessary
    if (username && email && password) {
        // Here you would typically send a POST request to the server
        alert('Registration successful');
        window.location.href = 'login.html'; // Redirect to login page
    } else {
        alert('Please fill out all fields.');
    }
});
