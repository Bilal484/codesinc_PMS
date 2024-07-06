<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="x-csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title', Option::get('app_name', 'Codesinc'))</title>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    @yield('ext_css')
    {!! Html::style('assets/css/app.css') !!}
</head>

<body>
    <div id="wrapper">

        @include('layouts.partials.sidebar')

        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @include('layouts.partials.footer')
    </div>
    <!-- /#wrapper -->

    {!! Html::script(url('assets/js/jquery.js')) !!}
    {!! Html::script(url('assets/js/bootstrap.min.js')) !!}
    @include('layouts.partials.noty')
    {!! Html::script(url('assets/js/plugins/metisMenu/metisMenu.min.js')) !!}
    @yield('ext_js')
    {!! Html::script(url('assets/js/sb-admin-2.js')) !!}

    <script type="text/javascript">
        (function() {
            $("div.alert.notifier, div.alert.add-cart-notifier").delay(5000).slideUp('slow');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="x-csrf-token"]').attr('content')
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + "{{ auth()->user()->api_token }}");
                }
            });
        })();
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('employees.get') }}',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    let employeeSelect = $('#employeeSelect');
                    employeeSelect.empty(); // Clear existing options
                    employeeSelect.append(new Option('Select Employee', '')); // Add default option
                    response.forEach(employee => {
                        employeeSelect.append(new Option(employee.name, employee.id));
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching employees:', error);
                    alert('Failed to load employees. Please try again later.');
                }
            });
        });
    </script>

    @yield('script')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
</body>

</html>
