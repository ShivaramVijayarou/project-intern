<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Registration List</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

<h2>Student Registration List</h2>

<table>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>IC</th>
            <th>Program</th>
            <th>Level</th>
            <th>Batch Code</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($students as $s)
        <tr>
            <td>{{ $s->student_id }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->ic }}</td>
            <td>{{ $s->program }}</td>
            <td>{{ $s->level }}</td>
            <td>{{ $s->batch_code }}</td>
            <td>{{ ucfirst($s->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
