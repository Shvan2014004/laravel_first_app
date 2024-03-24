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
        <div>
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" height="100" width="100">
            <h1>TS3 Enterprises - Accounts</h1>

            <h3>
                @if (isset($month))
                    Monthly Balance Report - Month: {{ $monthName }}
                @elseif(isset($date))
                    Balance Report : {{ $date }}
                @endif
            </h3>
        </div>
    </center>
    <table class="table table-responsive table-bordered table-stripped" style="margin-top:10px;">
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
        @if (isset($month))
            <tr>
                <td></td>
                <td>B/F</td>
                @if ($bf > 0)
                    <td>{{ $bf }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td>{{ $bf }}</td>
                @endif
            </tr>
        @elseif(isset($date))
            <tr>
                <td>{{ $date }}</td>
                <td>B/F</td>
                @if ($bf > 0)
                    <td>{{ $bf }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td>{{ $bf }}</td>
                @endif
            </tr>
        @endif
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
        @foreach ($salary as $row)
            <tr>
                <td>{{ $row->salary_date }}</td>
                <td>Salary of {{ $row->employee_name }}</td>
                <td></td>
                <td>{{ $row->netsalary }}</td>
            </tr>
        @endforeach

        <tr>
            <th colspan="2">Total</th>
            <th>{{ $sumincome }}</th>
            <th>{{ $sumexpence }}</th>
        </tr>
        <tr>
            <th colspan="2">Balance</th>
            @if ($balance > 0)
                <th>{{ $balance }}</th>
                <th></th>
            @else
                <th></th>
                <th>{{ $balance }}</th>
            @endif
        </tr>
    </table>
</body>

</html>
