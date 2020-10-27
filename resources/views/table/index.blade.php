@extends('layouts.template')

@section('content')
<div class="section">
  @if(session()->get('success'))
    <div>
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <h1 class="section__title">Tables overview</h1>
  <table class="table">
    <thead>
        <tr class="table__header">
          <td class="table__header-item">ID</td>
          <td class="table__header-item">Table Nr</td>
          <td class="table__header-item">Table Seats</td>
          <td class="table__header-item" colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tables as $table)
        <tr class="table__row">
            <td class="table__row-item">{{$table->id}}</td>
            <td class="table__row-item">{{$table->table_nr}}</td>
            <td class="table__row-item">{{$table->amount_of_seats}}</td>
            <td class="table__row-item actions">
              <a class="btn btn--small btn--green btn--edit" href="{{ route('table.edit',$table->id)}}"><i class="icon fas fa-edit"></i></a>
              <form action="{{ route('table.destroy', $table->id)}}" class="table__form" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn--small btn--red" type="submit"><i class="icon fas fa-trash-alt"></i></button>
              </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a class="btn btn--green" href="{{ route('table.create')}}">Add table <i class="fas fa-plus"></i></a>
<div>
@endsection