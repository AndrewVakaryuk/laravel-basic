@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="card-group">
                        @foreach($images as $multi)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{ asset($multi->image) }}" alt="#">
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multi image
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="image">Brand Image</label>
                                    <input type="file" name="image[]" class="form-control" id="image" aria-describedby="emailHelp" multiple="">

                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <button type="submit" class="btn btn-primary">Add Images                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

