@extends('layouts.template')

@section('content')
<div>
  <div>
    Add Order
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
      <form method="post" action="{{ route('order.store') }}">
          <div>
              @csrf
              <div class="form__container-item">
                <label for="name">Order products:</label>
                <input class="products_input" type="hidden" name="products[]">
                @foreach($products as $product)
                  @if($product->category->name == 'Dranken')
                    <img value={{$product->id}} class="product__option" src="https://www.bbqenzo.nl/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/d/r/drank-alcohol-vrij-bier.jpg" width="200">
                  @else
                    <img value={{$product->id}} class="product__option" src="https://www.okokorecepten.nl/i/recepten/kookboeken/2010/lekker-licht/geroosterde-tomatensoep-500.jpg" width="200">
                  @endif
                @endforeach

                {{-- <select class="form__input products_input" name="products[]" multiple>
                  @foreach($products as $product)
                    <option value={{$product->id}}>{{ $product->name }}</option>
                  @endforeach
                </select> --}}
              </div>
              <div class="form__container-item">
                <label for="name">Order table:</label>
                <select class="form__input" name="table_nr">
                  @foreach($tables as $table)
                        <option value={{$table->id}}>{{ $table->table_nr }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <button class="btn btn--green" type="submit">Add</button>
      </form>
  </div>
</div>
<script>
let productOption = document.getElementsByClassName('product__option');
let selectedProducts = [];

let productsInput = document.querySelector('.products_input');

for( let i = 0; i < productOption.length; i++) {
  productOption[i].onclick = function() {addProduct(productOption[i].getAttribute('value'))};
}

function addProduct(product) {
  selectedProducts.push(product);
  productsInput.value = selectedProducts;
  console.log(selectedProducts);
}
</script>
@endsection