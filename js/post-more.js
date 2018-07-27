function go_on_post(modalid){
    var id = document.getElementById(modalid).getAttribute("post-id");
    window.location=localStorage.getItem("web")+"/posts/"+id;
}

function hide_post(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-H-'+id+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-H-'+id+'-'+random);

    $("#alert-H-"+id+"-"+random).load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 0});
    close_modal(modalid);
    document.getElementById("post-"+id).style.display = "none";

}

function add_to_bookmarks(modalid) {

    var id = document.getElementById(modalid).getAttribute("post-id");
    var data = document.getElementById(id).getAttribute("data-modal");
    close_modal(modalid);
    if(data=='modal-1') document.getElementById(id).setAttribute("data-modal", "modal-2");
    else document.getElementById(id).setAttribute("data-modal", "modal-4");

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-ATB-'+id+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-ATB-'+id+'-'+random);

    $('#alert-ATB-'+id+'-'+random).load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 1});
}

function remove_from_bookmarks(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
    var data = document.getElementById(id).getAttribute("data-modal");
    close_modal(modalid);
    if(data=='modal-2') document.getElementById(id).setAttribute("data-modal","modal-1");
    else document.getElementById(id).setAttribute("data-modal","modal-3");

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-RFB-'+id+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-RFB-'+id+'-'+random);

    $("#alert-RFB-"+id+"-"+random).load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 2});
}

function delete_post(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-D-'+id+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-D-'+id+'-'+random);


    $("#alert-D-"+id+"-"+random).load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 3});
    document.getElementById("post-"+id).style.display = "none";
    close_modal(modalid);
}

function report(reason) {
    var id = document.getElementById('modal-report').getAttribute("post-id");

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-R-'+id+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-R-'+id+'-'+random);

    $("#alert-R-"+id+"-"+random).load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 4, reason: reason});
    close_modal('modal-report');
}

function edit_post() {
    var id = document.getElementById('modal-edit').getAttribute("post-id");
    var text = document.getElementById('md-modal-edit-input').value;

    document.getElementById("post-description-"+id).innerText = text;

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-E-'+id+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-E-'+id+'-'+random);

    $("#alert-E-"+id+"-"+random).load(localStorage.getItem("web")+"/php/post-actions.php",{id: id, action: 5, text: text});
    close_modal('modal-edit');
}

function add_to_project(modalid) {
    var id = document.getElementById(modalid).getAttribute("post-id");
}
