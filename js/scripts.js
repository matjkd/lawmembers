//Modal dialog increase the default animation speed to exaggerate the effect
$.fx.speeds._default = 500;
$(document).ready(function(){
    $( "#dialog" ).dialog({
        autoOpen: false,
        show: "fade",
        hide: "fade",
        width:"800px"
    });

    $( "#opener" ).click(function() {
        $( "#dialog" ).dialog( "open" );
        return false;
    });
});

$(document).ready(function(){
    jQuery(function() {
        jQuery('.wymeditor').wymeditor();
    });
});

