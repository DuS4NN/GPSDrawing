function showCom(id) {
    var x = document.getElementById("comments-body"+id);
    if(x.style.display=="none"){
        x.style.display = "block";
        var com = document.getElementById("comment-section"+id);
        if(com.innerHTML==""){
            $(document).ready(function () {
                setTimeout(function(){
                    $("#comment-section"+id).load(localStorage.getItem("web")+"/php/load_comments.php", {id: id, num: 5})
                }, 100);
            });
        }
    }else{
        x.style.display = "none";
        document.getElementById("comment-section"+id).innerHTML = "";
    }
}

$(document).ready(function () {
    $(".load-more").click(function (event) {
        var array = event.target.id.split("-");
        var id = array[2];
        var count = array[1];
        var newcount = parseInt(count)+5;
        document.getElementById("loadmore-"+count+"-"+id).id = "loadmore-"+newcount+"-"+id;
            $("#comment-section"+id).load(localStorage.getItem("web")+"/php/load_comments.php",{id: id, num: newcount});
    });
});

$(document).ready(function () {
    $(".add-comment") .keypress(function (e) {
    if(e.keyCode==13){
        var id = e.target.id.substring(12,e.target.id.length);
        var text = document.getElementById("add-comment-"+id).value
        $(".add-comment").load(localStorage.getItem("web")+"/php/add_comment.php",{id: id, text: text});
        document.getElementById("add-comment-"+id).value = "";
        setTimeout(function(){
            $("#comment-section"+id).load(localStorage.getItem("web")+"/php/load_comments.php",{id: id, num: 5});
            var num = parseInt(document.getElementById("comment-number"+id).innerText)+1;
            document.getElementById("comment-number"+id).innerHTML = num;
        }, 250);

    }
   });
});

function deleteComment(idComment) {
    var idPost = idComment.split(":");
    var id = idPost[0].split("-");
    document.getElementById("comment"+id[3]).style.display = "none";
    var num = parseInt(document.getElementById("comment-number"+idPost[1]).innerText)-1;
    document.getElementById("comment-number"+idPost[1]).innerHTML = num;
    $("#comment"+id[3]).load(localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",{idComment: id[3], idPost: idPost[1], action: 0});

}

function editComment(id) {

}

function hideComment(id) {
    var idPost = id.split(":");
    var id = idPost[0].split("-");

    document.getElementById("comment"+id[3]).style.display = "none";
    $("#comment"+id[3]).load(localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",{idComment: id[3], idPost: idPost[1], action: 2});
}