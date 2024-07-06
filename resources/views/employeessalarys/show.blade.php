@extends('layouts.app')


<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .my-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: row;
        margin-bottom: 1.5rem;
        width: 100%
    }

    .card img {
        width: 100%;
        height: auto;
    }

    .card-body {
        padding: 20px;
        flex: 1;
    }

    .card-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #333;
        font-weight: 700;
        margin-left: 30px;

    }

    .card-text {
        font-size: 1.5rem;
        /* margin-bottom: 0.5rem; */
        margin: 20px;
        color: #555;
    }

    .card-text i {
        margin-right: 0.5rem;
        color: #888;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn i {
        margin-right: 0.5rem;
    }

    .btn-primary {
        background-color: #007bff;
    }
</style>
@section('content')
    <div class="container">
        <h3 class="my-4">Account Details</h3>
        <div class="card row mb-4 shadow-sm">
            <div class=" no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ $employee->name }}</h5>
                       
                        <p class="card-text"><i class="fas fa-dollar-sign"></i> <strong>Salary:</strong>
                            {{ $employee->salary }}</p>
                        <p class="card-text"><i class="fas fa-university"></i> <strong>Bank Name:</strong>
                            {{ $employee->bank_name }}</p>
                        <p class="card-text"><i class="fas fa-credit-card"></i> <strong>Bank Account Number:</strong>
                            {{ $employee->bank_account_number }}</p>
                        <p class="card-text"><i class="fas fa-barcode"></i> <strong>IFSC Code:</strong>
                            {{ $employee->ifsc_code }}</p>
                        <a href="{{ route('employees.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                            Back to Account List</a>
                    </div>
                </div>
            </div>x
        </div>
    </div>
@endsection
