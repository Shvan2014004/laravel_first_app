<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Expense Report</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/ style="border-radius: 50%">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .well {
            background-color: #337ab7 !important;
        }

        .well h3 {
            text-transform: uppercase;
            color: white !important;
            margin: 0 !important;
        }
    </style>
</head>

<body style="background: #ddd;">
    <div id="app">

        <body>
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row content">
                        @include('components.sidebar')
                        <div class="well">
                            <h3>Expense Report</h3>
                        </div>
                        <div id="app" style="width: 100%">
                            <div class="container" style="width: 100%">
                                <div class="col-md-2"></div>
                                <div class="col-md-8" style="width: 100%">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h3>Monthly Expense Report</h3>
                                            <form method="GET" action="{{ route('expence.filterByMonth') }}">
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
                                                    <option value="5" {{ $month == 5 ? 'selected' : '' }}>May
                                                    </option>
                                                    <option value="6" {{ $month == 6 ? 'selected' : '' }}>June
                                                    </option>
                                                    <option value="7" {{ $month == 7 ? 'selected' : '' }}>July
                                                    </option>
                                                    <option value="8" {{ $month == 8 ? 'selected' : '' }}>August
                                                    </option>
                                                    <option value="9" {{ $month == 9 ? 'selected' : '' }}>
                                                        September</option>
                                                    <option value="10" {{ $month == 10 ? 'selected' : '' }}>October
                                                    </option>
                                                    <option value="11" {{ $month == 11 ? 'selected' : '' }}>
                                                        November</option>
                                                    <option value="12" {{ $month == 12 ? 'selected' : '' }}>
                                                        December</option>

                                                </select>
                                                <label for="year">Select a year:</label>
                                                <select name="year" id="year">
                                                    @php
                                                        $currentYear = date('Y');
                                                        $startYear = $currentYear - 10; // You can adjust this value as per your requirements
                                                        $endYear = $currentYear + 10; // You can adjust this value as per your requirements
                                                    @endphp
                                                    @for ($i = $startYear; $i <= $endYear; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ $year == $i ? 'selected' : '' }}>{{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <button type="submit">Filter</button>
                                            </form>
                                            <div style="margin-top: 10px;">
                                                <!-- Buttons for exporting data -->
                                                <a href="{{ route('expence.exportCSV', ['month' => $month, 'year' => $year]) }}"
                                                    class="btn btn-primary">Export to CSV</a>

                                                <a href="{{ route('expence.exportPDF', ['month' => $month, 'year' => $year]) }}"
                                                    class="btn btn-danger">Export to PDF</a>
                                            </div>
                                            @if ($month != null)
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
                                                                        <td>{{ $n++ }}</td>
                                                                        <td>{{ $item->date }}</td>
                                                                        <td>{{ $item->description }}</td>
                                                                        <td>{{ $item->amount }}</td>
                                                                        <td>{{ $item->type }}</td>

                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            <tr style="border: 2px solid black; font-weight: bold;">
                                                                <th colspan="3"
                                                                    style="text-align: center;border: 2px solid black;">
                                                                    Total</th>
                                                                <th style="border: 2px solid black;">
                                                                    {{ $total }}</th>
                                                                <th></th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <center>
                                                        <h2>No records found.</h2>
                                                    </center>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </body>

</html>
