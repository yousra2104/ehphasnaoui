let activeStep = 0;
const userData = {};
const steps = document.querySelectorAll('.step');
const stepSections = document.querySelectorAll('.step-section');

document.getElementById('appointment-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    // Basic validation
    let isValid = true;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^[0-9]{10}$/;

    if (!formData.get('FirstName')) {
        document.getElementById('FirstName-error').textContent = 'Il faut remplir votre Nom';
        isValid = false;
    }
    if (!formData.get('LastName')) {
        document.getElementById('LastName-error').textContent = 'Il faut remplir Votre Prénom';
        isValid = false;
    }
    if (!formData.get('DateNaissance')) {
        document.getElementById('DateNaissance-error').textContent = 'Il faut remplir Votre Date de Naissance';
        isValid = false;
    }
    if (!formData.get('NumeroTel') || !phoneRegex.test(formData.get('NumeroTel'))) {
        document.getElementById('NumeroTel-error').textContent = 'Numéro de téléphone doit être 10 chiffres';
        isValid = false;
    }
    if (!formData.get('Email') || !emailRegex.test(formData.get('Email'))) {
        document.getElementById('Email-error').textContent = 'Format email invalide';
        isValid = false;
    }
    if (!formData.get('DateRendezVous')) {
        document.getElementById('DateRendezVous-error').textContent = 'Date est requise';
        isValid = false;
    }

    if (!isValid) return;

    // Store form data
    for (let [key, value] of formData.entries()) {
        userData[key] = value;
    }
    userData.Services = Array.from(document.getElementById('Services').selectedOptions).map(opt => opt.value);

    // Check cookie
    if (getCookie('EHPH')) {
        Toastify({
            text: 'Vous avez déjà réservé un rendez-vous.',
            duration: 3000,
            style: { background: 'red' }
        }).showToast();
        return;
    }

    try {
        const response = await axios.get('https://www.ehp-hasnaoui.com/api/auth/otp');
        userData.OTP = response.data;

        await axios.post('https://www.groupe-hasnaoui.com/mail_ehph.php', {
            Email: userData.Email,
            Code: userData.OTP,
            Nom: userData.FirstName,
            Prenom: userData.LastName
        }, {
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        goToStep(1);
        document.getElementById('otp-message').textContent = `Nous allons envoyer un Code OTP à l'email ${userData.Email}`;
    } catch (error) {
        console.error('Error:', error);
    }
});

function goToStep(step) {
    steps[activeStep].classList.remove('active');
    stepSections[activeStep].classList.remove('active');
    activeStep = step;
    steps[activeStep].classList.add('active');
    stepSections[activeStep].classList.add('active');
}

function goBack() {
    goToStep(activeStep - 1);
}

function verifyOTP() {
    const otp = Array.from(document.querySelectorAll('.otp-input'))
        .map(input => input.value)
        .join('');

    if (otp === userData.OTP) {
        if (getCookie('EHPH')) {
            Toastify({
                text: 'Vous avez déjà réservé un Rendezvous',
                duration: 3000,
                style: { background: 'red' }
            }).showToast();
            return;
        }

        userData.Services.forEach(async (service) => {
            try {
                const response = await fetch('https://www.ehp-hasnaoui.com/api/auth/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ...userData, Service: service })
                });
                if (response.ok) {
                    Toastify({
                        text: `Rendezvous a été planifié pour : ${service}`,
                        duration: 3000,
                        style: { background: 'green' }
                    }).showToast();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });

        setCookie('EHPH', JSON.stringify("HASNAOUI"), 5);
    } else {
        Toastify({
            text: 'Code OTP incorrect',
            duration: 3000,
            style: { background: 'red' }
        }).showToast();
    }
}

function setCookie(name, value, minutes) {
    const date = new Date();
    date.setTime(date.getTime() + (minutes * 60 * 1000));
    document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    return parts.length === 2 ? parts.pop().split(';').shift() : null;
}

// Set min date for DateRendezVous
document.getElementById('DateRendezVous').min = new Date().toISOString().split('T')[0];