@extends('layouts.app')

@section('content')
    <style>
        .error {
            color: red;
        }

        .search_section {
            display: flex;
            justify-content: space-between;

            margin: 10px;

            input {
                width: 200px;

            }
        }
    </style>
    <div class="row mx-auto">
        {{-- <div class="col-lg-3"></div> --}}
        <div class="col-lg-12">
            <h3 class="my-4">Employees Salary List:</h3>

            @if (session('success'))
                <div class="alert alert-success mt-4">{{ session('success') }}</div>
            @endif

            <!-- Search Input -->
            <div class="mb-3  search_section">
                <a href="{{ route('employees.create') }}"><button class="btn btn-primary">Add Employee</button></a>
                <input type="text" id="search" class="form-control"
                    placeholder="Search ...">
            </div>

            <table class="table table-bordered mt-4" id="employeeSalariesTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Bank Name</th>
                        <th>Bank Account Number</th>
                        <th>IFSC Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeSalaries as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->salary }}</td>
                            <td>{{ $employee->bank_name }}</td>
                            <td>{{ $employee->bank_account_number }}</td>
                            <td>{{ $employee->ifsc_code }}</td>
                            <td>
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#employeeSalariesTable tbody tr');

            rows.forEach(row => {
                let name = row.cells[0].innerText.toLowerCase();
                let salary = row.cells[1].innerText.toLowerCase();
                let bankName = row.cells[2].innerText.toLowerCase();
                let bankAccountNumber = row.cells[3].innerText.toLowerCase();
                let ifscCode = row.cells[4].innerText.toLowerCase();
                if (name.includes(searchValue) || salary.includes(searchValue) || bankName.includes(
                        searchValue) ||
                    bankAccountNumber.includes(searchValue) || ifscCode.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
