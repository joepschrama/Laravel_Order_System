@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Categories overview</h1>
  <table class="table">
    <thead>
        <tr class="table__header">
          <td class="table__header-item">ID</td>
          <td class="table__header-item">Category name</td>
          <td class="table__header-item" colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr class="table__row">
            <td class="table__row-item">{{$category->id}}</td>
            <td class="table__row-item">{{$category->name}}</td>
            <td class="table__row-item actions">
              <a class="btn btn--small btn--green btn--edit" href="{{ route('category.edit',$category->id)}}"><i class="icon fas fa-edit"></i></a>
              <form action="{{ route('category.destroy', $category->id)}}" class="table__form" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>
              </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a class="btn btn--small btn--green" href="{{ route('category.create')}}">Add user <i class="fas fa-plus"></i></a>
<div>
@endsection