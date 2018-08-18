$(document).on("click", ".closebtn", function(){
    let div = $(this).parent();
    div.css('opacity','0');
    setTimeout(function(){ div.css('display','none') }, 500);
});


function closeAlert(id) {
    let div = document.getElementsByClassName(id);
    console.log(div);
    let length = div.length-1;
    setTimeout(function () {
        div[length].style.opacity = '0';
        setTimeout(function(){
            div[length].style.display='none';
        }, 500);
    },10000);
}