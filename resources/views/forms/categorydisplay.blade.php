<head>
    <title>Categories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  
<table class="table table-hover">
    <tr>
        <th>No</th>
        <th>Category</th>
    </tr>
    @foreach ($data as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->category}}</td>
    </tr>
    @endforeach
</table>

{{-- {{$data}} --}}