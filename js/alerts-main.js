$(document).on("click", ".closebtn", function(){
    var div = $(this).parent();
    div.css('opacity','0');
    setTimeout(function(){ div.css('display','none') }, 600);
});


function closeAlert(id) {
    var div = document.getElementById(id);
    setTimeout(function () {
    div.style.opacity = '0';
    setTimeout(function(){ div.style.display='none'; }, 500);
    },10000);
}