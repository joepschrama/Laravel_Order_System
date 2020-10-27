@extends('layouts.template')

@section('content')
<div>
  <div>
    Add User
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
      <form method="post" action="{{ route('user.store') }}">
          <div>
              @csrf
              <div class="form__container-item">
                <label for="name">User Name:</label>
                <input class="form__input"type="text" name="name"/>
              </div>
              <div class="form__container-item">
                <label for="email">User Email:</label>
                <input class="form__input"type="text" name="email"/>
              </div>
              <div class="form__container-item">
                <label for="password">User Password:</label>
                <input class="form__input"type="password" name="password"/>
              </div>
              <div class="form__container-item">
                <label for="roles">User Role:</label>
                <select class="form__input" name="roles">
                    @foreach($roles as $role)
                      <option value={{$role->id}}>{{ $role->name }}</option>
                    @endforeach
                </select>
              </div>
          </div>
          <button class="btn btn--green" type="submit">Add</button>
      </form>
  </div>
</div>
@endsection