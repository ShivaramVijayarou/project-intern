<!DOCTYPE html>
<html>

<head>
    <title>Attendance Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .text-center {
    text-align: center;
}
    </style>
</head>

<body>

    <h2>Student Attendance Report</h2>
    <p>
        <strong>Batch Average Attendance:</strong>
        {{ $batchAverage }}%
    </p>

    <p>

    Date:
    {{ request('from_date') ? request('from_date') : 'All Dates' }}
    -
    {{ request('to_date') ? request('to_date') : 'All Dates' }}<br>

    Batch:
    {{ request('batch_code') ?? 'All Batches' }}<br>

    Program:
    {{ request('program') ?? 'All Programs' }}<br>

     Level:
    {{ request('level') ?? 'All Levels' }}


<p>

    <strong>Student Intake Period:</strong>
   {{ \Carbon\Carbon::parse($summary[0]['start_date'])->format('d M Y') }}
    —
    {{ \Carbon\Carbon::parse($summary[0]['end_date'])->format('d M Y') }}
</p>
</p>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                {{-- <th>Batch</th> --}}
                {{-- <th>Program</th> --}}
                <th>Present</th>
                <th>Absent</th>
                <th>Total Classes</th>
                <th>Attendance %</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($summary as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    {{-- <td>{{ $item['batch'] }}</td> --}}
                    {{-- <td>{{ $item['program'] }}</td> --}}
                    <td class="text-center">{{ $item['present'] }}</td>
                    <td class="text-center">{{ $item['absent'] }}</td>
                    <td class="text-center">{{ $item['total'] }}</td>
                    <td class="text-center"
                        style=" color: {{ $item['percentage'] < 80 ? 'red' : 'black' }}; font-weight: bold;">

                        {{ $item['percentage'] }}%

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
