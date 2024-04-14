@extends('dashboard.dashboard')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fruitCategories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$category->name}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="col-md-8">
            <form method="POST" action="/category" >
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

@endsection
