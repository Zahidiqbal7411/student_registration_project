const hidden_country = document.querySelector('#country_form'); // Selects a single element

function country() {
    if (hidden_country.style.display === 'none' || hidden_country.style.display === '') {
        hidden_country.style.display = "block";
    } else {
        hidden_country.style.display = "none";
    }
}
