@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Users overview</h1>
  <table class="table">
    <thead>
        <tr class="table__header">
          <td class="table__header-item">ID</td>
          <td class="table__header-item">User name</td>
          <td class="table__header-item">User email</td>
          <td class="table__header-item">User role</td>
          <td class="table__header-item" colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="table__row">
            <td class="table__row-item">{{$user->id}}</td>
            <td class="table__row-item">{{$user->name}}</td>
            <td class="table__row-item">{{$user->email}}</td>
            <td class="table__row-item">{{$user->roles[0]->name}}</td>
            <td class="table__row-item actions">
              <a class="btn btn--small btn--green btn--edit" href="{{ route('user.edit',$user->id)}}"><i class="icon fas fa-edit"></i></a>
              <form action="{{ route('user.destroy', $user->id)}}" class="table__form" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>
              </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a class="btn btn--green" href="{{ route('user.create')}}">Create</a>
<div>
@endsection