<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Attendance Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub-title {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
        }

        .info-table td {
            border: none;
            text-align: left;
            padding: 4px;
        }

        .summary-table th {
            background: #e8e8e8;
        }
    </style>
</head>
<body>

    <h2>Student Attendance Report</h2>
    <p class="sub-title">KOLEJ TEKNOLOGI MAJU</p>

    <!-- Student Info -->
    <table class="info-table">
        <tr>
            <td><strong>Name:</strong> {{ $student->name }}</td>
            <td><strong>Student ID:</strong> {{ $student->student_id }}</td>
        </tr>
        <tr>
            <td><strong>Program:</strong> {{ $student->program }}</td>

            <td><strong>Level:</strong> {{ $student->level }}</td>
        </tr>

         <tr>

            <td><strong>Start Date:</strong>{{ optional($student->start_date)->format('d M Y') ?? '-' }}</td>
            <td><strong>End Date:</strong>{{ optional($student->end_date)->format('d M Y') ?? '-' }}</td>

        </tr>
    </table>

    <!-- Summary -->
    <table class="summary-table">
        <thead>
            <tr>
                <th>Total Classes</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
                <th>Attendance %</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $total }}</td>
                <td>{{ $present }}</td>
                <td>{{ $absent }}</td>
                <td>{{ $late }}</td>
                <td>{{ $percentage }}%</td>
            </tr>
        </tbody>
    </table>

    <!-- Attendance History -->
    <h4 style="margin-top:20px;">Attendance History</h4>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                    <td>{{ ucfirst($attendance->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
