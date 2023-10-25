$(function() {
    $("#login input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault();
            var formData = new FormData($("#formLogin")[0]);
            $('#button_login').hide();
            $("#loading").show();
            
            $.ajax({
                url: "login.php",
                type: "POST",
                data: formData,
                    contentType: false,
                processData: false,
                cache: false,
                    dataType: 'json',
                    success: function(resp){
                        if (resp.error){
                            var erroresList = '<ul>';
                            $.each(resp.error, function(key, message) {
                                erroresList += '<li>'+message+'</li>';
                            });
                            erroresList += '</ul>';

                            // Fail message
                            $('#msnModal .modal-title').html('verificar datos');
                            $('#msnModal .modal-detail').html(erroresList);
                            $('#msnModal').modal('show');

                            $("#loading").hide();
                            $("#button_login").show();
                        }else{
                            // OK message
                            $('#formLogin').trigger("reset");
                            window.location = 'login.php?msn=4';
                        }
                    },
                error: function() {
                    // Fail message
                    $('#msnModal .modal-title').html('Lo sentimos');
                    $('#msnModal .modal-detail').html('Servidor no responde');
                    $('#msnModal').modal('show');
                    $('#formLogin').trigger("reset");
                    $("#loading").hide();
                    $("#button_login").show();
                }
            });
        },
        filter: function() {
            return $(this).is(":visible");
        }
    });
});