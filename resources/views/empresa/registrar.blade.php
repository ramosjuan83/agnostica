

@extends('layouts.app')
@section('content')

<div class="container">      


@if(session()->has('mensaje'))
            <div class="container">  
            <div class='row justify-content-center'>
              <div class="col-md-6">
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  {{ session('mensaje') }}
                </div>
              </div> 
            </div>   
            </div> 
    @elseif(session()->has('error'))
                <!--<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                       {{ session('error') }}
                </div>-->
    @endif
    
<div class='row justify-content-center'>
<div class='col-md-6'>
<div class='card-body'>
  <div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
<form role="form" id='frmEmpresa' enctype="multipart/form-data" action="{{ url('empresa_guardar') }}" method="POST">
{{ csrf_field() }}     
  <fieldset>
    <h2>REGISTRAR EMPRESA</h2>
    <div class="form-group">
    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" maxlength='255' placeholder="Nombre de Empresa">
    <div id='val_nombre_empresa'></div>
    </div>
    <div class="form-group">
    <input type="text" class="form-control" id="rif_empresa" name='rif_empresa' maxlength='20' placeholder="Número de Rif">
    <div id='val_rif_empresa'></div>  
  </div>
    <div class="form-group">
    <input type="text" class="form-control" id="telefono_empresa" name='telefono_empresa' maxlength='16' placeholder="Teléfono">
    </div>
    <div id='val_telefono_empresa'></div>
    <div class="form-group">
    <textarea placeholder="Dirección" id='direccion' name='direccion' class='form-control' ></textarea>
    </div>
    <div id='val_direccion'></div>
    <input type="button" name="siguiente" class="next btn btn-info" value="Siguiente" />
  </fieldset>
  <fieldset id='usuario_form'>
    <h2>REGISTRAR USUARIO</h2>
    <div class="form-group">
    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" maxlength='255'>
    </div>
    <div class="form-group">
    <input type="text" class="form-control" id="apellido" name='apellido' placeholder="Apellido" maxlength='255'>
    </div>
    <div class="form-group">
    <input type="text" class="form-control" id="rif_usuario" name='rif_usuario' maxlength='20' placeholder="Rif o Cédula">
    <div id='val_rif_usuario'></div> 
   </div>
    <div class="form-group">
    <input type="text" class="form-control" id="telefono" name='telefono' placeholder="Teléfono" maxlength='16'>
    </div>
    <div class="form-group">
    <input type="text" class="form-control" id="email" name='email' placeholder="Email">
    <div id='val_email'></div>
    </div>
    <div class="form-group">
    <input type="password" class="form-control" id="password" name='password' placeholder="Contraseña">
    </div>
    <div class="form-group">
    <input type="password" class="form-control" id="confirmar_password" name='confirmar_password' placeholder="Confirmar Contraseña">
    </div>
    <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
    <input type="submit" name="submit" id='Enviar' class="submit btn btn-success" value="Enviar" />
  </fieldset>
  </form>
</div>
</div>
</div>

  </div>  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
  var current = 1,current_step,next_step,steps;
  
  $("#usuario_form").hide();
  steps = $("fieldset").length;
  $(".next").click(function(){

    if($("#nombre_empresa").val()==""){
      $("#val_nombre_empresa").html("<strong><font color='red'>El Nombre de Empresa no puede ser vacio</font></strong>");
      return false;
    }else{
      $("#val_nombre_empresa").html("");
      if($("#rif_empresa").val()==""){
        $("#val_rif_empresa").html("<strong><font color='red'>El Rif de Empresa no puede ser vacio</font></strong>");
        return false;
      }else{
        $("#val_rif_empresa").html("");
        if($("#telefono_empresa").val()==""){
          $("#val_telefono_empresa").html("<strong><font color='red'>El Telefono de Empresa no puede ser vacio</font></strong>");
          return false;
        }else{
          $("#val_telefono_empresa").html("");
          if($("#direccion").val()==""){
            $("#val_direccion").html("<strong><font color='red'>La Dirección de Empresa no puede ser vacio</font></strong>");
            return false;
          }else{
            $("#val_direccion").html("");
          }
        }
      }
    }

    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();
    current_step.hide();
    setProgressBar(++current);
  });

  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });

  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  }
});

$(document).ready(function(){ 
    // validar que el campo sea númerico
       $('#rif_empresa').on('keyup',function(){
          var cadena=this.value;
          
          if( isNaN(this.value) ) {
            cadena = this.value.slice(0, -1);
          }

          $('#rif_empresa').val(cadena);
       });

       $('#telefono_empresa').on('keyup',function(){
          var cadena=this.value;
          
          if( isNaN(this.value) ) {
            cadena = this.value.slice(0, -1);
          }

          $('#telefono_empresa').val(cadena);
       });

       $('#rif_usuario').on('keyup',function(){
          var cadena=this.value;
          
          if( isNaN(this.value) ) {
            cadena = this.value.slice(0, -1);
          }

          $('#rif_usuario').val(cadena);
       });

       $('#telefono').on('keyup',function(){
          var cadena=this.value;
          
          if( isNaN(this.value) ) {
            cadena = this.value.slice(0, -1);
          }

          $('#telefono').val(cadena);
       });

  });

 

  $('#frmEmpresa').validate({
       rules: {
          nombre_empresa: {
             required: true,
             minlength: 3
          },
          name: {
             required: true,
             minlength: 3
          },
          apellido: {
             required: true,
             minlength:3
          },
          email: {
             required: true,
             email: true
          },
          rif_usuario: {
             required: true,
             minlength:3
          },
          telefono: {
             required: true,
             minlength:10
          },
          password: {
             required: true,
             minlength:8
          },
          confirmar_password: {
             required: true,
             minlength:8,
             equalTo : "#password"
          },
       },
       messages: {  
          nombre_empresa: {
             required: "<strong><font color='red'>Por favor ingrese un nombre de empresa</font></strong>",
             minlength: "<strong><font color='red'>El nombre debe ser de no menos de 3 caracteres</font></strong>"
          },         
          name: {
             required: "<strong><font color='red'>Por favor ingrese un nombre</font></strong>",
             minlength: "<strong><font color='red'>El nombre debe ser de no menos de 3 caracteres</font></strong>"
          },
          apellido: {
             required: "<strong><font color='red'>Por favor ingrese un apellido</font></strong>",
             minlength: "<strong><font color='red'>El apellido debe ser de no menos de 3 caracteres</font></strong>"
          },
          email: {
             required: "<strong><font color='red'>Coloque un Email</font></strong>",
             email: "<strong><font color='red'>Debe ser un Email</font></strong>"
          },
          rif_usuario: {
             required: "<strong><font color='red'>Coloque un Rif del Usuario</font></strong>",
             minlength: "<strong><font color='red'>El Rif de usuario debe ser de no menos de 3 caracteres</font></strong>"
          },
          telefono: {
             required: "<strong><font color='red'>Coloque un nro teléfono del Usuario</font></strong>",
             minlength: "<strong><font color='red'>El telefono debe ser de no menos de 10 numeros</font></strong>"
          },
          password: {
             required: "<strong><font color='red'>Coloque un Password</font></strong>",
             minlength: "<strong><font color='red'>El Password no menos de 8 caracteres</font></strong>"
          },confirmar_password: {
             required: "<strong><font color='red'>Coloque un Password</font></strong>",
             minlength: "<strong><font color='red'>El password debe ser de no menos de 8 caracteres </font></strong>",
             equalTo : "<strong><font color='red'>No Coincide el Password</font></strong>"
          }
       },
       errorElement: "em",
       errorPlacement: function (error, element) {
          // Add the `help-block` class to the error element
          error.addClass("help-block");
 
          if (element.prop( "type" ) === "checkbox") {
             error.insertAfter(element.parent("label") );
          } else {
             error.insertAfter(element);
          }
       },
       highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
       },
       unhighlight: function (element, errorClass, validClass) {
          $( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );  
       }


    });


    $(document).ready(function(){ 

      $('#rif_empresa').on('blur',function(){  

         $.get('consultar_rif',{rif:this.value},function(usuarios){
                                 $.each(usuarios,function(index,valor){
                                       if(valor > 0){
                                          $("#rif_empresa").val("");
                                          $("#val_rif_empresa").html("<strong><font color='red'>El Rif de Empresa ya está registrado</font></strong>"); 
                                       }else{
                                          $("#val_rif_empresa").html("");
                                       }  
                                 });

         });
    });

    $('#email').on('blur',function(){  

         $.get('consultar_email',{email:this.value},function(usuarios){
                                 $.each(usuarios,function(index,valor){
                                       if(valor > 0){
                                          $("#val_email").html("<strong><font color='red'>El correo de Usuario ya está registrado</font></strong>"); 
                                          $("#email").val("");
                                       }else{
                                          
                                          $("#val_email").html("");
                                       }  
                                 });

         });
      });

      $('#rif_usuario').on('blur',function(){  

         $.get('consultar_rif_usuario',{rif_usuario:this.value},function(usuarios){
                                 $.each(usuarios,function(index,valor){
                                       if(valor > 0){
                                          $("#val_rif_usuario").html("<strong><font color='red'>El Rif o Cédula de Usuario ya está registrado</font></strong>"); 
                                          $("#rif_usuario").val("");

                                       }else{
                                          $("#Enviar").show();
                                          
                                       }  
                                 });

         });

      });


    });
    

</script>

@endsection