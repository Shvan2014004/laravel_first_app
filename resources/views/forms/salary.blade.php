<x-guest-layout>
    <form method="POST" action="{{ route('salary.store') }}">
        @csrf 
        <div class="form-group">
            <label for="Name">Date: </label>
            <input type="text" class="form-control" id="salary_date" placeholder="Date" name="salary_date" required>
           </div>
           <div class="form-group">
            <label for="Name">Employee ID: </label>
            <input type="text" class="form-control" id="empolyee_id" placeholder="Employee ID" name="empolyee_id" required>
           </div>
           <div class="form-group">
            <label for="Name">Employee Name: </label>
            <input type="text" class="form-control" id="employee_name" placeholder="Employee Name" name="employee_name" required>
           </div>
           <div class="form-group">
            <label for="Name">No of Working Days: </label>
            <input type="text" class="form-control" id="no_of_workin_days" placeholder="Work days" name="no_of_workin_days" required>
           </div>
           <div class="form-group">
            <label for="Name">salary per day: </label>
            <input type="text" class="form-control" id="salary_per_day" placeholder="Work days" name="salary_per_day" required>
           </div>
           <div class="form-group">
            <label for="Name">deduction: </label>
            <input type="text" class="form-control" id="deduction" placeholder="Work days" name="deduction" required>
           </div>
           <div class="form-group">
            <label for="Name">deduction: </label>
            <input type="text" class="form-control" id="netsalary" placeholder="Work days" name="netsalary" required>
           </div>
           <button type="submit">Submit</button>
    </form>
</x-guest-layout>

