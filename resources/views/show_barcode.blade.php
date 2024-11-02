<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض باركود</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>عرض باركود</h1>

    <div class="card">
        <div class="card-body text-center">
            <h2>{{ $barcode->name }}</h2>
            <img src="{{ $barcodeImage }}" alt="QR Code" class="img-fluid" />
        </div>
    </div>

    <a href="{{ route('barcodes.index') }}" class="btn btn-primary mt-3">العودة إلى القائمة</a>
</div>

</body>
</html>
