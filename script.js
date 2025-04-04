function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('show');
    dropdown.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function loadContent(section) {
    document.getElementById('mainContent').innerHTML = `
        <h2>${section}</h2>
        <p>Content for ${section} will be displayed here.</p>
    `;
}