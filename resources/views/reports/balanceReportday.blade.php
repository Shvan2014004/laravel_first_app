<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Report</title>
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

<body>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row content">
                @include('components.sidebar')
                <div class="well">
                    <h3>Daily Balance Report</h3>
                </div>
                <div id="app" style="width: 100%">
                    <div class="container" style="width: 100%">
                        <div class="col-md-2"></div>
                        <div class="col-md-8" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h1>Daily Report</h1>
{{-- @if($bf==null || $bf==0)
<div>
    <script>
        // Prompt the user to input balance data
        var bf = prompt('Please enter the balance:');
        
        // Send the input data to the server using AJAX
        if (bf) {
            // Create a new AJAX request
            var xhr = new XMLHttpRequest();
    
            // Configure the request
            xhr.open('POST', '{{ route('balance.daily') }}'); // Replace 'store-balance' with your route name
            xhr.setRequestHeader('Content-Type', 'application/json');
    
            // Define the data to be sent
            var data = JSON.stringify({ bf: bf });
    
            // Send the request
            xhr.send(data);
        }
    </script>
     
</div>
@endif --}}
                                    <form method="GET" action="{{ route('balance.daily') }}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="date">Start Date:</label>
                                                    <input type="date" class="form-control" id="date"
                                                        name="date" value="{{ $date }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary"
                                                    style="margin-top: 25px;" id="filter">Filter</button>
                                            
                                                {{-- <button type="reset" class="btn btn-primary"
                                                    style="margin-top: 25px; background-color:red;" value="Reset">Reset</button> --}}
                                            </div>
                                        </div>
                                    </form>
                                    {{-- <form method="GET" action="{{ route('balance.daily') }}">
                                        <div class="form-group">

                                            <label for="date">Date:</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                value="{{ $date }}" style="width: 300px;">

                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>

                                    </form> --}}

                                    <div style="margin-top: 10px;">
                                        <!-- Buttons for exporting data -->
                                        <a href="{{ route('balance.exportCSV', ['date' => $date]) }}"
                                            class="btn btn-primary">Export to CSV</a>

                                        <a href="{{ route('balance.exportPDF', ['date' => $date]) }}"
                                            class="btn btn-danger">Export to PDF</a>
                                    </div>
                                    {{-- {{$previousDate}} --}}
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
                                            <td>{{ $date }}</td>
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
                                            @else
                                                <th></th>
                                                <th>{{ $balance }}</th>
                                            @endif
                                        </tr>
                                    </table>
</body>

</html>
