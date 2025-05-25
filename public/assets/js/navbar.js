document.addEventListener('DOMContentLoaded', () => {
    const appointmentBtn = document.querySelector('.appointment-btn');
    
    appointmentBtn.addEventListener('click', () => {
        alert('Vous allez être redirigé vers le formulaire de prise de rendez-vous.');
        // You can add a redirect here, e.g., window.location.href = 'appointment.html';
    });
});