@extends('dashboard.dashboard')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">unit</th>
                    <th scope="col">category</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fruits as $fruit)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$fruit->name}}</td>
                        <td>{{$fruit->price}}</td>
                        <td>{{$fruit->unit}}</td>
                        <td>{{$fruit->category->name}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div></div>
        <div class="col-md-8">
            <form method="POST" action="/item" >
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="unit" id="unit" placeholder="Enter Unit">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('unit') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price">
                    @if ($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>
                        <select class="form-control" name="category_id">
                            @foreach ($fruitCategories as  $category)
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>

@endsection
