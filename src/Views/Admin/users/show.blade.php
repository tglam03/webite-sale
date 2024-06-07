<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chi tiết Users: {{ $user['name'] }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <a class="btn btn-info" href="{{ url('admin/users') }}">Back</a>
        <h2>Chi tiết Users: {{ $user['name'] }}</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Trường giá trị</th>
                    <th>Thông tin người dùng</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($user as $field => $value)
                    <tr>
                        <td>{{ $field }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
