<?php include('template/header.php'); ?>
<?php include('template/sidebar.php'); ?>
<?php 
	$grupos=new Grupo($this->adapter);
	$allgrupos=$grupos->getAll();
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
          <h3 class="card-title">Listado de Clientes</h3>

          <div class="card-tools">

			  
			 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevoCliente">
  			Nuevo Cliente
			</button> 
          </div>
        </div>
		  
		 <div id="messages"></div> 
<div class="modal fade" id="EditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  
        <form action="<?php echo $helper->url("clientes","editarCliente"); ?>" method="post" class="col-lg-12" id="EditarClienteForm">
            <div class="messagesForm"></div>
            <hr/>
			<input type="hidden" name="id" id="IDE" class="form-control"/>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Nombre</label>
				  <input type="text" name="nombre" id="NombreE" class="form-control" requiered/>
                </div>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Apellido</label>
				  <input type="text" name="apellido" id="ApellidoE" class="form-control" requiered/>
                </div>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Email</label>
				  <input type="text" name="email" id="EmailE" class="form-control" requiered/>
                </div>
			
			<div class="form-group">
                  <label for="groups" class="bmd-label-floating">Grupos</label>
                  <select class="form-control" id="id_grupoE" name="id_grupo" style="width:100%" requiered>
                    <option value="">Seleccionar grupo</option>
					  <?php foreach($allgrupos as $grupo):?>
                    <option value="<?= $grupo->id?>"><?= $grupo->nombre?></option>
					  <?php endforeach;?>
                  </select>
                </div>
			
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Observaciones</label>
					<textarea name="observaciones" id="observacionesE" class="form-control" requiered></textarea>
				  
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
		  
<div class="modal fade" id="NuevoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  
        <form action="<?php echo $helper->url("clientes","crear"); ?>" method="post" class="col-lg-12" id="CrearClienteForm">
            <div class="messagesForm"></div>
            <hr/>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Nombre</label>
				  <input type="text" name="nombre" id="nombre" class="form-control" requiered/>
                </div>
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Apellido</label>
				  <input type="text" name="apellido" id="apellido" class="form-control" requiered/>
                </div>

                <div class="form-group">
                  <label for="groups" class="bmd-label-floating">Email</label>
				  <input type="text" name="email" id="email" class="form-control" requiered/>
                </div>

			<div class="form-group">
                  <label for="groups" class="bmd-label-floating">Grupos</label>
                  <select class="form-control" id="id_grupo" name="id_grupo" style="width:100%" requiered>
                    <option value="">Seleccionar grupo</option>
					  <?php foreach($allgrupos as $grupo):?>
                    <option value="<?= $grupo->id?>"><?= $grupo->nombre?></option>
					  <?php endforeach;?>
                  </select>
                </div>
			
                <div class="form-group">
                  <label for="groups" class="bmd-label-floating" requiered>Observaciones</label>
					<textarea name="observaciones" id="observaciones" class="form-control" required></textarea>
				  
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
        <form method="POST" action="<?=$helper->url("clientes","buscar"); ?>" id="BuscarForm" style="width: 100%">
		<div class="row">
			
				<div class="col-lg-4">
						<div class="form-group">

						  <input type="text" name="search" id="search" class="form-control" placeholder="Buscar"/>
						</div>
				</div>
				<div class="col-lg-4">
				<div class="form-group">
					  <?php 
						$grupos=new Grupo($this->adapter);
						$allgrupos=$grupos->getAll();
						?>
					  <select class="form-control" id="id_grupo_search" name="id_grupo_search" style="width:100%">
						<option value="Todos">Filtrar por Grupo</option>
						  <?php foreach($allgrupos as $grupo):?>
						<option value="<?= $grupo->id?>"><?= $grupo->nombre?></option>
						  <?php endforeach;?>

					  </select>
					</div>
				</div>
				<div class="col-lg-4">
						<div class="form-group">
					<input type="submit" value="buscar" class="btn btn-success"/>
						
						</div>
				</div>
					
		</div>
		</form>	  
		  
		  
        
		  
			<div class="table-responsive">
              <table id="manageTable" class="table table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Email</th>
                  <th>Grupo</th>
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
	 $(".clientes").addClass('active');

  // initialize the datatable 
  manageTable = jQuery('#manageTable').DataTable({
    'ajax':'<?php echo $helper->url("clientes","listado"); ?>',
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
	$("#BuscarForm").unbind('submit').bind('submit', function(e) {
	 e.preventDefault();
	var form = $(this);
	manageTable.destroy();	
	manageTable = jQuery('#manageTable').DataTable({
    'ajax':form.attr('action')+'&id_grupo_search='+$("#id_grupo_search").val()+'&search='+$("#search").val(),
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
          },  });
});

	$("#CrearClienteForm").unbind('submit').bind('submit', function(e) {
	 e.preventDefault();
	var form = $(this);
	$.ajax({
          url: form.attr('action'),
          type: 'post',
			data:{
				nombre: $('#nombre').val(),
				apellido: $('#apellido').val(),
				email: $('#email').val(),
				id_grupo: $('#id_grupo').val(),
				observaciones: $('#observaciones').val()
			},
          dataType: 'json',
          success:function(response) {
            if(response.success=== true) {
			$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				manageTable.ajax.reload(null, false); 
				$('#NuevoCliente').modal('hide');
				
            } else {
                  $("#CrearClienteForm .messagesForm").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				
             
            }
          }
        }); 		
		
  
	
});
	
	
	

	
	function EditarCliente(id){
        $.ajax({
          url: '<?php echo $helper->url("clientes","getCliente"); ?>',
          type: 'post',
			data:{
				id: id
			},
          dataType: 'json',
          success:function(response) {
            if(response !== null) {
			$("#IDE").val(response.id);	
			$("#NombreE").val(response.nombre);	
			$("#ApellidoE").val(response.apellido);	
			$("#EmailE").val(response.email);	
			$("#id_grupoE").val(response.id_grupo);	
			$("#observacionesE").val(response.observaciones);	
            } else {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>No pudimos cargar los datos del cliente</div>');
             
            }
          }
        }); 		
		$('#EditarCliente').modal('show');
	}
$("#EditarClienteForm").unbind('submit').bind('submit', function(e) {
	 e.preventDefault();
	var form = $(this);
	$.ajax({
          url: form.attr('action'),
          type: 'post',
			data:{
				id: $('#IDE').val(),
				nombre: $('#NombreE').val(),
				apellido: $('#ApellidoE').val(),
				email: $('#EmailE').val(),
				id_grupo: $('#id_grupoE').val(),
				observaciones: $('#observacionesE').val()
			},
          dataType: 'json',
          success:function(response) {
            if(response.success=== true) {
			$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				manageTable.ajax.reload(null, false); 
				$('#EditarCliente').modal('hide');
				
            } else {
                  $("#EditarClienteForm .messagesForm").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+'</div>');
				
             
            }
          }
        }); 		
		
  
	
});
	
	
	function CambiarGrupo(value,id){
        $.ajax({
          url: '<?php echo $helper->url("clientes","cambiarGrupo"); ?>',
          type: 'post',
			data:{
				id: id,
				id_grupo: value
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

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 		
		
		
		
}	
	
	
	
	function removeCli(id){
		var txt;
		var r = confirm("Esta seguro que quiere eliminar el registro?");
		if (r == true) {
			$.ajax({
			  url: '<?php echo $helper->url("clientes","borrar"); ?>',
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
