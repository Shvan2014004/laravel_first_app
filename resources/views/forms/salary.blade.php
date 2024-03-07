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
                    {{-- <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                </div>
            </div>
        </nav> --}}
                    

                                    {{-- <form action="{{ route('salary.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label for="">Date From</label>
                                    <input type="date" name="date_from" class="form-control"
                                        value="{{ $request->date_from }}">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="">Date From</label>
                                    <input type="date" name="date_to" class="form-control"
                                        value="{{ $request->date_to }}">
                                </div>
                                <div class="col-md-2 form-group" style="margin-top:25px;">
                                    <input type="submit" class="btn btn-primary btn-md"
                                        style="background-color: #337ab7" value="Search">
                                </div>
                            </div>
                        </form> --}}

                                    <strong>Salary details</strong>
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
                                        data-target="#myModal">Create Salary</a>
                                    <table class="table table-responsive table-bordered table-stripped"
                                        style="margin-top:10px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Salary Month</th>
                                                <th># of Working Days</th>
                                                <th>Salary Per Day</th>
                                                <th>Deduction</th>
                                                <th>Net Salary</th>
                                                <th style="width: 150px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salary as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->empolyee_id }}</td>
                                                    <td>{{ $item->employee_name }}</td>
                                                    <td>{{ $item->month_name }}</td>
                                                    <td>{{ $item->no_of_workin_days }}</td>
                                                    <td>{{ $item->salary_per_day }}</td>
                                                    <td>{{ $item->deduction }}</td>
                                                    <td>{{ $item->netsalary }}</td>
                                                    <td
                                                        style="display: flex; flex-wrap: wrap; justify-content: space-around; ">
                                                        {{-- <a href="{{ route('employee.show',$employee->id) }}" class="btn btn-primary btn-xs py-0" style="margin:2px;">Show</a>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-warning btn-xs py-0" style="margin:2px;">Edit</a> --}}
                                                        <form action="{{ route('salary.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-warning edit-salary-btn"
                                                                data-id="{{ $item->id }}"
                                                                data-empolyee_id="{{ $item->empolyee_id }}"
                                                                data-employee_name="{{ $item->employee_name }}"
                                                                data-salary_date="{{ $item->salary_date }}"
                                                                data-no_of_workin_days="{{ $item->no_of_workin_days }}"
                                                                data-salary_per_day="{{ $item->salary_per_day }}"
                                                                data-deduction="{{ $item->deduction }}"
                                                                data-netsalary="{{ $item->netsalary }}">
                                                                Edit
                                                            </button>
                                                        </form>


                                                        <form action="{{ route('salary.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- {{ $salary->links() }} --}}
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
                                        <form class="form-horizontal" id="expenseForm" method="POST"
                                            action="{{ route('salary.store') }}">

                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="Name">Date: </label>
                                                <input type="text" class="form-control" id="salary_date"
                                                    placeholder="Date" name="salary_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Employee ID: </label>
                                                <input type="text" class="form-control" id="empolyee_id"
                                                    placeholder="Employee ID" name="empolyee_id" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Employee Name: </label>
                                                <input type="text" class="form-control" id="employee_name"
                                                    placeholder="Employee Name" name="employee_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">No of Working Days: </label>
                                                <input type="text" class="form-control" id="no_of_workin_days"
                                                    placeholder="Work days" name="no_of_workin_days" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">salary per day: </label>
                                                <input type="text" class="form-control" id="salary_per_day"
                                                    placeholder="Salary per day" name="salary_per_day" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">deduction: </label>
                                                <input type="text" class="form-control" id="deduction"
                                                    placeholder="Deduction" name="deduction" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Net Salary: </label>
                                                <input type="text" class="form-control" id="netsalary"
                                                    placeholder="Net Salary" name="netsalary" required>
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
                                        <h4 class="modal-title">Edit Salary</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editSalaryForm" action="" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="edit_salary_id" name="id">
                                            <!-- Hidden field for expense ID -->
                                            <div class="form-group">
                                                <label for="edit_Salary_date">Salary Date: </label>
                                                <input type="text" class="form-control" id="edit_salary_date"
                                                    placeholder="Date" name="salary_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_employee_id">Employee ID: </label>
                                                <input type="text" class="form-control" id="edit_empolyee_id"
                                                    placeholder="Employee ID" name="empolyee_id" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_Name">Employee Name: </label>
                                                <input type="text" class="form-control" id="edit_employee_name"
                                                    placeholder="Employee Name" name="employee_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_work_day">No of Working Days: </label>
                                                <input type="text" class="form-control"
                                                    id="edit_no_of_workin_days" placeholder="Work days"
                                                    name="no_of_workin_days" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">salary per day: </label>
                                                <input type="text" class="form-control" id="edit_salary_per_day"
                                                    placeholder="Salary per day" name="salary_per_day" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">deduction: </label>
                                                <input type="text" class="form-control" id="edit_deduction"
                                                    placeholder="Deduction" name="deduction" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Name">Net Salary: </label>
                                                <input type="text" class="form-control" id="edit_netsalary"
                                                    placeholder="Net Salary" name="netsalary" required>
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
            $('.edit-salary-btn').click(function() {
                // Extract expense data from the corresponding row
                var id = $(this).data('id');
                var eid = $(this).data('empolyee_id');
                var name = $(this).data('employee_name');
                var date = $(this).data('salary_date');
                var days = $(this).data('no_of_workin_days');
                var salary = $(this).data('salary_per_day');
                var deduction = $(this).data('deduction');
                var netsalary = $(this).data('netsalary');

                // Populate the modal form fields with the extracted expense data
                $('#edit_salary_id').val(id);
                $('#edit_empolyee_id').val(eid);
                $('#edit_employee_name').val(name);
                $('#edit_salary_date').val(date);
                $('#edit_no_of_workin_days').val(days);
                $('#edit_salary_per_day').val(salary);
                $('#edit_deduction').val(deduction);
                $('#edit_netsalary').val(netsalary);

                // Set the form action URL dynamically
                $('#editSalaryForm').attr('action', "{{ route('salary.update', '') }}/" + id);


                // Show the modal
                $('#editModal').modal('show');
                return false;
            });

            // Handle form submission when the editSalaryForm is submitted
            $('#editSalaryForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST', // Tunnel the PUT request through a POST request
                    data: formData,
                    success: function(response) {
                        window.location.href = '/salary';
                        $('#editModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Failed to update salary. Please try again.');
                    }
                });
            });

        });
    </script>


</body>

</html>
