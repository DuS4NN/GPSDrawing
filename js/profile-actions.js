function block_user(id){
    var id_user = document.getElementById(id).getAttribute('post-id');
    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-BL-'+id_user+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-BL-'+id_user+'-'+random);
    $("#alert-BL-"+id_user+"-"+random).load(localStorage.getItem("web")+"/php/profile-actions.php",{id: id_user, action: 2});
    close_modal(id);

    setTimeout(function () {
       location.reload();
    },50);
}

function report_user(reason) {

    var id_user = document.getElementById("modal-report-user").getAttribute('post-id');

    var random = parseInt(Math.random()*1000);
    var div = document.createElement('div');
    div.id = 'alert-RE-'+id_user+'-'+random;
    var parentDiv = document.getElementById("alerts-2");
    parentDiv.appendChild(div);
    closeAlert('alert-RE-'+id_user+'-'+random);

    $("#alert-RE-"+id_user+"-"+random).load(localStorage.getItem("web")+"/php/profile-actions.php",{id: id_user, action: 1, reason: reason});
    close_modal('modal-report-user');
}

function sign_out() {
    sessionStorage.clear();
    $("#profile").load(localStorage.getItem("web")+"/php/profile-actions.php",{id: 1, action: 0});
    setTimeout(function () {
        window.location=localStorage.getItem("web")+"/";
    },50);

}