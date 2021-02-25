<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>

    <div class="container">

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <!--        <MESAJE DE EXITO>       -->
                        <div class="row" id="alertSuccess" style="display:none;">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    <h5>¡En hora buena! Login exitoso.</h5>
                                    <p id="msjExitoRegistro"></p>
                                </div>
                            </div>
                        </div>
                        <!--        <.MESAJE DE EXITO>       -->

                        <!--        <MESAJE DE ERROR>       -->
                        <div class="row" id="alertError" style="display:none;">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <p>¡Whoops! Ocurrieron algunos errores.</p>
                                    <ul id="listaErrores">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--        <.MESAJE DE ERROR>       -->

                        <form id="frmLogin">
                            @csrf
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Ingrese email">
                                    </div>
                                </div>

                                <div class="col-12">                                    
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese password">
                                    </div>
                                </div>

                                <div class="col-12">                                    
                                    <div class="form-group">
                                        <label for="recuerdame">Recuerdame:</label>
                                        <input type="checkbox" name="recuerdame" id="recuerdame" class="form-control" value="1">
                                    </div>
                                </div>

                                <div class="col-12">                                    
                                    <button type="submit" class="btn btn-success btn-block">Iniciar</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    <script>
        $(function() {
            enviarLogin();
        });

        /**
         * Envio de registro de formulario
         */
        var enviarLogin = function() {
            $("#frmLogin").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url:'{{route('login.validarCredenciales')}}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmLogin")[0]),
                    contentType:false,
                    processData:false,
                    beforeSend: function() {
                        $("#alertError").hide(); 
                        $("#alertSuccess").hide(); 
                        console.log("Enviando...");
                    },
                    success: function(data) {
                        if(!data.error) {
                            let mensaje = data.mensaje;
                            let usuario = data.usuario;
                            alert(mensaje);
                            $("#frmLogin")[0].reset();

                            $("#msjExitoLogin").html(mensaje + " " + usuario.email);
                            $("#alertSuccess").show();

                            window.location.href = '{{route('miperfil')}}';
                        } else {
                            let mensaje = data.mensaje;
                            $("#listaErrores").html('<li>' + mensaje + '</li>');
                            $("#alertError").show();
                        }                        
                    },
                    error: function(data) {
                        let errores = data.responseJSON.errors;
                        let msjError = '';
                        Object.values(errores).forEach(function(valor) {
                            msjError += '<li>' + valor[0] + '</li>';
                        });
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();                     
                    },
                    complete: function() {
                        console.log("COMPLETADO");
                    }
                });
            });
        };
    </script>

</body>
</html>