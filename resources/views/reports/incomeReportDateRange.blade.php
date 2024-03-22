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
                                        <h1>Income Report</h1>
                                        <form method="GET" action="{{ route('income.filterByDateRange') }}">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date:</label>
                                                        <input type="date" class="form-control" id="start_date"
                                                            name="start_date" value="{{ $startDate }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date:</label>
                                                        <input type="date" class="form-control" id="end_date"
                                                            name="end_date" value="{{ $endDate }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="margin-top: 25px;">Filter</button>
                                                
                                                    {{-- <button type="reset" class="btn btn-primary"
                                                        style="margin-top: 25px; background-color:red;" value="Reset">Reset</button> --}}
                                                </div>
                                            </div>
                                        </form>
                                        <div style="margin-top: 10px;">
                                            <!-- Buttons for exporting data -->
                                            <a href="{{ route('income.exportCSV', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                                class="btn btn-primary">Export to CSV</a>

                                            <a href="{{ route('income.exportPDF', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                                class="btn btn-danger">Export to PDF</a>
                                        </div>
                                        @if($startDate!=null)
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
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th>Total</th>
                                                        <th>{{ $total }}</th>
                                                        <th></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                        <Center>
                                            <p>No records found.</p>
                                        </Center>
                                        @endif
                                        @endif
                                    </div>
                                </div>
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
