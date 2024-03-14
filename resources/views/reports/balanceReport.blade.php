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

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row content">
                @include('components.sidebar')
                <div class="well">
                    <h4>TS3 Enterprises Accounts Dashboard</h4>
                </div>
                <div id="app" style="width: 100%">
                    <div class="container" style="width: 100%">
                        <div class="col-md-2"></div>
                        <div class="col-md-8" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h1>Monthly Expense Report</h1>
                                    <form method="GET" action="{{ route('balance.filterByMonth') }}">
                                        <label for="month">Select a month:</label>
                                        <select name="month" id="month">
                                            <option value="1" {{ $month == 1 ? 'selected' : '' }}>January</option>
                                            <option value="2" {{ $month == 2 ? 'selected' : '' }}>February</option>
                                            <option value="3" {{ $month == 3 ? 'selected' : '' }}>March</option>
                                            <option value="4" {{ $month == 4 ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ $month == 5 ? 'selected' : '' }}>May</option>
                                            <option value="6" {{ $month == 6 ? 'selected' : '' }}>June</option>
                                            <option value="7" {{ $month == 7 ? 'selected' : '' }}>July</option>
                                            <option value="8" {{ $month == 8 ? 'selected' : '' }}>August</option>
                                            <option value="9" {{ $month == 9 ? 'selected' : '' }}>September
                                            </option>
                                            <option value="10" {{ $month == 10 ? 'selected' : '' }}>October
                                            </option>
                                            <option value="11" {{ $month == 11 ? 'selected' : '' }}>November
                                            </option>
                                            <option value="12" {{ $month == 12 ? 'selected' : '' }}>December
                                            </option>

                                        </select>
                                        <button type="submit">Filter</button>
                                    </form>
                                    <div style="margin-top: 10px;">
                                        <!-- Buttons for exporting data -->
                                        <a href="{{ route('balance.exportCSV', ['month' => $month]) }}"
                                            class="btn btn-primary">Export to CSV</a>

                                        <a href="{{ route('balance.exportPDF', ['month' => $month]) }}"
                                            class="btn btn-danger">Export to PDF</a>
                                    </div>
                                    <table class="table table-responsive table-bordered table-stripped"
                                        style="margin-top:10px;">
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
                                        <tr>
                                            <td></td>
                                            <td>B/F</td>
                                            <td>{{ $bf }}</td>
                                        </tr>
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
                                        {{-- @if (!$isExpence || $isSalary) --}}
                                            <tr>
                                                <td colspan="4"><b>Expense</b></td>
                                            </tr>
                                            {{-- @endif --}}
                                            @foreach ($expence as $row)
                                                <tr>
                                                    <td>{{ $row->date }}</td>
                                                    <td>{{ $row->description }}</td>
                                                    <td></td>
                                                    <td>{{ $row->amount }}</td>
                                                </tr>
                                            @endforeach
                                        
                                        {{-- @if (!$isSalary)
                                            @foreach ($salary as $row)
                                                <tr>
                                                    <td>{{ $row->salary_date }}</td>
                                                    <td>Salary of {{ $row->employee_name }}</td>
                                                    <td></td>
                                                    <td>{{ $row->netsalary }}</td>
                                                </tr>
                                            @endforeach
                                        @endif --}}
                                        @foreach ($salary as $row )
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
                                            @else
                                                <th></th>
                                                <th>{{ $balance }}</th>
                                            @endif
                                        </tr>
                                    </table>
</body>

</html>
