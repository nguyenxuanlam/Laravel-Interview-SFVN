@extends('dashboard.dashboard')

@section('content')

    <form method="POST" action="/order">
        @csrf
        <button type="button" class="btn btn-primary add-more">Add More</button>
        <input type="text" name="customer_name" required class="form-control" placeholder="customer_name" aria-label="customer_name">
        @if ($errors->has('customer_name')))
        <span class="text-danger">{{ $errors->first('customer_name') }}</span>
        @endif
        <div id="parent">
            <div class="input-group mb-3 element">
                <label>
                    <select class="form-control" name="item_id[]">
                        @foreach ($items as  $value)
                            <option value="{{ $value->id }}" >{{ $value->name }}</option>
                        @endforeach
                    </select>
                </label>
                <input type="number" name="quantity[]" required class="form-control" placeholder="Quantity" aria-label="Quantity">
                <button type="button" class="btn btn-success" id="remove">Remove</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
