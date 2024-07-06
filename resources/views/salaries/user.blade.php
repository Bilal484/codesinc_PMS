@extends('layouts.app')

@section('content')
    <div class=" mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary  text-white" style="padding: 5px ; margin-top: 10px;">
                        <h3>My Salaries</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Date</th>
                                    <th scope="col">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salaries as $salary)
                                    <tr>
                                        <td><b>RS:</b>{{ $salary->amount }}</td>
                                        <td>{{ $salary->payment_date }}</td>
                                        <td>{{ $salary->remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('home') }}" class="btn btn-info">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
