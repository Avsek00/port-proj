

// Event listener for the Remove button
document.getElementById('removeQrButton').addEventListener('click', function() {
    // Clear the file input
    const qrUploadInput = document.getElementById('qrUpload');
    qrUploadInput.value = ''; // Clear the input field

    // Hide the QR code display section
    const qrDisplay = document.getElementById('qrDisplay');
    qrDisplay.style.display = 'none'; // Hide the QR code display section

    // Hide the Remove button
    this.style.display = 'none'; // Hide the button after removing QR code
});

// Modify the submitForm function
function submitForm(event) {
    event.preventDefault(); // Prevent default form submission

    const ssid = document.getElementById('ssid').value;
    const password = document.getElementById('password').value;
    const qrUpload = document.getElementById('qrUpload').files[0];
    const formData = new FormData();

    // Append all necessary data to FormData
    formData.append('ssid', ssid);
    formData.append('password', password);
    
    // Only append qrUpload if it exists
    if (qrUpload) {
        formData.append('qrUpload', qrUpload); // Uploading the QR code image
    }

    // Send formData to process.php via fetch API
    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Display the generated QR code image
            const qrDisplay = document.getElementById('qrDisplay');
            const qrCodeImage = document.getElementById('qrCodeImage');
            qrCodeImage.src = data.qrPath; // Set the image source to the generated QR code path
            qrDisplay.style.display = 'block'; // Show the QR code display section

            // Show the Remove button after successful submission
            document.getElementById('removeQrButton').style.display = 'inline';

            // Clear the form only if you want to reset inputs
            document.getElementById('wifiForm').reset(); 
        } else {
            alert(data.message); // Show the error message returned from the server
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your request.');
    });
}
