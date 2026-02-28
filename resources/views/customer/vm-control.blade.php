@extends('layouts.customer')

@section('title', 'Customer Control Panel')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $order->orderItems->first()->product_name }} Control Panel</h1>

    <div class="space-y-4">
        <form method="POST" action="{{ route('customer.vm.restart', $order->id) }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Restart VM
            </button>
        </form>

        <div>
            <h2 class="font-semibold mb-2">VM Processes</h2>
            <pre>{{ $processes ?? 'No process data available' }}</pre>
        </div>

        <div>
            <h2 class="font-semibold mb-2">Scale VM</h2>
            <form method="POST" action="{{ route('customer.vm.scale', $order->id) }}">
                @csrf
                <select name="size" class="border px-2 py-1 rounded">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
                <button type="submit" class="bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-600">Scale</button>
            </form>
        </div>
    </div>
@endsection
