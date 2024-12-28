document.addEventListener("DOMContentLoaded", function() {
    const email = sessionStorage.getItem('email');
    if (!email) {
        window.location.href = 'login.html'; // Redirect to login page if not logged in
    }

    // Display profile details
    document.getElementById('profile-email').textContent = email;
    document.getElementById('profile-username').textContent = sessionStorage.getItem('username') || "Default Username";
    document.getElementById('profile-age').textContent = sessionStorage.getItem('age') || "None";
    document.getElementById('profile-dob').textContent = sessionStorage.getItem('dob') || "00-00-2000";
    document.getElementById('profile-contact').textContent = sessionStorage.getItem('contact') || "+91 12345 67890";
});

document.getElementById('logout')?.addEventListener('click', function() {
    sessionStorage.clear();
    window.location.href = 'login.html'; // Redirect to login after logout
});
