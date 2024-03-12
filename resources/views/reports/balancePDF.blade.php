<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Balance Report</title>
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
        Monthly Balance Report - Month: {{ $month }}
    @elseif(isset($startDate) && isset($endDate))
      Balance Report - Date Range: {{ $startDate }} to {{ $endDate }}
    @endif</h1>
    <table class="table table-responsive table-bordered table-stripped" style="margin-top:10px;">
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
        {{-- @if (!$isAssets)
            <tr>
                <td colspan="4"><b>Assets</b></td>
            </tr>
            @foreach ($assets as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->description }}</td>
                    <td></td>
                    <td>{{ $row->amount }}</td>
                </tr>
            @endforeach
        @endif --}}
        @if (!$isIncome)
            <tr>
                <td colspan="4"><b>Income</b></td>
            </tr>
            @foreach ($income as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->amount }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endif
        @if (!$isExpence)
            <tr>
                <td colspan="4"><b>Expense</b></td>
            </tr>
            @foreach ($expence as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->description }}</td>
                    <td></td>
                    <td>{{ $row->amount }}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <th colspan="2">Total</th>
            <th></th>
        </tr>
    </table>
</body>

</html>
