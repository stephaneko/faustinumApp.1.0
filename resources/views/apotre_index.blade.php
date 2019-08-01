<html  lang="en">
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apôtre</title>
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
     <h3 align="center">Menu Apôtre</h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Ajouter</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
          <tr>
         <td>ID</td>
          <td>Nom et Prénom</td>
          <td>Date de naissance</td>
          <td>Paroisse</td>
          <td>Zone</td>
          <td>Status</td>
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
            <label class="control-label col-md-4" >Noms : </label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="apotre_name"/>
            </div>
           </div>

            <div class="form-group">
            <label class="control-label col-md-4" >Prenoms : </label>
            <div class="col-md-8">
              <input type="text" class="form-control" name="apotre_surname"/>
            </div>
           </div>

             <div class="form-group">
            <label class="control-label col-md-4" >Date de naissance: </label>
            <div class="col-md-8">
              <input type="date" class="form-control" name="apotre_dateNais"/>
            </div>
           </div>

             <div class="form-group">
            <label class="control-label col-md-4" >Paroisse : </label>
            <div class="col-md-8">
               <SELECT class="form-control" name="apotre_paroisse" data-style="btn-info">
                <OPTION>saint clément
                <OPTION>saint Thaddée
                <OPTION selected>saint charles Lwanga
                <OPTION>Saint sacrement
                <OPTION>saint Thomas Apotres
                </SELECT>
            </div>
           </div>

           <div class="form-group">
                        <label for="motif" class="control-label col-md-4">Zone</label>
                        <div class="col-md-8">
                             <SELECT class="form-control" name="apotre_zone" data-style="btn-info">
                            <OPTION>Wourri 1
                            <OPTION>Wourri 2
                            <OPTION selected>Wourri 3
                            <OPTION>Wourri 4
                            <OPTION>Wourri 5
                            </SELECT>
                        </div>
                    </div>

           {{-- <div class="form-group">
            <label class="control-label col-md-4">date d'encaissement : </label>
            <div class="col-md-8">
             <input type="date" name="datePaie" id="datePaie" class="form-control" />
            </div>
           </div> --}}
           <div class="form-group">
            <label class="control-label col-md-4">status : </label>
            <div class="col-md-8">
            <SELECT class="form-control" name="apotre_status" data-style="btn-info">
                <OPTION>Volontaire
                <OPTION>Acun
                <OPTION selected>consacré
                </SELECT>
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
 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('apotre.index') }}",
  },
  columns:[
   {
    data: 'apotre_name',
    name: 'apotre_name',
    orderable: true
   },
   {
    data: 'apotre_surname',
    name: 'apotre_surname'
   },
   {
    data: 'apotre_dateNais',
    name: 'apotre_dateNais'
   },
    {
    data: 'apotre_paroisse',
    name: 'apotre_paroisse'
   },
    {
    data: 'apotre_zone',
    name: 'apotre_zone'
   },
    {
    data: 'apotre_status',
    name: 'apotre_status'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });

 $('#create_record').click(function(){
  $('.modal-title').text("Ajouter un Apôtre");
     $('#action_button').val("Valider");
     $('#action').val("Valider");
     $('#formModal').modal('show');
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Valider')
  {
   $.ajax({
    url:"{{ route('apotre.store') }}",
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
    url:"{{ route('apotre.update') }}",
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
   url:"/apotre/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#apotre_name').val(html.data.apotre_name);
     $('#apotre_surname').val(html.data.apotre_surname);
     $('#apotre_dateNais').val(html.data.apotre_dateNais);
    $('#apotre_paroisse').val(html.data.apotre_paroisse);
    $('#apotre_zone').val(html.data.apotre_zone);
    $('#apotre_status').val(html.data.apotre_status);

    // $('#store_recus').html("<img src={{ URL::to('/') }}/recuss/" + html.data.recus + " width='70' class='img-thumbnail' />");
    // $('#store_recus').append("<input type='hidden' name='hidden_recus' value='"+html.data.recus+"' />");
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Modifier un apotre");
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
   url:"apotre/destroy/"+user_id,
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
