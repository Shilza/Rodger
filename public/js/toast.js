$('.toast__close').click(function(e){
    e.preventDefault();
    const parent = $(this).parent('.toast');
    parent.fadeOut("slow", function() { $(this).remove(); } );
});