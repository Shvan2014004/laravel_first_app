<head>
    <title>TS3 Accounts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #ebecead7;
            height: 100%;
            width: 200px;
            position: fixed;;
            z-index: 1;
            top: 0;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
            float: left;
            display:inline;
        }

        /* Style the sidenav links and the dropdown button */
        .sidenav a,
        .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: #040000;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }

        /* On mouse-over */
        .sidenav a:hover,
        .dropdown-btn:hover {
            color: rgb(93, 88, 88);
        }

        .active {
            background-color: rgb(200, 203, 200);
            color: white;
        }

        .dropdown-container {
            display: none;
            background-color: #ebecead7;
            padding-left: 8px;
            font-size: 18px;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>


    <div class="col-sm-3 sidenav hidden-xs" style="width: 15%">
        <img src="{{ asset('images/logo.jpeg') }}" alt="logo" height="100" width="100">
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('income.index') }}">Income</a></li>
            <li><a href="{{ route('expence.store') }}">Expenses</a></li>
            <li><a href="{{ route('salary.store') }}">Salary</a></li>
            <li><button class="dropdown-btn">Assets
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="{{ route('category.store') }}" style="font-size: 18px">Category</a>
                    <a href="{{ route('subcategory.store') }}" style="font-size: 18px">Sub Category</a>
                    <a href="{{ route('assets.store') }}" style="font-size: 18px">Assets</a>
                    
                </div>
            </li>
            <li><button class="dropdown-btn">Reports
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="{{ route('get-Income') }}" style="font-size: 18px">Income Report</a>
                    <a href="#" style="font-size: 18px">Expence Report</a>
                    <a href="#" style="font-size: 18px">Daily Report</a>
                    <a href="#" style="font-size: 18px">Monthly Report</a>
                </div>
            </li>
        </ul><br>
    </div>
    <br>

    <div class="col-sm-9" style="width: 84%; float:inline-end">



        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
