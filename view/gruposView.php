<?php include('template/header.php'); ?>
<?php include('template/sidebar.php'); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Grupos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Grupos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Listado de Grupos</h3>

          <div class="card-tools">

			  
			 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevoGrupo">
  			Nuevo Grupo
			</button> 
          </div>
        </div>
		  
		  
<div class="modal fade" id="EditarGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  
        <form action="<?php echo $helper->url("grupos","editarGrupo"); ?>" method="post" class="col-lg-12" id="EditarGrupoForm">
            <div class="messagesForm"></div>
            <hr/>
			<input type="hidden" name="id" id="IDE" class="form-control"/>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Nombre</label>
				  <input type="text" name="nombre" id="NombreE" class="form-control" requiered/>
                </div>
            <input type="submit" value="enviar" class="btn btn-success"/>
        </form>		  
		  
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>  
		  
<div class="modal fade" id="NuevoGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  
        <form action="<?php echo $helper->url("grupos","crear"); ?>" method="post" class="col-lg-12" id="CrearGrupoForm">
            <div class="messagesForm"></div>
            <hr/>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Nombre</label>
				  <input type="text" name="nombre" id="nombre" class="form-control" requiered/>
                </div>
			
            <input type="submit" value="enviar" class="btn btn-success"/>
        </form>		  
		  
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>  
		  
		  
		
		<div class="row">
        <div class="col-lg-12">
            
            <hr/>
        </div>
		</div>
		  
			<div class="table-responsive">
              <table id="manageTable" class="table table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
		  
		

        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Data Tables-->




<?php include('template/footer.php'); ?>
<script src="<?php echo $helper->asset_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
	
 $(".grupos").addClass('active');

  // initialize the datatable 
  manageTable = jQuery('#manageTable').DataTable({
    'ajax':'<?php echo $helper->url("grupos","listado"); ?>',
    'order': [],
	'searching': false,
	"language":{
          "lengthMenu": "Mostrar _MENU_ Registros por página",
          "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrada de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search": "Buscar:",
            "zeroRecords":    "No se encontraron registros coincidentes",
            "paginate": {
              "next":       "Siguiente",
              "previous":   "Anterior"
            },         
          },

  });
	
});	
	
	$("#CrearGrupoForm").unbind('submit').bind('submit', function(e) {
	 e.preventDefault();
	var form = $(this);
	$.ajax({
          url: form.attr('action'),
          type: 'post',
			data:{
				nombre: $('#nombre').val()
			},
          dataType: 'json',
          success:function(response) {
            if(response.success=== true) {
			$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				manageTable.ajax.reload(null, false); 
				$('#NuevoGrupo').modal('hide');
				
            } else {
                  $("#CrearGrupoForm .messagesForm").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				
             
            }
          }
        }); 		
		
  
	
});

	
	function EditarGrupo(id){
        $.ajax({
          url: '<?php echo $helper->url("grupos","getGrupo"); ?>',
          type: 'post',
			data:{
				id: id
			},
          dataType: 'json',
          success:function(response) {
            if(response !== null) {
			$("#IDE").val(response.id);	
			$("#NombreE").val(response.nombre)
            } else {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>No pudimos cargar los datos del cliente</div>');
             
            }
          }
        }); 		
		$('#EditarGrupo').modal('show');
	}
$("#EditarGrupoForm").unbind('submit').bind('submit', function(e) {
	 e.preventDefault();
	var form = $(this);
	$.ajax({
          url: form.attr('action'),
          type: 'post',
			data:{
				id: $('#IDE').val(),
				nombre: $('#NombreE').val()
			},
          dataType: 'json',
          success:function(response) {
            if(response.success=== true) {
			$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				manageTable.ajax.reload(null, false); 
				$('#EditarGrupo').modal('hide');
				
            } else {
                  $("#EditarGrupoForm .messagesForm").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				
             
            }
          }
        }); 		
		
  
	
});
	
	
	
	function removeGrupo(id){
		var txt;
		var r = confirm("Esta seguro que quiere eliminar el registro?");
		if (r == true) {
			$.ajax({
			  url: '<?php echo $helper->url("grupos","borrar"); ?>',
			  type: 'GET',
				data:{
					id: id
				},
			  dataType: 'json',
			  success:function(response) {

				manageTable.ajax.reload(null, false); 

				if(response.success === true) {
				  $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					'<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
				  '</div>');

				} else {

					 $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
					'</div>');

				}
			  }
			}); 		
		} 
	}


</script>
