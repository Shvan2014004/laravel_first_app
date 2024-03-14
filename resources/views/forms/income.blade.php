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
                <h4>Income</h4>
            </div>
            <div id="app" style="width: 100%">
                <div class="container" style="width: 100%">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" style="width: 100%">
                        <div class="panel panel-default">
                            <div class="panel-body">


                                <strong>Income Information</strong>
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
                                    data-target="#myModal">Create Income</a>
                                <table class="table table-responsive table-bordered table-stripped"
                                    style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th style="width: 150px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($income as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td
                                                    style="display: flex; flex-wrap: wrap; justify-content: space-around; ">
                                                    {{-- <a href="{{ route('employee.show',$employee->id) }}" class="btn btn-primary btn-xs py-0" style="margin:2px;">Show</a>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-warning btn-xs py-0" style="margin:2px;">Edit</a> --}}
                                                    <form action="{{ route('income.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning edit-income-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-date="{{ $item->date }}"
                                                            data-description="{{ $item->description }}"
                                                            data-amount="{{ $item->amount }}"
                                                            data-type="{{ $item->type }}">
                                                            Edit
                                                        </button>
                                                    </form>


                                                    <form action="{{ route('income.destroy', $item->id) }}"
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
                                {{ $income->links() }}
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
                                    <h4 class="modal-title">Add Income Data</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="incomeForm" method="POST"
                                        action="{{ route('income.store') }}">

                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="Name">Date: </label>

                                            <input type="date" class="form-control" id="date" name="date"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Name">Description: </label>
                                            <input type="text" class="form-control" id="description"
                                                placeholder="Description" name="description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Amount: </label>
                                            <input type="number" class="form-control" id="amount"
                                                placeholder="Amount" name="amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Mode: </label>
                                            <select class="form-control" id="type" name="type" required focus>
                                                <option value="Cash"> Cash</option>
                                                <option value="Cheque"> Cheque</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-primary"
                                                onclick="resetForm()">Reset</button>
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>

                                    </form>
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
                                    <h4 class="modal-title">Edit Income Data</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="editIncomeForm" action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="edit_income_id" name="id">
                                        <!-- Hidden field for income ID -->
                                        <div class="form-group">
                                            <label for="edit_date">Date:</label>
                                            <input type="date" class="form-control" id="edit_date" name="date"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_description">Description:</label>
                                            <input type="text" class="form-control" id="edit_description"
                                                name="description" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_amount">Amount:</label>
                                            <input type="number" class="form-control" id="edit_amount"
                                                name="amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_type">Type:</label>
                                            <select class="form-control" id="edit_type" name="type" required>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary">Submit</button>

                                    <button type="button" class="btn btn-primary"
                                        data-dismiss="modal">Close</button>
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
                    document.getElementById("incomeForm").reset();
                }
                $(document).ready(function() {
                    // Add event listener to all edit buttons
                    $('.edit-income-btn').click(function() {
                        // Extract income data from the corresponding row
                        var id = $(this).data('id');
                        var date = $(this).data('date');
                        var description = $(this).data('description');
                        var amount = $(this).data('amount');
                        var type = $(this).data('type');

                        // Populate the modal form fields with the extracted income data
                        $('#edit_income_id').val(id);
                        $('#edit_date').val(date);
                        $('#edit_description').val(description);
                        $('#edit_amount').val(amount);
                        $('#edit_type').val(type);

                        // Set the form action URL dynamically
                        $('#editIncomeForm').attr('action', "{{ route('income.update', '') }}/" + id);


                        // Show the modal
                        $('#editModal').modal('show');
                        return false;
                    });

                    // Handle form submission when the editIncomeForm is submitted
                    $('#editIncomeForm').submit(function(event) {
                        event.preventDefault();

                        var formData = $(this).serialize();

                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST', // Tunnel the PUT request through a POST request
                            data: formData,
                            success: function(response) {
                                window.location.href = '/income';
                                $('#editModal').modal('hide');
                                // alert('Income updated successfully!');
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Failed to update income. Please try again.');
                            }
                        });
                    });

                });
            </script>


</body>

</html>
