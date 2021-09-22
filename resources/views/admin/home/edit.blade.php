@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Abouts</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('update/homeabout/'.$homeAbout->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $homeAbout->title }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short Description</label>
                        <textarea class="form-control" name="short_description" id="exampleFormControlTextarea1" rows="3">{{$homeAbout->short_dis}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long Description</label>
                        <textarea class="form-control" name="long_description" id="exampleFormControlTextarea1" rows="3">{{ $homeAbout->long_dis }}</textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
