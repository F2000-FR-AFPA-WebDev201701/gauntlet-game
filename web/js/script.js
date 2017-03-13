jQuery(document).ready(function ($) {
// Votre code ici avec les appels à la fonction $()

    $(document).keydown(function (e) {
        switch (e.which) {
            case 37: // left
                moveDirection = 4;
                break;
            case 38: // up
                moveDirection = 1;
                break;
            case 39: // right
                moveDirection = 2;
                break;
            case 40: // down
                moveDirection = 3;
                break;
            default:
                return; // exit this handler for other keys
        }

        $.ajax({
            url: 'tests/move', // La ressource ciblée
            type: 'GET', // Le type de la requête HTTP.
            data: 'move=' + moveDirection,
            dataType: 'html',
            success: function (code_html, statut) {

                //alert(code_html);
                $(".plateau").html(code_html);

            },
            error: function (resultat, statut, erreur) {


            },
            complete: function (resultat, statut) {


            }
        }) // end ajax

        e.preventDefault(); // prevent the default action (scroll / move caret)
    });
});