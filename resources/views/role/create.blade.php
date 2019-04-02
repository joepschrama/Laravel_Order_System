@extends('layouts.template')

@section('content')
<div>
  <div>
    Add Role
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
      <form method="post" action="{{ route('role.store') }}">
          <div>
              @csrf
              <label for="name">Role Name:</label>
              <input class="form__input" type="text" name="name"/>
          </div>
          <button class="btn btn--green" type="submit">Add</button>
      </form>
  </div>
</div>
@endsection