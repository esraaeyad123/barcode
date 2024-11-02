<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء باركودات</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>إنشاء باركودات</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('barcodes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="count">عدد الباركودات:</label>
            <input type="number" class="form-control" id="count" name="count" required>
        </div>
        <button type="submit" class="btn btn-primary">إنشاء</button>
    </form>
</div>

</body>
</html>
