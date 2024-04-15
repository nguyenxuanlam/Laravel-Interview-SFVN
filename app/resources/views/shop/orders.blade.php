@extends('dashboard.dashboard')

@section('content')

    <div class="row justify-content-center mt-5">
        @foreach($orders as $order)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td colspan="2">Customer</td>
                    <th scope="row">{{$order->customer_name}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Category</th>
                    <th scope="col">Fruit</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                </tr>
                @php
                    $total = 0;
                @endphp
                @foreach($order->orderItem as $orderItem)
                    @php
                        $total += $orderItem->item->price * $orderItem->quantity;
                    @endphp
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$orderItem->item->category->name}}</td>
                        <td>{{$orderItem->item->name}}</td>
                        <td>{{$orderItem->item->unit}}</td>
                        <td>{{$orderItem->item->price }}</td>
                        <td>{{$orderItem->quantity}}</td>
                        <td>{{$orderItem->item->price * $orderItem->quantity }}</td>
                        <td></td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td>{{$total}}</td>
                    <td>
                        <form action="/order/{{ $order->id }}/edit">
                            <div class="d-inline">
                                <button type="submit" class="btn btn-success btn-sm">Edit</button>
                            </div>
                        </form>
                        <form action="/order/{{ $order->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        @endforeach
    </div>

@endsection
