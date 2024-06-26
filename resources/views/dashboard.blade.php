<!DOCTYPE html>
<html lang="en">

<head>
    <title>TS3 Accounts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/ style="border-radius: 50%">
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }

        .heading {
            background-color: #337ab7 !important;
        }

        .box {
            background-color: #41C9E2 !important;
        }

        .heading h3 {
            text-transform: uppercase;
            color: white !important;
            margin: 0 !important;
        }
        /* #myChart{
            height: 300px!important;
            width: 400px!important;
        } */
    </style>
</head>

<body>
    {{-- @include('components.authSection') --}}
    

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row content">
                @include('components.sidebar')
                <div class="well heading">
                    <h3>TS3 Enterprises Accounts Analysis</h3>
                </div>
                <div id="app" style="width: 100%">
                    <div class="container" style="width: 100%">
                        <div class="col-md-2"></div>
                        <div class="col-md-8" style="width: 100%">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="well box">
                                                <h4>Income</h4>
                                                <b>
                                                    <h3>Rs. {{ App\Models\Income::sum('amount') }}</h3>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="well box">
                                                <h4>Expences</h4>
                                                <b>
                                                    <h3>Rs. {{ App\Models\Expence::sum('amount') }}</h3>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="well box">
                                                <h4>Today Debit</h4>
                                                <b>
                                                    <h3>Rs.
                                                        {{ App\Models\Income::where('date', '=', today())->sum('amount') }}
                                                    </h3>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="well box">
                                                <h4>Today Credit</h4>
                                                <b>
                                                    <h3>Rs.
                                                        {{ App\Models\Expence::where('date', '=', today())->sum('amount') }}
                                                    </h3>
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

</body>

</html>
