@extends('layouts.template')

@section('content')
<div>
  <div>
    Add Table
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
      <form method="post" action="{{ route('table.store') }}">
          <div>
              @csrf
              <div class="form__container-item">
                <label for="table_nr">Table Nr:</label>
                <input class="form__input"type="text" name="table_nr"/>
              </div>
              <div class="form__container-item">
                <label for="table_seats">Table Seats:</label>
                <input class="form__input"type="text" name="table_seats"/>
              </div>
          </div>
          <button class="btn btn--green" type="submit">Add</button>
      </form>
  </div>
</div>
@endsection