<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        Add
    </button>

    
    {{-- <x-guest-layout> --}}
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-inline" method="POST" action="{{ route('salary.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="Name">Date: </label>
                                <input type="text" class="form-control" id="salary_date" placeholder="Date"
                                    name="salary_date" required>
                            </div>
                            <div class="form-group">
                                <label for="Name">Employee ID: </label>
                                <input type="text" class="form-control" id="empolyee_id" placeholder="Employee ID"
                                    name="empolyee_id" required>
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
                                <input type="text" class="form-control" id="deduction" placeholder="Deduction"
                                    name="deduction" required>
                            </div>
                            <div class="form-group">
                                <label for="Name">Net Salary: </label>
                                <input type="text" class="form-control" id="netsalary" placeholder="Net Salary"
                                    name="netsalary" required>
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <script>
                    function add() {
                        var day = getElementById('no_of_workin_days').value;
                        var sal = getElementById('salary_per_day').value;
                        var ded = getElementById('deduction').value;
                        var nsal = (day * sal) - ded;
                        setElementByID('netsalary').value = nsal;
                        return nsal;
                    }
                    $('#myModal').on('shown.bs.modal', function() {
                        $('#myInput').trigger('focus')
                    })
                </script>
    {{-- </x-guest-layout> --}}
</body>

</html>
