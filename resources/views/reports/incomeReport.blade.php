<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body style="background: #ddd;">
    <div id="app">

        <body>

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
                                        <h1>Monthly Income Report</h1>
                                        <form method="GET" action="{{ route('income.filterByMonth') }}">
                                            <label for="month">Select a month:</label>
                                            <select name="month" id="month">
                                                <option value="1" {{ $month == 1 ? 'selected' : '' }}>January
                                                </option>
                                                <option value="2" {{ $month == 2 ? 'selected' : '' }}>February
                                                </option>
                                                <option value="3" {{ $month == 3 ? 'selected' : '' }}>March
                                                </option>
                                                <option value="4" {{ $month == 4 ? 'selected' : '' }}>April
                                                </option>
                                                <option value="5" {{ $month == 5 ? 'selected' : '' }}>May</option>
                                                <option value="6" {{ $month == 6 ? 'selected' : '' }}>June</option>
                                                <option value="7" {{ $month == 7 ? 'selected' : '' }}>July</option>
                                                <option value="8" {{ $month == 8 ? 'selected' : '' }}>August
                                                </option>
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
                                            <a href="{{ route('income.exportCSV', ['month' => $month]) }}"
                                                class="btn btn-primary">Export to CSV</a>

                                            <a href="{{ route('income.exportPDF', ['month' => $month]) }}"
                                                class="btn btn-danger">Export to PDF</a>
                                        </div>
                                        @if (count($filteredData) > 0)
                                            <table class="table table-responsive table-bordered table-stripped"
                                                style="margin-top:10px;">
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
                                                    @if (isset($filteredData) && count($filteredData) > 0)
                                                        @foreach ($filteredData as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>{{ $item->date }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td>{{ $item->amount }}</td>
                                                                <td>{{ $item->type }}</td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th>Total</th>
                                                        <th>{{$total}}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No records found.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </body>

</html>
