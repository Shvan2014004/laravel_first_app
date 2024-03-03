<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <center>
<table class="table table-hover">
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Sub Category</th>
    </tr>
    @foreach ($data as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$category=\App\Models\Category::where(['id'=>$row->category_id])->pluck('category')}}</td>
        <td>{{$row->sub_category}}</td>
    </tr>
    @endforeach
</table>
</center>
{{-- {{$data}} --}}