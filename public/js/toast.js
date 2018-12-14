$('.toast__close').click(function(e){
    e.preventDefault();
    const parent = $(this).parent('.toast');
    parent.fadeOut("fast", function() { $(this).remove(); } );
});