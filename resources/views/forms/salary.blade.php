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
    <style>
        .create-salary {
            padding: 8px 9px !important;
            margin-bottom: 8px !important;
        }

        .well {
            background-color: #337ab7 !important;
        }

        .well h3 {
            text-transform: uppercase;
            color: white !important;
            margin: 0 !important;
        }
    </style>

</head>

<body style="background: #ddd;">
    <div class="container-fluid">
        <div class="row content">
            @include('components.sidebar')
            <div class="well">
                <h3>Salary</h3>
            </div>
            <div id="app" style="width: 100%">
                <div class="container" style="width: 100%">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" style="width: 100%">
                        <div class="panel panel-default">
                            <div class="panel-body">


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
                                <a class="btn btn-primary btn-xs pull-right py-0 create-salary" data-toggle="modal"
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
                                                <td>{{ $item->no_of_workin_days * $item->salary_per_day - $item->deduction }}
                                                </td>
                                                <td
                                                    style="display: flex; flex-wrap: wrap; justify-content: space-around; ">

                                                    <form action="{{ route('salary.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning edit-salary-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-empolyee_id="{{ $item->empolyee_id }}"
                                                            data-employee_name="{{ $item->employee_name }}"
                                                            data-salary_date="{{ $item->salary_date }}"
                                                            data-no_of_workin_days="{{ $item->no_of_workin_days }}"
                                                            data-salary_per_day="{{ $item->salary_per_day }}"
                                                            data-deduction="{{ $item->deduction }}"
                                                            data-netsalary="{{ $item->no_of_workin_days * $item->salary_per_day - $item->deduction }}">
                                                            Edit
                                                        </button>
                                                    </form>


                                                    <form action="{{ route('salary.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger show-alert-delete-box" data-toggle="tooltip">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $salary->links() }}
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
                                            <input type="date" class="form-control" id="salary_date"
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
                                                placeholder="Net Salary" name="netsalary" required readonly>
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
                                            <input type="date" class="form-control" id="edit_salary_date"
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
                                                placeholder="Net Salary" name="netsalary" required readonly>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(document).on('click', '.show-alert-delete-box', function(event){
                        var form =  $(this).closest("form");
            
                        event.preventDefault();
                        swal({
                            title: "Are you sure you want to delete this record?",
                            text: "If you delete this, it will be gone forever.",
                            icon: "warning",
                            type: "warning",
                            buttons: ["Cancel","Yes!"],
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            }
                        });
                    });
                });
            </script>
    <script>
        // Function to calculate net salary
        function calculateNetSalary() {
            var days = parseFloat($('#no_of_workin_days').val());
            var salary = parseFloat($('#salary_per_day').val());
            var deduction = parseFloat($('#deduction').val());

            if (!isNaN(days) && !isNaN(salary) && !isNaN(deduction)) {
                var netsalary = (days * salary) - deduction;
                $('#netsalary').val(netsalary.toFixed(2)); // Display the net salary with two decimal places
            }
        }

        // Add event listeners to input fields to trigger calculation
        $('#no_of_workin_days, #salary_per_day, #deduction').on('input', calculateNetSalary);

        // Initialize net salary calculation on page load
        $(document).ready(calculateNetSalary);

        // Function to calculate net salary in edit modal
        function calculateEditNetSalary() {
            var days = parseFloat($('#edit_no_of_workin_days').val());
            var salary = parseFloat($('#edit_salary_per_day').val());
            var deduction = parseFloat($('#edit_deduction').val());

            if (!isNaN(days) && !isNaN(salary) && !isNaN(deduction)) {
                var netsalary = (days * salary) - deduction;
                $('#edit_netsalary').val(netsalary.toFixed(2)); // Display the net salary with two decimal places
            }
        }

        // Add event listeners to input fields in edit modal to trigger calculation
        $('#edit_no_of_workin_days, #edit_salary_per_day, #edit_deduction').on('input', calculateEditNetSalary);

        // Initialize net salary calculation in edit modal on modal show
        $('#editModal').on('show.bs.modal', function() {
            calculateEditNetSalary(); // Calculate net salary when modal is shown
        });
    </script>
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
