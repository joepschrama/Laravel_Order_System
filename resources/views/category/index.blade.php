@extends('layouts.template')

@section('content')
<div>
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
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
            <td class="table__row-item"><a class="btn btn--small" href="{{ route('category.edit',$category->id)}}">Edit</a></td>
            <td class="table__row-item">
                <form action="{{ route('category.destroy', $category->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{ route('category.create')}}">Create</a>
<div>
@endsection