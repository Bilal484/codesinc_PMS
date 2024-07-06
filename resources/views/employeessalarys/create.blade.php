@extends('layouts.app')

@section('content')
    <style>
        .error {
            color: red;
        }
    </style>
    <div class="row mx-auto">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 ">
            <h3 class="my-4">Create Employee Account Details:</h3>
            <a href="{{ route('employees.index') }}"><Button class="btn btn-primary">Go Back</Button></a>
            <form class="mt-5" action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
              
                <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary') }}">
                    @error('salary')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bank_name">Bank Name:</label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                        value="{{ old('bank_name') }}">
                    @error('bank_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bank_account_number">Bank Account Number:</label>
                    <input type="text" class="form-control" id="bank_account_number" name="bank_account_number"
                        value="{{ old('bank_account_number') }}">
                    @error('bank_account_number')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ifsc_code">IFSC Code:</label>
                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code"
                        value="{{ old('ifsc_code') }}">
                    @error('ifsc_code')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
