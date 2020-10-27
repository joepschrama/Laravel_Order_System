@extends('layouts.template')

@section('content')
<div>
  <div>
    Edit Order
  </div>
  <div>
    @if ($errors->any())
      <div>
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form class="form" method="post" action="{{ route('order.update', $order) }}">
        <div class="form__container">
          @method('PATCH')
          @csrf
            <div class="form__container-item">
              <label for="name">Order served:</label>
              <select class="form__input" name="served">
                @if($order->served)
                <option value={{$order->served}}>True</option>
                <option value="0">False</option>
                @else
                <option value={{$order->served}}>False</option>
                <option value="1">True</option>
              @endif
              </select>
            </div>
            <div class="form__container-item">
              <label for="name">Order done:</label>
              <select class="form__input" name="done">
                @if($order->done)
                  <option value={{$order->done}}>True</option>
                  <option value="0">False</option>
                  @else
                  <option value={{$order->done}}>False</option>
                  <option value="1">True</option>
                @endif
              </select>
            </div>
            <div class="form__container-item">
              <label for="name">Order products:</label>
              <select class="form__input products" name="products[]" multiple>
                @foreach($products as $product)
                    @if($order->products->contains($product->id))
                    <option selected value={{$product->id}}>{{ $product->name }}</option>
                    @else
                    <option value={{$product->id}}>{{ $product->name }}</option>
                    @endif
                @endforeach
              </select>
            </div>
            <div class="form__container-item">
              <label for="name">Order table:</label>
              <select class="form__input" name="table_nr">
                @foreach($tables as $table)
                    @if($order->table->id == $table->id)
                      <option selected value={{$order->table->id}}>{{ $order->table->table_nr }}</option>
                    @else
                      <option value={{$table->id}}>{{ $table->table_nr }}</option>
                    @endif
                @endforeach
              </select>
            </div>
        </div>
        <button class="btn btn--green" type="submit">Update</button>
    </form>
  </div>
</div>
<script>
// let products = document.getElementsByClassName('products')[0];
// let productValues = [];

// setInterval(() => {
//   for(let i = 0; i < products.selectedOptions.length; i++) {
//     console.log(products.selectedOptions[i].value);
//   }
// }, 500);
</script>
@endsection