<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مسح QR Code</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
    </style>
</head>
<body>

<h1>مسح QR Code</h1>
<div id="reader" style="width: 600px; margin: auto;"></div>
<button id="stop-button">إيقاف المسح</button>

<script>
    const html5QrCode = new Html5Qrcode("reader");

    function onScanSuccess(qrCodeMessage) {
        fetch(`/barcodes/toggle/${qrCodeMessage}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                alert('تم تغيير حالة الباركود بنجاح!');
            } else {
                alert('حدث خطأ أثناء تغيير الحالة.');
            }
        });
    }

    const config = {
        fps: 10,
        qrbox: 250
    };

    html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess)
        .catch(err => {
            console.error(`Unable to start scanning: ${err}`);
        });

    document.getElementById("stop-button").addEventListener("click", () => {
        html5QrCode.stop().then(ignore => {
            alert('تم إيقاف المسح.');
        }).catch(err => {
            console.error(`Unable to stop scanning: ${err}`);
        });
    });
</script>

</body>
</html>
