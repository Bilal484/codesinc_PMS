@extends('layouts.app')
<style>
    .search_section {
        display: flex;
        justify-content: space-between;

        margin: 10px;

        input {
            width: 200px;

        }
    }
</style>
@section('content')
    <div class=" mt-4">
        <h3>Employees Salaries</h3>

        <!-- Search Input -->
        <div class="mb-3 search_section">
            <a href="{{ route('salaries.create') }}" class="btn btn-primary mb-3">Add Salary</a>
            <input type="text" id="search" class="form-control" placeholder="Search ...">
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered table-striped" id="salariesTable">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $salary)
                    <tr>
                        <td>{{ $salary->id }}</td>
                        <td>{{ $salary->employee->name }}</td>
                        <td>{{ $salary->email }}</td>
                        <td>{{ $salary->amount }}</td>
                        <td>{{ $salary->payment_date }}</td>
                        <td>{{ $salary->remarks }}</td>
                        <td>
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#salariesTable tbody tr');

            rows.forEach(row => {
                let name = row.cells[1].innerText.toLowerCase();
                let email = row.cells[2].innerText.toLowerCase();
                let amount = row.cells[3].innerText.toLowerCase();
                let paymentDate = row.cells[4].innerText.toLowerCase();
                let remarks = row.cells[5].innerText.toLowerCase();
                if (name.includes(searchValue) || email.includes(searchValue) || amount.includes(
                        searchValue) ||
                    paymentDate.includes(searchValue) || remarks.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
