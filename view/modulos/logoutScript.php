<script>
    $(document).ready(function() {
        $('.btn-exit-system').on('click', function(e){
            e.preventDefault();
            let token = $(this).attr('href');
            swal({
                title: '¿Estás seguro?',
                text: "La sesión actual se cerrará",
                icon: 'warning',
                buttons: {
                    cancel: "Cancelar",
                    Aceptar: {"Aceptar": true}
                }
            }).then(function (value) {
                if(value) {
                    $.ajax({
                        url: '<?php echo $serverurl ?>ajax/loginAjax.php?Token='+token,
                        success: function (data) {
                            if(data == "true") {
                                window.location.href="<?php echo $serverurl ?>login/";
                            } else {
                                swal(
                                    "Ups!",
                                    "No se pudo cerrar la sesión",
                                    "error"
                                );
                            }
                        } 
                    });
                }
                
            });
        });
    });
</script>