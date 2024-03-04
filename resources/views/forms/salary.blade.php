<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style="background: #ddd;">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
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
        </nav>
        <div class="container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="Name">Date: </label>
                            <input type="text" class="form-control" id="salary_date" placeholder="Date"
                                name="salary_date" required>

                            <strong>salary Information</strong>
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
                                data-target="#myModal">Salary Detail</a>
                            <table class="table table-responsive table-bordered table-stripped"
                                style="margin-top:10px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Working days</th>
                                        <th>Salary per day</th>
                                        <th>Deduction</th>
                                        <th>Net Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->employee_name }}</td>
                                            <td>{{ $row->no_of_workin_days }}</td>
                                            <td>{{ $row->salary_per_day }}</td>
                                            <td>{{ $row->deduction }}</td>
                                            <td>{{ $row->netsalary }}</td>
                                            <td style="display: flex; flex-wrap: wrap; justify-content: space-around; ">
                                                {{-- <a href="{{ route('employee.show',$employee->id) }}" class="btn btn-primary btn-xs py-0" style="margin:2px;">Show</a>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-warning btn-xs py-0" style="margin:2px;">Edit</a> --}}
                                                <form action="{{ route('expence.update', $row->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning edit-salary-btn"
                                                        data-id="{{ $row->id }}" data-date="{{ $row->date }}"
                                                        data-description="{{ $row->description }}"
                                                        data-amount="{{ $row->amount }}"
                                                        data-type="{{ $row->type }}">
                                                        Edit
                                                    </button>
                                                </form>


                                                <form action="{{ route('salary.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
                </tr>
                @endforeach
                </tbody>
                </table>
                <div class="col-md-2"></div>



                <!-- Create Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style="padding: 20px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add salarys</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="{{ route('salary.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="salaryDate">Salary Date: </label>
                                    <input type="text" class="form-control" id="salary_date"
                                        placeholder="Employee ID" name="salary_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="ID">Employee ID: </label>
                                    <input type="text" class="form-control" id="empolyee_id"
                                        placeholder="Employee ID" name="empolyee_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name">Employee Name: </label>
                                    <input type="text" class="form-control" id="employee_name"
                                        placeholder="Employee Name" name="employee_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="WorkingDay">No of Working Days: </label>
                                    <input type="text" class="form-control" id="no_of_workin_days"
                                        placeholder="Work days" name="no_of_workin_days" required>
                                </div>
                                <div class="form-group">
                                    <label for="SalaryPerDay">salary per day: </label>
                                    <input type="text" class="form-control" id="salary_per_day"
                                        placeholder="Salary per day" name="salary_per_day" required>
                                </div>
                                <div class="form-group">
                                    <label for="Deduction">deduction: </label>
                                    <input type="text" class="form-control" id="deduction"
                                        placeholder="Deduction" name="deduction" required>
                                </div>
                                <div class="form-group">
                                    <label for="NetSalary">Net Salary: </label>
                                    <input type="text" class="form-control" id="netsalary"
                                        placeholder="Net Salary" name="netsalary" required>
                                </div>
                                <button type="submit">Submit</button>
                                </form>
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
                            <h4 class="modal-title">Edit salary</h4>
                        </div>
                        <div class="modal-body">
                            <form id="editsalaryForm" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="edit_salary_id" name="id">
                                <!-- Hidden field for salary ID -->
                                <div class="form-group">
                                    <label for="Name">Salary Date: </label>
                                    <input type="text" class="form-control" id="edit_salary_date"
                                        placeholder="Employee ID" name="edit_salary_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_id">Employee ID: </label>
                                    <input type="text" class="form-control" id="edit_empolyee_id"
                                        placeholder="Employee ID" name="empolyee_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_Name">Employee Name: </label>
                                    <input type="text" class="form-control" id="edit_employee_name"
                                        placeholder="Employee Name" name="employee_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name">No of Working Days: </label>
                                    <input type="text" class="form-control" id="edit_no_of_workin_days"
                                        placeholder="Work days" name="no_of_workin_days" required>
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
                                <button type="submit">Submit</button>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                // Add event listener to all edit buttons
                $('.edit-salary-btn').click(function() {
                    // Extract salary data from the corresponding row
                    var id= $(this).data('edit_salary_id')
                    var date = $(this).data('salary_date');
                    var id1 = $(this).data('employee_id');
                    var name = $(this).data('employee_name');
                    var d_sal = $(this).data('salary_per_day');
                    var w_days = $(this).data('no_of_workin_days');
                    var ded = $(this).data('deduction');
                    var net_sal = $(this).data('netsalary');
    
                    // Populate the modal form fields with the extracted salary data
                    $('#edit_salary_id').val(id);
                    $('#edit_salary_date').val(date);
                    $('#edit_employee_id').val(id1);
                    $('#edit_employee_name').val(name);
                    $('#edit_salary_per_day').val(d_sal);
                    $('#edit_no_of_workin_days').val(w_days);
                    $('#edit_deduction').val(ded);
                    $('#edit_netsalary').val(net_sal);
    
                    // Set the form action URL dynamically
                    $('#editsalaryForm').attr('action', "{{ route('expence.update', '') }}/" + id);
    
    
                    // Show the modal
                    $('#editModal').modal('show');
                    return false;
                });
    
                // Handle form submission when the editsalaryForm is submitted
                $('#editsalaryForm').submit(function(event) {
                    event.preventDefault();
    
                    var formData = $(this).serialize();
    
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST', // Tunnel the PUT request through a POST request
                        data: formData,
                        success: function(response) {
                            $('#editModal').modal('hide');
                            alert('salary updated successfully!');
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Failed to update salary. Please try again.');
                        }
                    });
                });
    
            });
        </script>
    
    
                    {{-- </x-guest-layout> --}}
</body>

</html>
