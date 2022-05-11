$(document).ready(function(){
    $('.sidenav').sidenav();
});

$.ajax({
    url: "action.php",
    method: "POST",
    data: {
        'id': 42,
        'rota': 'testeId'
    }
}).done(function() {
    $( this ).addClass( "done" );
});

$(document).ready(function(){
    $('.collapsible').collapsible();
});

$(document).ready(function(){
    $('.tooltipped').tooltip();
});