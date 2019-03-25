@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Products overview</h1>
  <table class="table">
    <thead>
        <tr class="table__header">
          <td class="table__header-item">ID</td>
          <td class="table__header-item">Product name</td>
          <td class="table__header-item">Product price</td>
          <td class="table__header-item">Product category</td>
          <td class="table__header-item" colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="table__row">
            <td class="table__row-item">{{$product->id}}</td>
            <td class="table__row-item">{{$product->name}}</td>
            <td class="table__row-item">€{{$product->price}}</td>
            <td class="table__row-item">{{ $product->category->name }}</td>
            <td class="table__row-item actions">
              <a class="btn btn--small btn--green btn--edit" href="{{ route('product.edit',$product->id)}}"><i class="icon fas fa-edit"></i></a>
              <form action="{{ route('product.destroy', $product->id)}}" class="table__form" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>
              </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a class="btn btn--green" href="{{ route('product.create')}}">Add user <i class="fas fa-plus"></i></a>
<div>
@endsection