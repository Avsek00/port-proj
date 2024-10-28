<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'phpqrcode/phpqrcode.php'; 
require 'vendor/autoload.php'; // Ensure your QR code library is included

use Zxing\QrReader; // Adjust based on the library you are using

$response = ["success" => false];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the necessary POST data exists
    if (isset($_POST['ssid']) && isset($_POST['password'])) {
        $ssid = $_POST['ssid'];
        $password = $_POST['password'];
        $url = null; // Initialize URL variable

        // Check if a QR code file has been uploaded
        if (isset($_FILES['qrUpload']) && $_FILES['qrUpload']['error'] === UPLOAD_ERR_OK) {
            // Path for the uploaded QR code file
            $qrUploadPath = 'uploads/' . basename($_FILES['qrUpload']['name']);
            
            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES['qrUpload']['tmp_name'], $qrUploadPath)) {
                // Decode the uploaded QR code
                $qrcode = new QrReader($qrUploadPath);
                $url = $qrcode->text(); // Extracted URL from the QR code
            } else {
                $response = ["success" => false, "message" => "Failed to upload the QR code file."];
                echo json_encode($response);
                exit; // Stop execution if file upload fails
            }
        }

        // If URL was successfully extracted from QR code or QR code was not uploaded, proceed
        if ($url || $url === null) {
            // Combine URL with Wi-Fi information
            $wifiData = "WIFI:S:$ssid;T:WPA;P:$password;";

            // If a URL was extracted from the QR code, add it to the data
            if ($url) {
                $wifiData .= "U:$url;";
            }

            // Create a temporary directory for QR codes
            $tempDir = 'temp/';
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // Path to save the generated QR code
            $wifiQRFilePath = $tempDir . 'wifi_qr.png';

            // Generate the QR code
            QRcode::png($wifiData, $wifiQRFilePath, QR_ECLEVEL_L, 10);

            // Set response for a successful QR code generation
            $response = [
                "success" => true,
                "message" => "QR code generated successfully",
                "qrPath" => $wifiQRFilePath // Path to the generated QR code
            ];
        } else {
            $response = ["success" => false, "message" => "Failed to read the QR code."];
        }
    } else {
        $response = ["success" => false, "message" => "SSID and Password are required"];
    }
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
