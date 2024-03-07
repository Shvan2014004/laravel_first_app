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

        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Annual Expense Report</h1>
                        <form method="GET" action="{{ route('expence.filterByDateRange') }}">
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
                                class="btn btn-primary">Export to CSV</a>

                            <a href="{{ route('expence.exportPDF', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
