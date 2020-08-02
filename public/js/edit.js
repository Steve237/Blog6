    function handleDeleteButtons() {

        $('button[data-action="delete"]').click(function(){
            const target = this.dataset.target;
            $(target).remove();
        });
    }
    handleDeleteButtons();