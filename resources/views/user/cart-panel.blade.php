<x-app-layout>
    <div class="container">
        <h1>Your Cart</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price (Per Unit)</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control d-inline w-auto">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <form action="{{ route('user.cart.remove', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td>${{ $orderItems->sum('price') }}</td>
                        <td>
                            <form action="{{ route('user.cart.place-order') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Place Order</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>

    </div>
</x-app-layout>
