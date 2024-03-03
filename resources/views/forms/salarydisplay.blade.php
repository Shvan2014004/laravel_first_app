<html>
<head>
    <title>Subcategories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    
<table class="table table-hover">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Working days</th>
        <th>Salary per day</th>
        <th>Deduction</th>
        <th>Net Salary</th>
    </tr>
    @foreach ($data as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->employee_name}}</td>
        <td>{{$row->no_of_workin_days}}</td>
        <td>{{$row->salary_per_day}}</td>
        <td>{{$row->deduction}}</td>
        <td>{{$row->netsalary}}</td>
    </tr>
    @endforeach
</table>
  </body>
  </html>

{{-- {{$data}} --}}