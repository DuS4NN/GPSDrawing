function block_user(id){
    let id_user = document.getElementById(id).getAttribute('post-id');

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/profile-actions.php",
        data: {id: id_user, action: 2},
        success: function(response){
            setTimeout(function () {
                window.location.replace(localStorage.getItem("web")+"/home");
            },50);
        }
    });

    close_modal(id);


}

function report_user(reason) {

    let id_user = document.getElementById("modal-report-user").getAttribute('post-id');

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/post-actions.php",
        data: {id: id_user, action: 1, reason: reason},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    close_modal('modal-report-user');
}

function sign_out() {
    sessionStorage.clear();
    $("#profile").load(localStorage.getItem("web")+"/php/profile-actions.php",{id: 1, action: 0});
    setTimeout(function () {
        window.location=localStorage.getItem("web")+"/";
    },50);

}