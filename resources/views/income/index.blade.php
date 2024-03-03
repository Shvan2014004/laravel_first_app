<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Create Income</title>
</head>

<body>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Get INcome Report</h3>
                <form class="form-horizontal" method="POST" action="{{ route('income.store') }}">

                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Name">Date: </label>
                        <input type="text" class="form-control" id="date" placeholder="Date" name="date"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="Name">Description: </label>
                        <input type="text" class="form-control" id="description" placeholder="Description"
                            name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Amount: </label>
                        <input type="number" class="form-control" id="amount" placeholder="Amount" name="amount"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mode: </label>
                        <select class="form-control" id="type" name="type" required focus>
                            <option value="Cash"> Cash</option>
                            <option value="Cheque"> Cheque</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" value="Send">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
