@extends('layouts.template')

@section('content')
<div>
  <div>
    Edit Category
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
      <form method="post" action="{{ route('category.update', $category->id) }}">
        @method('PATCH')
        @csrf
        <div>
          <label for="name">Category Name:</label>
          <input type="text" name="name" value={{ $category->name }} />
        </div>
        <button type="submit">Update</button>
      </form>
  </div>
</div>
@endsection