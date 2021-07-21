@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-4">Product list</h2>
    <div class="justify-content-center pl-md-5 pr-md-5">
        @if($products->isEmpty())
            <div class="d-flex text-center justify-content-center">
                <h2 class="mt-5">No products</h2>
            </div>
        @else
            <table class="table table-sortable">
                <thead>
                <tr>
                    <th class="mobile-hide" scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th class="mobile-hide" scope="col">Price</th>

                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="hover-zoom">
                        <td class="mobile-hide">{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->productStatus->status}}</td>
                        <td class="mobile-hide">{{number_format($product->price / 100, 2)}} Eur</td>
                        <td class="d-flex mobile-hide">
                            <form action="{{route('product.edit', $product)}}">
                                <button type="submit" class="card-link btn btn-info btn-sm m-1"
                                >Details
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="d-flex justify-content-center">
{{--            {!! $product->links() !!}--}}
        </div>
@endsection
