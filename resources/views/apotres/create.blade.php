@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Ajout d'un apotre
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('apotres.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Noms:</label>
              <input type="text" class="form-control" name="apotre_name"/>
          </div>
          <div class="form-group">
              <label for="surname">Prenoms :</label>
              <input type="text" class="form-control" name="apotre_surname"/>
          </div>
          <div class="form-group">
              <label for="dateNais">Date de naissance:</label>
              <input type="date" class="form-control" name="apotre_dateNais"/>
          </div>
          <div class="form-group">
              <label for="paroisse">Paroisse:</label>
              <SELECT class="form-control" name="apotre_paroisse" size="1">
                <OPTION>saint clément
                <OPTION>saint Thaddée
                <OPTION selected>saint charles Lwanga
                <OPTION>Saint sacrement
                <OPTION>saint Thomas Apotres
                </SELECT>
          </div>
             <div class="form-group">
              <label for="zone">Paroisse:</label>
              <SELECT class="form-control" name="apotre_zone" size="1">
                <OPTION>Wourri 1
                <OPTION>Wourri 2
                <OPTION selected>Wourri 3
                <OPTION>Wourri 4
                <OPTION>Wourri 5
                </SELECT>
          </div>
           <div class="form-group">
              <label for="status">Paroisse:</label>
              <SELECT class="form-control" name="apotre_status" size="1">
                <OPTION>Volontaire
                <OPTION>Acun
                <OPTION selected>consacré
                </SELECT>
          </div>
          <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>
  </div>
</div>
@endsection
