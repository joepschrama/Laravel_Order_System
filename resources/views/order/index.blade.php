@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Order overzicht</h1>
{{--  <table class="table">--}}
{{--    <thead>--}}
{{--        <tr class="table__header">--}}
{{--          <td class="table__header-item">Order time</td>--}}
{{--          <td class="table__header-item">Order products</td>--}}
{{--          <td class="table__header-item">Order table</td>--}}
{{--          <td class="table__header-item">Order done</td>--}}
{{--          <td class="table__header-item" colspan="2">Action</td>--}}
{{--        </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--        @foreach($orders as $key => $order)--}}
{{--        <tr class="table__row">--}}
{{--            <td class="table__row-item">{{$order->time}}</td>--}}
{{--            <td class="table__row-item">--}}
{{--                @foreach($allProducts[$key] as $pr)--}}
{{--                    {{ $pr  }} <input type="checkbox">--}}
{{--                @endforeach--}}
{{--            </td>--}}
{{--            <td class="table__row-item">{{$order->table->table_nr}}</td>--}}
{{--            <td class="table__row-item">@if($order->done)True @else False @endif</td></td>--}}
{{--            <td class="table__row-item actions">--}}
{{--              <a class="btn btn--small btn--green btn--edit" href="{{ route('order.edit',$order->id)}}"><i class="icon fas fa-edit"></i></a>--}}
{{--              <form action="{{ route('order.destroy', $order->id)}}" class="table__form" method="post">--}}
{{--                @csrf--}}
{{--                @method('DELETE')--}}
{{--                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>--}}
{{--              </form>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        @endforeach--}}
{{--    </tbody>--}}
{{--  </table>--}}
    @foreach($orders as $key => $order)
      @if(!$order->done_kok && Auth::user()->roles[0]->name == 'kok' || !$order->done_bar && Auth::user()->roles[0]->name == 'bar' || Auth::user()->roles[0]->name == 'admin' )
      <div class="order__container">
          <div class="order__table">Tafel {{ $order->table->table_nr }}</div>
          <div class="order__field">
              <div class="order__products">
                  @foreach($allProducts[$key] as $productIndex => $pr)
                      <div class="order__product">
                          <div class="order__product-name">{{ $pr }}</div>
                          <div class="order__product-amount"> {{ $productCounts[$key][$productIndex]. 'X' }} </div>
                      </div>
                  @endforeach
              </div>
              <div class="order__served">
                  <h3>Klaar om te serveren?</h3>
                  <button class="order__served-button order__notReady" order_id={{ $order->id }} role={{ Auth::user()->roles[0]->name }}>Klaar</button>
              </div>
          </div>
      </div>
      @endif
    @endforeach
  <a class="btn btn--green" href="{{ route('order.create')}}">Add order <i class="fas fa-plus"></i></a>
<div>
@endsection
