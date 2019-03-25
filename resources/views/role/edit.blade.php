@extends('layouts.template')

@section('content')
<div>
  <div>
    Edit Role
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
      <form class="form" method="post" action="{{ route('role.update', $role) }}">
        <div class="form__container">
          @method('PATCH')
          @csrf
            <div class="form__container-item">
              <label for="name">Role name:</label>
              <input class="form__input" type="text" name="name" value={{ $role->name }} />
            </div>
        </div>
        <button class="btn btn--green" type="submit">Update</button>
    </form>
  </div>
</div>
<script>
</script>
@endsection