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
      <form class="form" method="post" action="{{ route('table.update', $table->id) }}">
        @method('PATCH')
        @csrf
        <div class="form__container-item">
          <label for="table_nr">Table Nr:</label>
          <input class="form__input" type="text" name="table_nr" value={{ $table->table_nr }} />
        </div>
        <div class="form__container-item">
            <label for="table_seats">Table seats:</label>
            <input class="form__input" type="text" name="table_seats" value={{ $table->amount_of_seats }} />
        </div>
        <button class="btn btn--green" class="btn btn--green" type="submit">Update</button>
      </form>
  </div>
</div>
@endsection