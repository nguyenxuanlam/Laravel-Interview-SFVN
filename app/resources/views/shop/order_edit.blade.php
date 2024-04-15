@extends('dashboard.dashboard')

@section('content')

    <form method="POST" action="/order/{{ $order->id}}">
        @csrf
        @method('PUT')
        <button type="button" class="btn btn-primary add-more">Add More</button>
        <input type="text" name="customer_name" class="form-control" placeholder="customer_name" aria-label="customer_name" value="{{$order->customer_name}}">
        @if ($errors->has('customer_name')))
        <span class="text-danger">{{ $errors->first('customer_name') }}</span>
        @endif
        <div id="parent">
            @foreach($order->orderItem as $item)
                <div class="input-group mb-3 element">
                    <label>
                        <select class="form-control" name="item_id[]">
                            @foreach ($items as  $value)
                                <option  {{($item->item->id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}" >{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    @if ($errors->has('customer_name')))
                    <span class="text-danger">{{ $errors->first('item_id') }}</span>
                    @endif
                    <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" aria-label="Quantity" value="{{$item->quantity}}">
                    @if ($errors->has('quantity')))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                    @endif
                    <button type="button" class="btn btn-success" id="remove">Remove</button>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
