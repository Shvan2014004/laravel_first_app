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
            <div class="container">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h1>Filter Data by Month</h1>
                            <form method="GET" action="{{ route('expence.filterByMonth') }}">
                                <label for="month">Select a month:</label>
                                <select name="month" id="month">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>

                                </select>
                                <button type="submit">Filter</button>
                            </form>

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
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </body>

</html>
