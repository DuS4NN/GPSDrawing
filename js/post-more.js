function go_on_post(modalid){
    var id = document.getElementById(modalid).getAttribute("post-id");
    window.location=localStorage.getItem("web")+"/posts/"+id;
}

function hide_post(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
    $("#alerts-2").load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 0});
    document.getElementById("post-"+id).style.display = "none";
}

function add_to_bookmarks(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
    var data = document.getElementById(id).getAttribute("data-modal");
    close_modal(modalid);
    if(data=='modal-1') document.getElementById(id).setAttribute("data-modal", "modal-2");
    else document.getElementById(id).setAttribute("data-modal", "modal-4");
    $("#alerts-2").load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 1});
}

function remove_from_bookmarks(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
    var data = document.getElementById(id).getAttribute("data-modal");
    close_modal(modalid);
    if(data=='modal-2') document.getElementById(id).setAttribute("data-modal","modal-1");
    else document.getElementById(id).setAttribute("data-modal","modal-3");
    $("#alerts-2").load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 2});
}

function delete_post(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
    $("#alerts-2").load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 3});
    document.getElementById("post-"+id).style.display = "none";
    close_modal(modalid);
}

function edit_post(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
}

function report(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
}

function add_to_project(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
}
