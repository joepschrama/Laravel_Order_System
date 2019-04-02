@extends('layouts.template')

@section('content')
<div>
  <div>
    Add Product
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
      <form class="form" method="post" action="{{ route('product.store') }}">
          <div class="form__container">
            @csrf
            <div class="form__container-item">
              <label for="name">Product name:</label>
              <input class="form__input" type="text" name="name"/>
            </div>
            <div class="form__container-item">
              <label for="price">Product price:</label>
              <input class="form__input" type="text" name="price"/>
            </div>
            <div class="form__container-item">
              <label for="description">Product description:</label>
              <textarea class="form__input" type="text" name="description"></textarea>
            </div>
            <div class="form__container-item">
              <label for="ingredients">Product ingredients:</label>
              <textarea class="form__input" type="text" name="ingredients"/></textarea>
            </div>
            <div class="form__container-item">
                <label for="category">Product category:</label>
                <select name="category" multiple="multiple">
                    @foreach($categories as $category)
                        <option value={{$category->id}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <button class="btn btn--green" type="submit">Add</button>
      </form>
  </div>
</div>
<script>

</script>
@endsection