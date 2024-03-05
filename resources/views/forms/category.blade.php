{{-- @extends('layouts.app') --}}
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
    <div class="container-fluid">
        <div class="row content">
            @include('components.sidebar')
            <div class="well">
                <h4>Salary</h4>
            </div>
            <div id="app" style="width: 100%">
                <div class="container" style="width: 100%">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" style="width: 100%">
                        <div class="panel panel-default">
                            <div class="panel-body">



                                <strong>Sub Category Information</strong>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <a class="btn btn-primary btn-xs pull-right py-0" data-toggle="modal"
                                    data-target="#myModal">Create category</a>
                                <table class="table table-responsive table-bordered table-stripped"
                                    style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td
                                                    style="display: flex; flex-wrap: wrap; justify-content: space-around; ">
                                                    {{-- <a href="{{ route('employee.show',$employee->id) }}" class="btn btn-primary btn-xs py-0" style="margin:2px;">Show</a>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-warning btn-xs py-0" style="margin:2px;">Edit</a> --}}
                                                    <form action="{{ route('category.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning edit-category-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-sub_category="{{ $item->sub_category }}"
                                                            data-category_id="{{ $item->employee_name }}">
                                                            Edit
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('category.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $category->links() }} --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>



                    <!-- Create Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content" style="padding: 20px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Expenses</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="categoryForm" method="POST"
                                        action="{{ route('category.store') }}">

                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="Name">Category: </label>
                                            <input type="text" class="form-control" id="category"
                                                placeholder="Category" name="category" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-primary"
                                            onclick="resetForm()">Reset</button>
                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                                <div class="modal-footer">


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content" style="padding: 20px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit category</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="editcategoryForm" action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="edit_category_id" name="id">
                                        <!-- Hidden field for expense ID -->
                                        <div class="form-group">
                                            <label for="Name">Category: </label>
                                            <input type="text" class="form-control" id="category"
                                                placeholder="Category" name="category" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                                <div class="modal-footer">


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script>
                function resetForm() {
                    document.getElementById("expenseForm").reset();
                }
                $(document).ready(function() {
                    // Add event listener to all edit buttons
                    $('.edit-category-btn').click(function() {
                        // Extract expense data from the corresponding row
                        var id = $(this).data('id');
                        var category = $(this).data('category');


                        // Populate the modal form fields with the extracted expense data
                        $('#edit_category_id').val(id);
                        $('#edit_category').val(category);


                        // Set the form action URL dynamically
                        $('#editcategoryForm').attr('action', "{{ route('category.update', '') }}/" + id);


                        // Show the modal
                        $('#editModal').modal('show');
                        return false;
                    });

                    // Handle form submission when the editcategoryForm is submitted
                    $('#editcategoryForm').submit(function(event) {
                        event.preventDefault();

                        var formData = $(this).serialize();

                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST', // Tunnel the PUT request through a POST request
                            data: formData,
                            success: function(response) {
                                window.location.href = '/category';
                                $('#editModal').modal('hide');
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Failed to update category. Please try again.');
                            }
                        });
                    });

                });
            </script>


</body>

</html>
