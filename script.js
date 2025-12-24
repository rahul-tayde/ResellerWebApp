const mobileInput = document.getElementById('mobileInput');
const whatsappInput = document.getElementById('whatsappInput');
const sameAsMobileCheckbox = document.getElementById('sameAsMobile');

// When checkbox is toggled
sameAsMobileCheckbox.addEventListener('change', function () {
    if (this.checked) {
        whatsappInput.value = mobileInput.value;
        whatsappInput.setAttribute('readonly', true);
    } else {
        whatsappInput.value = '';
        whatsappInput.removeAttribute('readonly');
    }
});

// If mobile number changes while checkbox is checked
mobileInput.addEventListener('input', function () {
    if (sameAsMobileCheckbox.checked) {
        whatsappInput.value = mobileInput.value;
    }
});





let captcha = "";

/* ========== CAPTCHA ========== */
function generateCaptcha() {
    const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
    captcha = "";
    for (let i = 0; i < 5; i++) {
        captcha += chars[Math.floor(Math.random() * chars.length)];
    }
    document.getElementById("captchaText").innerText = captcha;
    fetch("store_captcha.php?code=" + captcha);
}

function refreshCaptcha() {
    generateCaptcha();
    document.getElementById("captchaInput").value = "";
}

/* ========== MAIN VALIDATION ========== */
function validateAll() {
    let valid = true;


    const email = document.getElementById('email');

// Email (optional but must be valid)
if (email.value.trim() !== '') {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    if (!emailRegex.test(email.value.trim())) {
        setInvalid(email, "Invalid email format");
        valid = false;
    } else {
        setValidGreen(email);
    }
} else {
    clearValidation(email);
}

    /* ---- BUSINESS TYPE ---- */
    if (document.querySelectorAll('.businessType:checked').length === 0) {
        document.getElementById("businessError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("businessError").style.display = "none";
    }

    /* ---- PRODUCTS ---- */
    if (document.querySelectorAll('.productCheck:checked').length === 0) {
        document.getElementById("productError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("productError").style.display = "none";
    }

    /* ---- PAYMENT ---- */
    if (!document.querySelector('input[name="payment"]:checked')) {
        document.getElementById("paymentError").style.display = "block";
        valid = false;
    } else {
        document.getElementById("paymentError").style.display = "none";
    }

    /* ---- CAPTCHA ---- */
    const userCaptcha = document.getElementById("captchaInput").value.trim();
    if (userCaptcha === "") {
        alert("Please enter the CAPTCHA.");
        valid = false;
    } else if (userCaptcha !== captcha) {
        alert("Incorrect CAPTCHA. Please try again.");
        refreshCaptcha();
        valid = false;
    }

    return valid; // true = submit, false = stop
}

/* ========== AUTO HIDE ERRORS ON CHANGE ========== */
document.querySelectorAll('.businessType').forEach(el => {
    el.addEventListener('change', () => {
        document.getElementById("businessError").style.display = "none";
    });
});

document.querySelectorAll('.productCheck').forEach(el => {
    el.addEventListener('change', () => {
        document.getElementById("productError").style.display = "none";
    });
});

document.querySelectorAll('input[name="payment"]').forEach(el => {
    el.addEventListener('change', () => {
        document.getElementById("paymentError").style.display = "none";
    });
});

/* ========== LOAD CAPTCHA ========== */
window.onload = generateCaptcha;




/* ================= HELPER FUNCTIONS ================= */
function setInvalid(input, message) {
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');

    const feedback = document.getElementById(input.id + "Feedback");
    if (feedback) feedback.innerText = message;
}

function setValidGreen(input) {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');

    const feedback = document.getElementById(input.id + "Feedback");
    if (feedback) feedback.innerText = '';
}

function clearValidation(input) {
    input.classList.remove('is-invalid', 'is-valid');

    const feedback = document.getElementById(input.id + "Feedback");
    if (feedback) feedback.innerText = '';
}


