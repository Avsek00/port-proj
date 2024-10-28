document.getElementById("uploadForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("qr_code", document.getElementById("qr_code").files[0]);

    fetch('/upload', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.ssid) {
            document.getElementById("wifiInfo").style.display = "block";
            document.getElementById("ssid").textContent = data.ssid;
            document.getElementById("encryption").textContent = data.encryption;
            document.getElementById("password").textContent = data.password;
        } else {
            alert(data.message || "Wi-Fi information not found in QR code.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while processing the QR code.");
    });
});
