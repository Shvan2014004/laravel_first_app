<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Income Report</title>
    <style>
        /* Define your styles here */
        /* For example: */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1> @if(isset($month))
        Monthly Income Report - Month: {{ $month }}
    @elseif(isset($startDate) && isset($endDate))
       Annual Income Report - Date Range: {{ $startDate }} to {{ $endDate }}
    @endif</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredData as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
