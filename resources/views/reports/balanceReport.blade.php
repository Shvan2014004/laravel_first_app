<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Report</title>
</head>

<body>
    @csrf
    <form action="{{route('report')}}" method="POST">
        <label for="startDate">From :</label>
        <input type="text" name="start">
        <label for="endDate">To :</label>
        <input type="text" name="end">
        <button type="submit" class="btn btn-primary">Go</button>
    </form>
    <table class="table table-responsive table-bordered table-stripped" style="margin-top:10px;">
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
        @if (!$isAssets)
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
        <tr>
            <th colspan="2">Total</th>
            <th></th>
        </tr>
    </table>
</body>

</html>
