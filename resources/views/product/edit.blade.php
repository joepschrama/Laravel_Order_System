@extends('layouts.template')

@section('content')
<div>
  <div>
    Edit Product
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
      <form class="form" method="post" action="{{ route('product.update', $product) }}">
        <div class="form__container">
          @method('PATCH')
          @csrf
            <div class="form__container-item">
              <label for="name">Product name:</label>
              <input class="form__input" type="text" name="name" value={{ $product->name }} />
            </div>
            <div class="form__container-item">
              <label for="price">Product price:</label>
              <input class="form__input" type="text" name="price" value={{ $product->price }} />
            </div>
            <div class="form__container-item">
              <label for="description">Product description:</label>
              <textarea class="form__input" type="text" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="form__container-item">
              <label for="ingredients">Product ingredients:</label>
              <textarea class="form__input" type="text" name="ingredients">{{ $product->ingredients }}</textarea>
            </div>
            <div class="form__container-item">
              <label for="category">Product category:</label>
              <select class="form__input" name="category[]" multiple="multiple">
                  <option value={{$product->category_id}} selected>{{ $product->category->name }}</option>
                  @foreach($categories as $category)
                    @if($category->id != $product->category_id)
                      <option value={{$category->id}}>{{ $category->name }}</option>
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
</script>
@endsection