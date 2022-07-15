@extends('layouts.app')

@section('content')
    <table class="content-table">
        <thead>
        <tr>
            <th>Артикул</th>
            <th>Название</th>
            <th>Статус</th>
            <th>Атрибуты</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr class="content-row" data-action="view-product" data-id="{{$product->id}}">
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

    <button class="btn btn-blue add-product" data-action="create-product">
        Добавить
    </button>

    @include('products.popups')

@endsection()
