<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculated Marks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Calculated Marks</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Unit ID</th>
                    <th>Total Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                <tr>
                    <td>{{ $result['student_id'] }}</td>
                    <td>{{ $result['unit_id'] }}</td>
                    <td>{{ $result['exam_score'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
