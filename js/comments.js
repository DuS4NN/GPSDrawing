function showCom(id) {
    let x = document.getElementById("comments-body"+id);
    if(x.style.display==="none"){
        x.style.display = "block";
        let com = document.getElementById("comment-section"+id);
        if(com.innerText===""){
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
    $(document).on('click','.load-more',function (event) {
        let array = event.target.id.split("-");
        let id = array[1];
        let count = document.getElementById("loadmore-"+id).getAttribute("load");
        let newcount = parseInt(count)+5;
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
    $(document).on('keypress','.add-comment', function (e) {

    if(e.keyCode===13){
        let id = e.target.id.substring(12,e.target.id.length);
        let text = document.getElementById("add-comment-"+id).value;
        if(document.getElementById("add-comment-"+id).getAttribute("edit")==="0"){

            $.ajax({
                type:"POST",
                url: localStorage.getItem("web")+"/php/add_comment.php",
                data: {id: id, text: text},
                success: function(response){
                    let commentSection = document.getElementById("comment-section"+id);
                    let text = commentSection.innerHTML;
                    commentSection.innerHTML = response+text;

                }
            });
            document.getElementById("add-comment-"+id).value = "";
            let number = parseInt(document.getElementById("comment-number"+id).innerText)+1;
            document.getElementById("comment-number"+id).innerHTML = number+"";

            let count = parseInt(document.getElementById("loadmore-"+id).getAttribute("load"));
            document.getElementById("loadmore-"+id).setAttribute("load",parseInt(count+1));

        }else{
            let idCom = document.getElementById("add-comment-"+id).getAttribute("edit");
            let text = document.getElementById("add-comment-"+id).value;

            $.ajax({
                type:"POST",
                url: localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",
                data: {idComment: idCom, idPost: id, action: 1,text: text},
                success: function(response){
                    let alertSection = document.getElementById("alerts-2");
                    let text = alertSection.innerHTML;
                    alertSection.innerHTML = text + response;
                    closeAlert('remove');
                }
            });

            document.getElementById("comment-text-"+document.getElementById("add-comment-"+id).getAttribute("edit")).innerHTML = text;
            document.getElementById("add-comment-"+id).value = "";
            document.getElementById("add-comment-"+id).setAttribute("edit","0");
            document.getElementById("cancel-edit"+id).style.visibility = "hidden";
        }
    }else if(e.keyCode===27){
        let id = e.target.id.substring(12,e.target.id.length);
        document.getElementById("add-comment-"+id).value = "";
        document.getElementById("add-comment-"+id).setAttribute("edit","0");
        document.getElementById("cancel-edit"+id).style.visibility = "hidden";
    }
   });
});

function deleteComment() {
    let string = document.getElementById('modal-5').getAttribute('post-id');
    let idPost = string.split(":");
    let id = idPost[0].split("-");
    document.getElementById("comment"+id[3]).style.display = "none";
    let number = parseInt(document.getElementById("comment-number"+idPost[1]).innerText)-1;
    document.getElementById("comment-number"+idPost[1]).innerHTML = number+"";

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",
        data: {idComment: id[3], idPost: idPost[1], action: 0},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });


    let count = document.getElementById("loadmore-"+idPost[1]).getAttribute("load");
    document.getElementById("loadmore-"+idPost[1]).setAttribute("load",parseInt(count-1));
    close_modal('modal-5');
}

function editComment() {
    let string = document.getElementById('modal-5').getAttribute('post-id');
    let idPost = string.split(":");
    let id = idPost[0].split("-");
    document.getElementById("add-comment-"+idPost[1]).value = document.getElementById("comment-text-"+id[3]).innerText;
    document.getElementById("add-comment-"+idPost[1]).setAttribute("edit",id[3]);
    document.getElementById("cancel-edit"+idPost[1]).style.visibility = "visible";
    close_modal('modal-5');
}

function hideComment() {
    let string = document.getElementById('modal-6').getAttribute('post-id');
    let idPost = string.split(":");
    let id = idPost[0].split("-");


    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/delete_edit_hide_comments.php",
        data: {idComment: id[3], idPost: idPost[1], action: 2},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });

    let count = parseInt(document.getElementById("loadmore-"+idPost[1]).getAttribute("load"))-1;
    document.getElementById("loadmore-"+idPost[1]).setAttribute("load",count+"");

    document.getElementById("comment"+id[3]).style.display = "none";
    close_modal('modal-6');
}

function cancel_edit(id) {
    document.getElementById("add-comment-"+id).value = "";
    document.getElementById("add-comment-"+id).setAttribute("edit","0");
    document.getElementById("cancel-edit"+id).style.visibility = "hidden";
}