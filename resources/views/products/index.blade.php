@extends('layouts.app')

@section('content')
    <table class="content-table">
        <thead>
        <tr>
            <td>Артикул</td>
            <td>Название</td>
            <td>Статус</td>
            <td>Атрибуты</td>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr class="row" data-action="view-product" data-id="{{$product->id}}">
                <td>{{$product->article}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->status_name}}</td>
                <td>
                    @forelse($product->data as $attribute => $value)
                        <p>{{$attribute}}: {{$value}}</p>
                    @empty

                    @endforelse
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="center">Ничего нет</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <button data-action="create-product" class="btn btn-blue absolute" data-entity="product">
        Добавить
    </button>

    @include('products.popups')

@endsection()
