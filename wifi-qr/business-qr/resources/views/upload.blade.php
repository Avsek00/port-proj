<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business QR with Wi-Fi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Form to upload the QR code image -->
    <div class="upload-section">
        <h2>Upload Business QR Code</h2>
        <form id="uploadForm">
            <input type="file" id="qr_code" name="qr_code" accept="image/*" required>
            <button type="submit">Upload QR Code</button>
        </form>
    </div>

    <!-- Section to display Wi-Fi Information -->
    <div id="wifiInfo" class="info-section" style="display: none;">
        <h3>Wi-Fi Information</h3>
        <p><strong>SSID:</strong> <span id="ssid"></span></p>
        <p><strong>Encryption:</strong> <span id="encryption"></span></p>
        <p><strong>Password:</strong> <span id="password"></span></p>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
