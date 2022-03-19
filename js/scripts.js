jQuery(document).ready($ => {
    $('.site-header .menu-ppal .menu').slicknav({
        label:'',
        appendTo:'.site-header'
    });

    //leaflet maps:
    const lat=document.querySelector('#lat').value,
          lng=document.querySelector('#lng').value,
          address=document.querySelector('#address').value;

    if (lat && lng && address) {
        var map = L.map('mapa').setView([lat,lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        L.marker([lat,lng]).addTo(map)
            .bindPopup('<strong>GYMFITNESS</strong><br>'+address)
            .openPopup();
    }      


});