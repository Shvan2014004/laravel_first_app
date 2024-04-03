<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
      @media screen and (max-width: 767px) {

.pdfBtn,
.csvBtn {
    width: 100%;
}

.csvBtn {
    margin-bottom: 5px !important;
}
}

    </style>
</head>

<body style="background: #ddd;">
    <div id="app">

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Balance Report</h1>
                        <form method="GET" action="{{ route('report.filterByDateRange') }}">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ $startDate }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ $endDate }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary"
                                        style="margin-top: 25px;">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div style="margin-top: 10px;">
                            <!-- Buttons for exporting data -->
                            <a href="{{ route('expence.exportCSV', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                class="btn btn-primary csvBtn">Export to CSV</a>

                            <a href="{{ route('expence.exportPDF', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                class="btn btn-danger pdfBtn">Export to PDF</a>
                        </div>
                        @if (count($filteredData) > 0)
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
                        @else
                            <h2>No records found.</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
