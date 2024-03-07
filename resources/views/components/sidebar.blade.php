<head>
    <title>TS3 Accounts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

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
    </style>
</head>

<body>


    <div class="col-sm-3 sidenav hidden-xs" style="width: 15%">
        <img src="{{ asset('images/logo.jpeg') }}" alt="logo" height="100" width="100">
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('income.store') }}">Income</a></li>
            <li><a href="{{ route('expence.store') }}">Expenses</a></li>
            <li><a href="{{ route('salary.index') }}">Salary</a></li>
            <li><a href="{{route('assets.index')}}">Assets</a></li>
            <li data-toggle="collapse" data-target="#reports"><a href="#">Reports</a></li>
            <ul id="reports" class="collapse">
                <li data-toggle="collapse" data-target="#expence"><a href="#">Expense Report</a></li>
                <ul id="expence" class="collapse">
                    <li><a href="{{ route('expence.filterByMonth') }}">Monthly Expense Report</a></li>
                    <li><a href="{{ route('expence.filterByDateRange') }}">Annual Expense Report</a></li>
                </ul>
            </ul>
        </ul><br>
    </div>
    <br>

    <div class="col-sm-9" style="width: 84%">
