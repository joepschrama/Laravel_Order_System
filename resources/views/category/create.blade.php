@extends('layouts.template')

@section('content')
<div>
  <div>
    Add Share
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
      <form method="post" action="{{ route('category.store') }}">
          <div>
              @csrf
              <label for="name">Category Name:</label>
              <input type="text" name="name"/>
          </div>
          <button type="submit">Add</button>
      </form>
  </div>
</div>
@endsection