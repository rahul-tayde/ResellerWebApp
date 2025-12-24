<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<style>

.valid {
    border-color: #198754 !important;
}
.invalid {
    border-color: #dc3545 !important;
}
.feedback.valid {
    color: #198754;
    font-size: 14px;
}
.feedback.invalid {
    color: #dc3545;
    font-size: 14px;
}

</style>
<body>
    <div class="container mt-4 mb-4">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h3 class="text-white text-center">Femira – Reseller Registration</h3>
            </div>

            <div class="card-body">
                <form action="receipt.php" method="POST" onsubmit="return validateAll();">

                <div class="row">

                    <!-- BUSINESS DETAILS -->
                    <h5 class="text-center mb-3">Presonal Information</h5>

                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="full_name" placeholder="e.g. Rahul Santosh Tayde" class="form-control" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gender *</label>
                        <select name="gender" class="form-select" required>
                            <option value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Transgender</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label">Mobile Number *</label>
                        <input type="text" id="mobileInput" name="mobile"
                            class="form-control" placeholder="e.g. 9876543210" required>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label">WhatsApp / Alternate Number *</label>
                        <input type="text" id="whatsappInput" name="whatsapp"
                            class="form-control" placeholder="e.g. 9876543210" required>
                        
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox"
                                id="sameAsMobile">
                            <label class="form-check-label" for="sameAsMobile">
                                Mobile number is WhatsApp number
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email ID (Optional)</label>
                        <input type="email"
                            id="email"
                            name="email"
                            placeholder="e.g. rahul@gmail.com"
                            class="form-control">

                        <div id="emailFeedback" class="invailid-feedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Street / Area *</label>
                        <input type="text" name="street" placeholder="e.g. Flat No. 12, MG Road" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">City *</label>
                        <input type="text" name="city" placeholder="e.g. Indore" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">District *</label>
                        <input type="text" name="district" placeholder="e.g. Indore" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pincode *</label>
                        <input type="text" name="pincode" placeholder="e.g. 452001" class="form-control" maxlength="6" pattern="[0-9]{6}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">State *</label>
                        <select name="state" class="form-select" required>
                            <option value="">Select State</option>

                            <option>Andaman and Nicobar Islands</option>
                            <option>Andhra Pradesh</option>
                            <option>Arunachal Pradesh</option>
                            <option>Assam</option>
                            <option>Bihar</option>
                            <option>Chandigarh</option>
                            <option>Chhattisgarh</option>
                            <option>Dadra and Nagar Haveli and Daman and Diu</option>
                            <option>Delhi</option>
                            <option>Goa</option>
                            <option>Gujarat</option>
                            <option>Haryana</option>
                            <option>Himachal Pradesh</option>
                            <option>Jammu and Kashmir</option>
                            <option>Jharkhand</option>
                            <option>Karnataka</option>
                            <option>Kerala</option>
                            <option>Ladakh</option>
                            <option>Lakshadweep</option>
                            <option>Madhya Pradesh</option>
                            <option>Maharashtra</option>
                            <option>Manipur</option>
                            <option>Meghalaya</option>
                            <option>Mizoram</option>
                            <option>Nagaland</option>
                            <option>Odisha</option>
                            <option>Puducherry</option>
                            <option>Punjab</option>
                            <option>Rajasthan</option>
                            <option>Sikkim</option>
                            <option>Tamil Nadu</option>
                            <option>Telangana</option>
                            <option>Tripura</option>
                            <option>Uttar Pradesh</option>
                            <option>Uttarakhand</option>
                            <option>West Bengal</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Country *</label>
                        <select name="country" class="form-select" required>
                            <option>India</option>
                        </select>
                    </div>
                

                    <!-- BUSINESS DETAILS -->
                    <h5 class="text-center mb-3">Business Information</h5>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Aadhar Number *</label>
                        <input type="number" name="aadhar" placeholder="e.g. 121417282522" class="form-control" maxlength="12" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">PAN Number (Optional)</label>
                        <input type="text" name="pan" placeholder="e.g. ABCDE1234F" class="form-control" maxlength="10">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">GST Number (Optional)</label>
                        <input type="text" name="gst" placeholder="e.g. 12ABCDE3456F7G8" class="form-control" maxlength="15">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Type of Business *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input businessType" type="checkbox" name="business_type[]" value="Online">
                            <label class="form-check-label">Online</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input businessType" type="checkbox" name="business_type[]" value="Offline">
                            <label class="form-check-label">Offline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input businessType" type="checkbox" name="business_type[]" value="Both">
                            <label class="form-check-label">Both</label>
                        </div>
                        <div class="text-danger mt-1" id="businessError" style="display:none;">
                            Please select at least one business type.
                        </div>
                    </div>

                    <!-- PAYMENT -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Preferred Payment Mode *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment" value="UPI">
                            <label class="form-check-label">UPI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment" value="Bank Transfer">
                            <label class="form-check-label">Bank Transfer</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment" value="Cash">
                            <label class="form-check-label">Cash</label>
                        </div>
                        <div class="text-danger mt-1" id="paymentError" style="display:none;">
                            Please select a payment mode.
                        </div>
                    </div>

                    <!-- CAPTCHA -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Enter CAPTCHA</label>

                        <div class="d-flex align-items-center mb-2">
                            <span id="captchaText"
                                style="font-weight:bold;
                                        background:#f1f1f1;
                                        padding:8px 14px;
                                        letter-spacing:3px;
                                        border-radius:4px;
                                        user-select:none;">
                            </span>

                            <button type="button"
                                    class="btn btn-outline-secondary btn-sm ms-2"
                                    onclick="refreshCaptcha()">
                                🔄 Refresh
                            </button>
                        </div>

                        <input type="text"
                            id="captchaInput"
                            name="captcha_input"
                            class="form-control"
                            placeholder="Type the CAPTCHA shown above"
                            required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Submit & Download Receipt
                    </button>
                </div>

            </form>
                </div>
                
            </div>
        </div>    
    
    </div>




    <!-- JS Linking -->
    <script src="script.js"></script>
</body>
</html>