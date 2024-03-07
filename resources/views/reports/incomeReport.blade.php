<!DOCTYPE html>
<html>

<head>
    <title>Laravel DataTables Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Income Report</h2>
        <form>
            <label for="date_range">Select date range:</label>
            <input type="date" name="date_from" id="date_from">
            <input type="date" name="date_to" id="date_to">
            <button id="date-range-filter-btn">Filter</button>
            <label for="month">Select a month:</label>
            <select name="month" id="month">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>

            </select>
            <button id="month-filter-btn">Filter</button>
        </form>

        <table id="income-table" class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Type</th>

                </tr>
            </thead>
            <tbody>
            </tbody>

        </table>
    </div>


    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script> 

    <script>
        const ajaxUrl = @json(route('get-Income'));
        const cat = 'income';
        const token = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });

            // Event listener for date range filter button
            $('#date-range-filter-btn').on('click', function() {

                var date_from = $('#date_from').val();
                var date_to = $('#date_to').val();
                table.DataTable().ajax.url(ajaxUrl + '?date_from=' + date_from + '&date_to=' + date_to).load();
            });

            // Event listener for monthly filter button
            $('#month-filter-btn').on('click', function() {
                var month = $('#month').val();
                var url = ajaxUrl + '?month=' + month;
                table.DataTable().ajax.url(url).load(function() {
                    $('#month').val(month); // Set the selected month after loading
                });

            });
            
            var table = $('#income-table');
            var title = "Monthly Income Report";
            var columns = [0, 1, 2, 3, 4, 5];
            var dataColumns = [

                {
                    data: 'checkbox',
                    name: 'checkbox'
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'type',
                    name: 'type'
                },


            ];

            makeDataTable(table, title, columns, dataColumns);
        });


        function makeDataTable(table, title, columnArray, dataColumns) {

            $(table).dataTable({
                dom: "<'row'<'col-sm-1'l><'col-sm-8 pb-3 text-center'B><'col-sm-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                stateSave: false, // Enable state saving
                cache: true,
                pageLength: 15,
                "lengthMenu": [
                    [10, 15, 25, 50, -1],
                    [10, 15, 25, 50, "All"]
                ],
                buttons: [

                    $.extend(
                        true, {}, {
                            extend: "excelHtml5",
                            text: '<i class="fa fa-download "></i> Excel',
                            className: "btn btn-default btn-sm",
                            title: title,
                            exportOptions: {
                                columns: columnArray
                            }
                        }
                    ),

                    $.extend(
                        true, {}, {
                            extend: "pdfHtml5",
                            text: '<i class="fa fa-download"></i> Pdf',
                            className: "btn btn-default btn-sm",
                            title: title,
                            exportOptions: {
                                columns: columnArray
                            }
                        }
                    ),

                    $.extend(
                        true, {}, {
                            extend: "print",
                            exportOptions: {
                                columns: columnArray,
                                modifier: {
                                    selected: null
                                }
                            },
                            text: '<i class="fa fa-save"></i> Print',
                            className: "btn btn-default btn-sm",
                            title: title
                        }
                    ),


                ],
                ajax: ajaxUrl,
                columns: dataColumns,
                order: [
                    [0, "asc"]
                ]

            });

        }
   



    </script>
</body>

</html>
