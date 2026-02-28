@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Microsoft Products</h1>
    
    @if($products->isEmpty())
    <div class="text-center py-12">
        <p class="text-gray-600 text-lg">No products available at the moment.</p>
        <p class="text-gray-500 mt-2">Please check back later or contact support.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transitionbg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition border-4 border-mtn-yellow">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            
            <div class="mb-4">
                <span class="text-3xl font-bold ">
                    {{ number_format($product->selling_price, 0) }}
                </span>
                <span class="text-sm font-bold">{{ $product->currency }}</span>
                <span class="text-sm  font-bold">/ {{ $product->billing_cycle }}</span>
            </div>
            
            <a href="{{ route('products.show', $product->id) }}" 
               class="block w-full btn-mtn text-center py-3 rounded-lg font-bold">
                View Details
            </a>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
