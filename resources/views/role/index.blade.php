@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Roles overview</h1>
  <table class="table">
    <thead>
        <tr class="table__header">
          <td class="table__header-item">ID</td>
          <td class="table__header-item">Role name</td>
          <td class="table__header-item" colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr class="table__row">
            <td class="table__row-item">{{$role->id}}</td>
            <td class="table__row-item">{{$role->name}}</td>
            <td class="table__row-item actions">
              <a class="btn btn--small btn--green btn--edit" href="{{ route('role.edit',$role->id)}}"><i class="icon fas fa-edit"></i></a>
              <form action="{{ route('role.destroy', $role->id)}}" class="table__form" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>
              </form>
            </td>
            {{-- <td class="table__row-item">
                <form action="{{ route('role.destroy', $role->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn--small btn--red" type="submit"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td> --}}
        </tr>
        @endforeach
    </tbody>
  </table>
  <a class="btn btn--green" href="{{ route('role.create')}}">Add role <i class="fas fa-plus"></i></a>
<div>
@endsection