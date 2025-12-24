<?php
session_start();

/* ================= SECURITY CHECK ================= */
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_GET['download'])) {
    die("Invalid access");
}

/* ================= HELPER FUNCTION ================= */
function post($key, $default = '') {
    return isset($_POST[$key]) ? htmlspecialchars(trim($_POST[$key])) : $default;
}

/* ================= HANDLE FIRST FORM SUBMIT ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CAPTCHA CHECK
    if (!isset($_POST['captcha_input']) || $_POST['captcha_input'] !== ($_SESSION['captcha'] ?? '')) {
        die("Captcha verification failed");
    }

    // REQUIRED FIELDS
    $required = [
        'full_name','gender','mobile','whatsapp','street','city',
        'district','pincode','state','country','aadhar','payment'
    ];

    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            die("Required field missing: $field");
        }
    }

    $gstNumber = isset($_POST['gst_number']) 
    ? htmlspecialchars(trim($_POST['gst_number'])) 
    : '';

    $panNumber = isset($_POST['pan_number']) 
    ? htmlspecialchars(trim($_POST['pan_number'])) 
    : '';

    $Email = isset($_POST['email']) 
    ? htmlspecialchars(trim($_POST['email'])) 
    : '';
    

    if (!isset($_POST['business_type']) || !is_array($_POST['business_type'])) {
        die("Business type is required");
    }

    // if (!isset($_POST['products']) || !is_array($_POST['products'])) {
    //     die("Products are required");
    // }

    // STORE DATA IN SESSION (IMPORTANT 🔥)
    $_SESSION['receipt_data'] = [
        "Full Name"       => post('full_name'),
        "Gender"          => post('gender'),
        "Mobile Number"   => post('mobile'),
        "WhatsApp Number" => post('whatsapp'),
        "Email"           => post('email'),
        "Street / Area"   => post('street'),
        "City"            => post('city'),
        "District"        => post('district'),
        "Pincode"         => post('pincode'),
        "State"           => post('state'),
        "Country"         => post('country'),
        "Aadhar Number"   => post('aadhar'),
        "GST Number"      => post('gst'),
        "PAN Number"      => post('pan'),
        "Business Type"   => implode(", ", $_POST['business_type']),
        "Payment Mode"    => post('payment')
    ];
}

/* ================= HANDLE PDF DOWNLOAD ================= */
if (isset($_GET['download']) && $_GET['download'] == 1) {

    if (!isset($_SESSION['receipt_data'])) {
        die("No receipt data found");
    }

    require('fpdf/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,'Registration Receipt',0,1,'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial','',12);
    foreach ($_SESSION['receipt_data'] as $key => $value) {
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(55,8,$key,0,0);
        $pdf->SetFont('Arial','',11);
        $pdf->MultiCell(0,8,$value);
    }

    $pdf->Output('D','Receipt.pdf');
    exit;
}

/* ================= HTML RECEIPT PREVIEW ================= */
$data = $_SESSION['receipt_data'] ?? null;
if (!$data) {
    die("No data to display");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-center mb-4">Receipt Preview</h4>

            <table class="table table-bordered">
                <?php foreach ($data as $key => $value): ?>
                    <tr>
                        <th width="35%"><?= $key ?></th>
                        <td><?= $value ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <a href="receipt.php?download=1" class="btn btn-success w-100">
                Download PDF
            </a>

        </div>
    </div>
</div>

</body>
</html>
