<html  lang="en">
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paiement</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">
     <br /gitgit>
     <h3 align="center">Menu Paiement</h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Ajouter</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="paiementTable">
           <thead>
            <tr>
                <th width="10%">date paiement</th>
                <th width="35%">Montant</th>
                <th width="35%">Objet</th>
                <th width="30%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ajouter</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Montant : </label>
            <div class="col-md-8">
             <input type="text" name="montant" id="montant" class="form-control" />
            </div>
           </div>

           <div class="form-group">
                        <label for="motif" class="control-label col-md-4">Motif</label>
                        <div class="col-md-8">
                            <select id="objet" name="objet" class="form-control" data-style="btn-info">
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

           {{-- <div class="form-group">
            <label class="control-label col-md-4">date d'encaissement : </label>
            <div class="col-md-8">
             <input type="date" name="datePaie" id="datePaie" class="form-control" />
            </div>
           </div> --}}
           <div class="form-group">
            <label class="control-label col-md-4">Date d'encaissement : </label>
            <div class="col-md-8">
             <input type="date" name="datePaie" id="datePaie" class="form-control"   />
             <span id="datePaie"></span>
            </div>
           </div>
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Valider" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Etes vous sûr de vouloir supprimer cet enregistrement?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annaler</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
 $('#paiementTable').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('ajax-crud.index') }}",
  },
  columns:[
   {
    data: 'datePaie',
    name: 'datePaie',
    orderable: true
   },
   {
    data: 'montant',
    name: 'montant'
   },
   {
    data: 'objet',
    name: 'objet'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ],
"oTableTools": {
"aButtons": [
"copy",
"print",
{
"sExtends": "collection",
"sButtonText": "Save",
"aButtons": [ "csv", "xls", "pdf" ]
}
]
}
});

 $('#create_record').click(function(){
  $('.modal-title').text("Ajouter un paiement");
     $('#action_button').val("Valider");
     $('#action').val("Valider");
     $('#formModal').modal('show');
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Valider')
  {
   $.ajax({
    url:"{{ route('ajax-crud.store') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
      $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('ajax-crud.update') }}",
    method:"POST",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
    //   $('#store_recus').html('');
      $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   });
  }
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"/ajax-crud/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#montant').val(html.data.montant);
    $('#objet').val(html.data.objet);
     $('#datePaie').val(html.data.objet);
    // $('#store_recus').html("<img src={{ URL::to('/') }}/recuss/" + html.data.recus + " width='70' class='img-thumbnail' />");
    // $('#store_recus').append("<input type='hidden' name='hidden_recus' value='"+html.data.recus+"' />");
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Modiffier un paiement");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });

 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"ajax-crud/destroy/"+user_id,
   beforeSend:function(){
    $('#ok_button').text('Suppression...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();
    }, 2000);
   }
  })
 });

});
</script>
