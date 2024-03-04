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
  @include('components.sidebar')
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