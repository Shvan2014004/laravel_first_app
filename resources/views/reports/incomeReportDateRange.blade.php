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
        .well {
               background-color: #337ab7 !important;
           }
   
           .well h3 {
               text-transform: uppercase;
               color: white !important;
               margin: 0 !important;
           }
           @media screen and (max-width: 767px) {
        .pdfBtn, .csvBtn{
            width: 100%;
    }
    .csvBtn{
        margin-bottom: 5px!important;
    }
}
   </style>
</head>

<body style="background: #ddd;">
    <div id="app">

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row content">
                    @include('components.sidebar')
                    <div class="well">
                        <h3>Income Report</h3>
                    </div>
                    <div id="app" style="width: 100%">
                        <div class="container" style="width: 100%">
                            {{-- <div class="col-md-2"></div> --}}
                            <div class="col-md-8" style="width: 100%">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h3>Income Report for Specified Date Range</h3>
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
                                                class="btn btn-primary csvBtn">Export to CSV</a>

                                            <a href="{{ route('income.exportPDF', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                                class="btn btn-danger pdfBtn">Export to PDF</a>
                                        </div>
                                        @if($startDate!=null)
                                        @if (count($filteredData) > 0)
                                        <div class="table-container" style="max-height: 400px; overflow: auto;">
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
                                                       <th colspan="3" style="text-align: center;border: 2px solid black;" >Total</th>
                                                        <th style="border: 2px solid black;">{{ $total }}</th>
                                                        <th></th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <Center>
                                            <h2>No records found.</h2>
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
