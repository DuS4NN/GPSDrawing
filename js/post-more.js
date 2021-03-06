function go_on_post(modal_id){
    let id = document.getElementById(modal_id).getAttribute("post-id");
    window.location=localStorage.getItem("web")+"/post/"+id;
}

function hide_post(modal_id) {
    let id = document.getElementById(modal_id).getAttribute("post-id");
    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id, action: 0},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal(modal_id);
    document.getElementById("post-"+id).style.display = "none";
    limit--;
    let loc = window.location.href;
    if(loc.endsWith("bookmarks")){
        load_post('bookmarks_post');
    }else if(loc.endsWith("home")){
        load_post('main_post');
    }
}

function load_post(action){
    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/load_posts.php",
        data:{action:action,limit:limit},
        success:function(response){
            $("#body").append(response);
        }
    });
    limit++;
}

function add_to_bookmarks(modal_id) {

    let id = document.getElementById(modal_id).getAttribute("post-id");
    let data = document.getElementById(id).getAttribute("data-modal");

    if(data==='modal-1') document.getElementById(id).setAttribute("data-modal", "modal-2");
    else document.getElementById(id).setAttribute("data-modal", "modal-4");


    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id, action: 1},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal(modal_id);

}

function remove_from_bookmarks(modal_id) {
    let id = document.getElementById(modal_id).getAttribute("post-id");
    let data = document.getElementById(id).getAttribute("data-modal");

    if(data==='modal-2') document.getElementById(id).setAttribute("data-modal","modal-1");
    else document.getElementById(id).setAttribute("data-modal","modal-3");

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id, action: 2},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal(modal_id);
    let loc = window.location.href;
    if(window.location.href.includes("bookmarks")){
        document.getElementById("post-"+id).style.display = "none";
        limit--;
        if(loc.endsWith("bookmarks")){
            load_post('bookmarks_post');
        }else if(loc.endsWith("home")){
            load_post('main_post');
        }
    }

}

function delete_post(modal_id) {
    let id = document.getElementById(modal_id).getAttribute("post-id");

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id, action: 3},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    let loc = window.location.href;
    document.getElementById("post-"+id).style.display = "none";
    close_modal(modal_id);
    limit--;
    if(loc.endsWith("bookmarks")){
        load_post('bookmarks_post');
    }else if(loc.endsWith("home")){
        load_post('main_post');
    }
}

function report(reason) {
    let id = document.getElementById('modal-report').getAttribute("post-id");

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id, action: 4, reason: reason},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal('modal-report');
}

function edit_post() {
    let id = document.getElementById('modal-edit').getAttribute("post-id");
    let text = document.getElementById('md-modal-edit-input').value;

    document.getElementById("post-description-"+id).innerText = text;

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id, action: 5, text: text},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal('modal-edit');
}

function add_to_project() {
    let id = document.getElementById("modal-add-project").getAttribute("post-id");
    let select = document.getElementById('project-id-select');
    var strUser = select.options[select.selectedIndex].value;
    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/projects.php",
        data: {id_project: strUser, id_post:id, action: 4},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal("modal-add-project");
}

$(document).ready(function () {
   $('#md-modal-edit-input').keypress(function (e) {
      if(e.keyCode===13){
        edit_post();
      }
   });
});