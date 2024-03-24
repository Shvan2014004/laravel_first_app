<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Expense Report</title>
    <style>
        /* Define your styles here */
        /* For example: */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <center>
    <h2>
        @if (isset($month))
            Monthly Expense Report - Month: {{ $monthName }}- {{ $year }}
        @elseif(isset($startDate) && isset($endDate))
            Annual Expense Report - Date From: {{ $startDate }} to {{ $endDate }}
        @endif
    </h2>
</center>
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
                    <td>{{ $n++ }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->type }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <th>Total</th>
                <th>{{ $total }}</th>
                <th></th>
            </tr>
        </tbody>
    </table>
</body>

</html>
