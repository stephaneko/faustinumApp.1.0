<!DOCTYPE html>
<html>
<head>
    <title>Paiements</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Paiements</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Nouveau paiement</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Motif</th>
                <th>depositaire</th>
                <th>Montant</th>
                <th>Année comptable</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="PaiementForm" name="PaiementForm" class="form-horizontal">
                   <input type="hidden" name="paiement_id" id="paiement_id">


                      <div class="form-group">
                        <label class="col-sm-2 control-label">Montant</label>
                        <div class="col-sm-12">
                            <input type="number" id="montant" name="montant" required="" placeholder="Enterle  montant" class="form-control"/>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="motif" class="col-sm-2 control-label">Motif</label>
                        <div class="col-sm-12">
                            <select id="motif" name="motif" class="selectpicker">
                            <option>Contribution annuelle</option>
                            <option>Contribution des menbres</option>
                            <option>Oeuvre de miséricorde en faveur des defunts</option>
                            <option>Oeuvre de miséricorde en faveur des Prêtres</option>
                            <option>Autre Oeuvre de miséricorde </option>
                            <option>Déces</option>
                            <option>Fête de la Miséricorde</option>
                            <option>Fête de sainte faustine</option>
                            <option>Pélérinage</option>
                            <option>Retraite spirituelle</option>
                            <option>Mains levés</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dépositaire</label>
                        <div class="col-sm-12">
                           <select id="deposit" name="deposit" class="selectpicker">
                            <option value='0'>--Choisiser l'apôtre --</option>
                          @foreach($apotres as $apotre)
                         <option value='{{ $apotre->id }}'>{{ $apotre->apotre_name.' de '.$apotre->apotre_paroisse }}</option>
                          @endforeach
                           </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">date de Paiement</label>
                        <div class="col-sm-12">
                            <input type="date" id="datePaie" name="datePaie"  class="form-control" input/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Année comptable</label>
                        <div class="col-sm-12">
                            <input type="month" id="datePaie" name="datePaie" required="" placeholder="Enterle  montant" class="form-control" input/>
                        </div>
                    </div>


                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">
  $(function ()
         $('#motif').selectpicker('render');
         $('#deposit').selectpicker('render');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajaxproducts.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'montant', name: 'montant'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#paiement_id').val('');
        $('#PaiementForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editProduct', function () {
      var paiement_id = $(this).data('id');
      $.get("{{ route('ajaxproducts.index') }}" +'/' + paiement_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#paiement_id').val(data.id);
          $('#name').val(data.name);
          $('#montant').val(data.montant);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#PaiementForm').serialize(),
          url: "{{ route('ajaxproducts.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#PaiementForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteProduct', function () {

        var paiement_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('ajaxproducts.store') }}"+'/'+paiement_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

  });
</script>
</html>
