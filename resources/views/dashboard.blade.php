<!DOCTYPE html>
<html lang="en">
<head>
  <title>TS3 Accounts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="#">Age</a></li>
        <li><a href="#">Gender</a></li>
        <li><a href="#">Geo</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <img src="{{asset('images/logo.jpeg')}}" alt="logo" height="100" width="100">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Dashboard</a></li>
        <li><a href="{{route('income.index')}}">Income</a></li>
        <li><a href="{{route('expence.index')}}">Expenses</a></li>
        <li><a href="{{route('salary.display')}}">Salary</a></li>
        <li><a href="{{route('assets.display')}}">Assets</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>TS3 Enterprises Accounts Dashboard</h4>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Income</h4>
            <p>Fetch data from income(sum)</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Expences</h4>
            <p>Fetch data from expenses(sum)</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Payable</h4>
            <p>Fetch data from expense report filterd by payable(sum)</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Credit</h4>
            <p>Fetch data from income report filterd by credit(sum)</p> 
          </div>
        </div>
      </div>
      {{-- <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-sm-8">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('income.create') }}" class="btn btn-primary">Add Income</a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="" class="btn btn-primary">Income Report</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

</body>
</html>