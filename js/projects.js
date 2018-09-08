function create_new_project() {
    let name = $('#md-modal-project-input').val();

    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/projects.php",
        data: {action:1,name: name},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            let rr = response.split("ID-PROJECT:");
            if(rr.length===2){
                alertSection.innerHTML = text + rr[0];


                $('#projects-list').append('<div id="projects-list-item" class="project-'+rr[1]+'"> <div id="projects-list-item-text">'+name+'</div><div id="projects-list-item-more"><span id="'+rr[1]+'" class="fas fa-ellipsis-v md-trigger" data-modal="modal-delete-project" ></span></div> </div>');
            }else{
                alertSection.innerHTML = text + rr[0];
            }
            closeAlert('remove');
        }
    });
    $('#md-modal-project-input').val("");
    close_modal("modal-create-new-projects")
}

function deleteProject() {
    let id = $('#modal-delete-project').attr('post-id');
    $.ajax({
        type:"POST",
        url: localStorage.getItem("web")+"/php/projects.php",
        data: {action:2,id: id},
        success: function(response){
            let alertSection = document.getElementById("alerts-2");
            let text = alertSection.innerHTML;
            alertSection.innerHTML = text + response;
            closeAlert('remove');
        }
    });
    $('.project-'+id).css('display','none');
    close_modal("modal-delete-project");
}