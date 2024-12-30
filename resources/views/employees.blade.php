@extends('app')



@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.4.3/js/scroller.dataTables.js"></script>
    <script src="https://cdn.datatables.net/keytable/2.12.1/js/dataTables.keyTable.js"></script>
    <script src="https://cdn.datatables.net/keytable/2.12.1/js/keyTable.dataTables.js"></script>



    <script>
        $(document).ready(function() {

            @if(Route::is('employees'))
                $('#myTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('get.employees') }}",
                        "type": "GET"
                    },
                    columns: [
                        { data: 'emp_no' },
                        { data: 'birth_date' },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'gender' },
                        { data: 'hire_date' }
                    ]
                });
            @elseif(Route::is('scroll.employees'))
                $('#myTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "scroller": true,
                    "scrollY": "700px",
                    "searching": false,

                    "info": false,
                    "ordering": false,

                    "ajax": {
                        "url": "{{ route('get.employees') }}",
                        "type": "GET"
                    },
                    "columns": [
                        { data: 'emp_no' },
                        { data: 'birth_date' },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'gender' },
                        { data: 'hire_date' },
                        { data: 'title' },
                        {
                            data: 'emp_no',
                            render: function (data, type, row) {
                                return `<a href="/employee/details/${data}">View Details</a>`;
                            }
                        }
                    ]
                });
            @endif
        });

    </script>

    <style>
        .dt-scroll-head{
            display: none;
        }
        .dt-length{
            display: none;
        }
        .dt-paging{
            display: none;
        }
    </style>
@endpush


@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.12.1/css/keyTable.dataTables.css">


@endpush

@section('contents')
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>Employee No.</th>
                <th>Birth Day</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Hire Date</th>
                <th>Title</th>
                <th>Link</th>

            </tr>
        </thead>
    </table>
@endsection
