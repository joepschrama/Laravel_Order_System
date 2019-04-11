@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Order overview</h1>
  <table class="table">
    <thead>
        <tr class="table__header">
          <td class="table__header-item">ID</td>
          <td class="table__header-item">Order served</td>
          <td class="table__header-item">Order time</td>
          <td class="table__header-item">Order products</td>
          <td class="table__header-item">Order table</td>
          <td class="table__header-item">Order done</td>
          <td class="table__header-item" colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        {{-- @if (Auth::User()->hasRole('admin'))
        @endif --}}
        <tr class="table__row">
            <td class="table__row-item">{{$order->id}}</td>
            <td class="table__row-item">@if($order->served)True @else False @endif</td>
            <td class="table__row-item">{{$order->time}}</td>
            <td class="table__row-item">
              @foreach ($order->products as $product)
              {{$product->name}}
              @endforeach
            </td>
            <td class="table__row-item">{{$order->table->table_nr}}</td>
            <td class="table__row-item">@if($order->done)True @else False @endif</td></td>
            <td class="table__row-item actions">
              <a class="btn btn--small btn--green btn--edit" href="{{ route('order.edit',$order->id)}}"><i class="icon fas fa-edit"></i></a>
              <form action="{{ route('order.destroy', $order->id)}}" class="table__form" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>
              </form>
            </td>
        </tr>
        
        @endforeach
    </tbody>
  </table>
  <a class="btn btn--green" href="{{ route('order.create')}}">Add order <i class="fas fa-plus"></i></a>
<div>
@endsection