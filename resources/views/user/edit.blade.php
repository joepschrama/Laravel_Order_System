@extends('layouts.template')

@section('content')
<div>
  <div>
    Edit User
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
      <form class="form" method="post" action="{{ route('user.update', $user->id) }}">
        @method('PATCH')
        @csrf
        <div class="form__container-item">
          <label for="name">user Name:</label>
          <input class="form__input" type="text" name="name" value={{ $user->name }} />
        </div>
        <div class="form__container-item">
            <label for="email">user Email:</label>
            <input class="form__input" type="text" name="email" value={{ $user->email }} />
        </div>
        <div class="form__container-item">
            <label for="password">user Password:</label>
            <input class="form__input" type="password" name="password" />
        </div>
        <div class="form__container-item">
          <label for="roles">User Role:</label>
          <select name="roles">
            <option value={{$user->roles[0]->id}}>{{ $user->roles[0]->name }}</option>
            @foreach($roles as $role)
              @if($role->id != $user->roles[0]->id)
                <option value={{$role->id}}>{{ $role->name }}</option>
              @endif
            @endforeach
          </select>
        </div>
        <button class="btn btn--green" class="btn btn--green" type="submit">Update</button>
      </form>
  </div>
</div>
@endsection