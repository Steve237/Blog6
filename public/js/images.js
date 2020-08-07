    $('#add-image').click(function(){
        // Je récupère le numéro des futurs champs que je vais créer
        const index = +$('#widgets-counter').val();

        // Je récupère le prototype des entrées
        const tmpl = $('#add_figure_images').data('prototype').replace(/__name__/g, index);

        // J'injecte ce code au sein de la div
        $('#add_figure_images').append(tmpl);

        $('#widgets-counter').val(index + 1);

        // Je gère le bouton supprimer
        handleDeleteButtons();

    });

    
   function handleDeleteButtons() {

        $('button[data-action="delete"]').click(function(){
            const target = this.dataset.target;
            console.log(target);
            $(target).remove();
        });
    }


    function updateCounter() {

        const count = +$('#add_figure_images div.form-group').length;

        $('#widgets-counter').val(count);
    }


    updateCounter();
    handleDeleteButtons();
    