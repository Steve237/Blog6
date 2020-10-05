    $("#add-video").click(function() {
        // Je récupère le numéro des futurs champs que je vais créer
        const index = +$("#widgets-counter").val();

        // Je récupère le prototype des entrées
        const tmpl = $("#add_figure_videos").data('prototype').replace(/__name__/g, index);

        // J'injecte ce code au sein de la div
        $("#add_figure_videos").append(tmpl);

        $("#widgets-counter").val(index + 1);

        // Je gère le bouton supprimer
        handleDeleteVideos();

    });

    function handleDeleteVideos() {

        $('button[data-action="deletevideo"]').click(function(){
            const target = this.dataset.target;
            console.log(target);
            $(target).remove();
        });
    }

    function updateCounterVideo() {

        const count = +$("#add_figure_videos div.form-group").length;

        $("#widgets-counter").val(count);
    }


    updateCounterVideo();
    handleDeleteVideos();