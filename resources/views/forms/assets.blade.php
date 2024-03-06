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
            {{-- @include('components.sidebar') --}}
            <div class="well">
                <h4>Salary</h4>
            </div>
            <div id="app" style="width: 100%">
                <div class="container" style="width: 100%">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" style="width: 100%">
                        <div class="panel panel-default">
                            <div class="panel-body">



                                <strong>Assets Information</strong>
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
                                    data-target="#myModal">Create assets</a>
                                <table class="table table-responsive table-bordered table-stripped"
                                    style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Assets</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td
                                                    style="display: flex; flex-wrap: wrap; justify-content: space-around; ">
                                                    {{-- <a href="{{ route('employee.show',$employee->id) }}" class="btn btn-primary btn-xs py-0" style="margin:2px;">Show</a>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-warning btn-xs py-0" style="margin:2px;">Edit</a> --}}
                                                    <form action="{{ route('assets.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning edit-assets-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-description="{{ $item->description }}"
                                                            data-amount="{{ $item->amount }}"
                                                            data-sub_category_id="{{ $item->sub_category_id }}">
                                                            Edit
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('assets.destroy', $item->id) }}"
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
                                    <h4 class="modal-title">Add Assets</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="assetsForm" method="POST"
                                        action="{{ route('assets.store') }}">
                                        @csrf

                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="Name">Description </label>
                                            <input type="text" class="form-control" id="description"
                                                placeholder="Description" name="description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Amount: </label>
                                            <input type="text" class="form-control" id="amount"
                                                placeholder="Amount" name="amount" required>
                                        </div>
                                        @csrf
                                        <div class="form-group">
                                            <label for="Name">Sub Category </label>
                                            {{-- <input type="text" class="form-control" id="sub_category_id" placeholder="Sub Category" name="sub_category_id" required> --}}

                                            <select name="sub_category_id" class="form-control">
                                                <option value="">Select a assets</option>
                                                @foreach ($category as $row)
                                                    <option value="{{ $row->id }}">
                                                        {{ $row->sub_category }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset"
                                            class="btn btn-primary"onclick="resetForm()">Reset</button>
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
                                    <h4 class="modal-title">Edit assets</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="editassetsForm" action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="edit_assets_id" name="id">
                                        <!-- Hidden field for expense ID -->
                                        <div class="form-group">
                                            <label for="Name">Description </label>
                                            <input type="text" class="form-control" id="edit_description"
                                                placeholder="Description" name="description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Amount: </label>
                                            <input type="text" class="form-control" id="edit_amount"
                                                placeholder="Amount" name="amount" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="Name">Sub Category </label>
                                            {{-- <input type="text" class="form-control" id="sub_category_id" placeholder="Sub Category" name="sub_category_id" required> --}}

                                            <select class="form-control" name="sub_category_id"
                                                id="edit_sub_category_id">
                                                <option value="">Select a assets</option>
                                                @foreach ($category as $row)
                                                    <option value="{{ $row->id }}">
                                                        {{ $row->sub_category }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                        <div class="modal-footer">
                                           

                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                 
                                </div>
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
                        $('.edit-assets-btn').click(function() {
                                // Extract expense data from the corresponding row
                                var id = $(this).data('id');
                                var description = $(this).data('description');
                                var amount = $(this).data('amount');
                                var sub_category_id = $(this).data('sub_category_id');


                                // Populate the modal form fields with the extracted expense data
                                $('#edit_assets_id').val(id);
                                $('#edit_description').val(description);
                                $('#edit_amount').val(amount);
                                $('#edit_sub_category_id').val(sub_category_id);

                                    // Set the form action URL dynamically
                                    $('#editassetsForm').attr('action', "{{ route('assets.update', '') }}/" + id);


                                    // Show the modal
                                    $('#editModal').modal('show');
                                    return false;
                                });

                            // Handle form submission when the editassetsForm is submitted
                            $('#editassetsForm').submit(function(event) {
                                event.preventDefault();

                                var formData = $(this).serialize();

                                $.ajax({
                                    url: $(this).attr('action'),
                                    type: 'POST', // Tunnel the PUT request through a POST request
                                    data: formData,
                                    success: function(response) {
                                        window.location.href = '/assets';
                                        $('#editModal').modal('hide');
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                        alert('Failed to update assets. Please try again.');
                                    }
                                });
                            });

                        });
        </script>


</body>

</html>
