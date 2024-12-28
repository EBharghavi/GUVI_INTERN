document.getElementById('update-profile-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('new-username').value;
    const age = document.getElementById('new-age').value;
    const dob = document.getElementById('new-dob').value;
    const contact = document.getElementById('new-contact').value;

    // Update profile details in sessionStorage (replace with real backend update logic)
    sessionStorage.setItem('username', username);
    sessionStorage.setItem('age', age);
    sessionStorage.setItem('dob', dob);
    sessionStorage.setItem('contact', contact);

    alert('Profile updated successfully');
    window.location.href = 'profile.html'; // Redirect back to profile page
});
