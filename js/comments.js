function showCom(id) {
    var x = document.getElementById("comments-body"+id);
    if(x.style.display=="none"){
        x.style.display = "block";
        var com = document.getElementById("comment-section"+id);
        if(com.innerText==""){
            $(document).ready(function () {
                setTimeout(function(){
                    $("#comment-section"+id).load(localStorage.getItem("web")+"/php/load_comments.php", {id: id, num: 0})
                }, 20);
            });
        }
    }else{
        x.style.display = "none";
        document.getElementById("comment-section"+id).innerText = "";
        document.getElementById("loadmore-"+id).setAttribute("load","5");
    }
}

$(document).ready(function () {
    $(".load-more").click(function (event) {
        var array = event.target.id.split("-");
        var id = array[1];
        var count = document.getElementById("loadmore-"+id).getAttribute("load");
        var newcount = parseInt(count)+5;
        document.getElementById("loadmore-"+id).setAttribute("load",newcount);

        $.ajax({
           type:"POST",
           url: localStorage.getItem("web")+"/php/load_comments.php",
           data: {id: id,num: count},
           success: function(response){
               $("#comment-section"+id).append(response);
           }
        });
    });
});

$(document).ready(function () {
    $(".add-comment") .keypress(function (e) {

    if(e.keyCode===13){
        var id = e.target.id.substring(12,e.target.id.length);
        var text = document.getElementById("add-comment-"+id).value
        if(document.getElementById("add-comment-"+id).getAttribute("edit")==0){
            //$(".add-comment").load(localStorage.getItem("web")+"/php/add_comment.php",{id: id, text: text});

            $.ajax({
                type:"POST",
                url: localStorage.getItem("web")+"/php/add_comment.php",
                data: {id: id, text: text},
                success: function(response){
                    var commentSection = document.getElementById("comment-section"+id);
                    var text = commentSection.innerHTML;
                    commentSection.innerHTML = response+text;

                }
            });
            document.getElementById("add-comment-"+id).value = "";

            setTimeout(function(){
                //var count = document.getElementById("loadmore-"+id).getAttribute("load");
                //$("#comment-section"+id).load(localStorage.getItem("web")+"/php/load_comments.php",{id: id, num: count});

                var num = parseInt(document.getElementById("comment-number"+id).innerText)+1;
                document.getElementById("comment-number"+id).innerHTML = num;
            }, 250);

        }else{
            var idCom = document.getElementById("add-comment-"+id).getAttribute("edit");
            var text = document.getElementById("add-comment-"+id).value;
            $(".add-comment").load(localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",{idComment: idCom, idPost: id, action: 1,text: text});
            document.getElementById("comment-text-"+document.getElementById("add-comment-"+id).getAttribute("edit")).innerHTML = text;
            document.getElementById("add-comment-"+id).value = "";
            document.getElementById("add-comment-"+id).setAttribute("edit","0");
            document.getElementById("cancel-edit"+id).style.visibility = "hidden";
        }
    }else if(e.keyCode===27){
        var id = e.target.id.substring(12,e.target.id.length);
        document.getElementById("add-comment-"+id).value = "";
        document.getElementById("add-comment-"+id).setAttribute("edit","0");
        document.getElementById("cancel-edit"+id).style.visibility = "hidden";
    }
   });
});

function deleteComment() {
    var string = document.getElementById('modal-5').getAttribute('post-id');
    var idPost = string.split(":");
    var id = idPost[0].split("-");
    document.getElementById("comment"+id[3]).style.display = "none";
    var num = parseInt(document.getElementById("comment-number"+idPost[1]).innerText)-1;
    document.getElementById("comment-number"+idPost[1]).innerHTML = num;
    $("#comment"+id[3]).load(localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",{idComment: id[3], idPost: idPost[1], action: 0});
    var count = document.getElementById("loadmore-"+idPost[1]).getAttribute("load");
    document.getElementById("loadmore-"+idPost[1]).setAttribute("load",parseInt(count-1));
    close_modal('modal-5');
}

function editComment() {
    var string = document.getElementById('modal-5').getAttribute('post-id');
    var idPost = string.split(":");
    var id = idPost[0].split("-");
    document.getElementById("add-comment-"+idPost[1]).value = document.getElementById("comment-text-"+id[3]).innerText;
    document.getElementById("add-comment-"+idPost[1]).setAttribute("edit",id[3]);
    document.getElementById("cancel-edit"+idPost[1]).style.visibility = "visible"
    close_modal('modal-5');
}

function hideComment() {
    var string = document.getElementById('modal-6').getAttribute('post-id');
    var idPost = string.split(":");
    var id = idPost[0].split("-");

    document.getElementById("comment"+id[3]).style.display = "none";
    $("#comment"+id[3]).load(localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",{idComment: id[3], idPost: idPost[1], action: 2});
    close_modal('modal-6');
}

function cancel_edit(id) {
    document.getElementById("add-comment-"+id).value = "";
    document.getElementById("add-comment-"+id).setAttribute("edit","0");
    document.getElementById("cancel-edit"+id).style.visibility = "hidden";
}