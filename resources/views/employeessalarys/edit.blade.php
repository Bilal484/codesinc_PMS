@extends('layouts.app')
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    h1 {
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    label {
        font-weight: bold;
        color: #555;
    }

    input[type="text"],
    input[type="email"] {
        padding: 10px;
        font-size: 1.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    button {
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h3>Edit Employees Account Details</h3>
            <a href="{{ route('employees.index') }}"><Button class="btn btn-info">Go Back</Button></a>
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $employee->name) }}">
                </div>
              
                <div>
                    <label for="salary">Salary:</label>
                    <input type="text" id="salary" name="salary" value="{{ old('salary', $employee->salary) }}">
                </div>
                <div>
                    <label for="bank_name">Bank Name:</label>
                    <input type="text" id="bank_name" name="bank_name"
                        value="{{ old('bank_name', $employee->bank_name) }}">
                </div>
                <div>
                    <label for="bank_account_number">Bank Account Number:</label>
                    <input type="text" id="bank_account_number" name="bank_account_number"
                        value="{{ old('bank_account_number', $employee->bank_account_number) }}">
                </div>
                <div>
                    <label for="ifsc_code">IFSC Code:</label>
                    <input type="text" id="ifsc_code" name="ifsc_code"
                        value="{{ old('ifsc_code', $employee->ifsc_code) }}">
                </div>
                <button class="btn btn-info" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
