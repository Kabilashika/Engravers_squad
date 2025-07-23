function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        // Toggle using class instead of inline styles (recommended)
        dropdown.classList.toggle('show');
    }
}

// Close the dropdown when clicking outside
window.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const userIcon = document.querySelector('.user-icon');
    
    if (dropdown && !userIcon.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});
