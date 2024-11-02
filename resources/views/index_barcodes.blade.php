<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الباركودات</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">قائمة الباركودات</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>الاسم</th>
                <th>صورة QR</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barcodes as $barcode)
                <tr>
                    <td>{{ $barcode->id }}</td>
                    <td>{{ $barcode->name }}</td>
                    <td>
                        <img src="{{ $barcode->code }}" alt="QR Code" class="img-fluid" style="width: 100px; height: 100px;" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('barcodes.create') }}" class="btn btn-success mt-3">إنشاء باركود جديد</a>
</div>

</body>
</html>
