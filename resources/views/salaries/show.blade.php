@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Salary Details</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <tr>
                <th>Amount</th>
                <td>Rs:{{ $salary->amount }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$salary->email}}</td>
            </tr>
            <tr>
                <th>Payment Date</th>
                <td>{{ $salary->payment_date->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $salary->remarks }}</td>
            </tr>
        </table>
    </div>
@endsection
