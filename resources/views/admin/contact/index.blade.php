@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-12 mb-2">
                    <h2 class="d-inline">Contact Page</h2>
                    <a href="{{ route('add.contact') }}" class="float-right">
                        <button class="btn btn-info">Add Contact</button>
                    </a>
                </div>

                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-header">
                            All Contact Data
                        </div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL No</th>
                                <th scope="col" width="15%">Contact Address</th>
                                <th scope="col" width="15%">Contact email</th>
                                <th scope="col" width="35%">Contact phone</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($contacts as $con)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $con->address }}</td>
                                    <td>{{ $con->email }}</td>
                                    <td>{{ $con->phone }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info">Edit</a>
                                        <a href="#" onclick="return confirm('Впевнений?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

