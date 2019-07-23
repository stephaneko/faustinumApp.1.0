@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nom et Prénom</td>
          <td>Date de naissance</td>
          <td>Paroisse</td>
          <td>Zone</td>
          <td>Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($apotres as $apotre)
        <tr>
            <td>{{$apotre->id}}</td>
            <td>{{$apotre->apotre_name.' '.$apotre->apotre_surname}}</td>
            <td>{{$apotre->apotre_dateNais}}</td>
            <td>{{$apotre->apotre_paroisse}}</td>
            <td>{{$apotre->apotre_zone}}</td>
            <td>{{$apotre->apotre_status}}</td>
            <td><a href="{{ route('apotres.edit',$apotre->id)}}" class="btn btn-primary">Modifier</a></td>
            <td>
                <form action="{{ route('apotres.destroy', $apotre->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
