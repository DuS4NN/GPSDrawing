$(document).on('click','.md-trigger',function () {
	var id= $(this).attr('id');
	var modal="";
	if(id.startsWith("report")) {
	    if(id.endsWith("user")){
            modal = document.getElementById("modal-report-user");
            modal.className = modal.className + " md-show";
        }else{
            modal = document.getElementById("modal-report");
            modal.className = modal.className + " md-show";
        }
        var top = window.pageYOffset;
        document.body.style.position = "fixed";
        document.body.style.top = "-"+top;
        localStorage.setItem("top",top+"");


    }
    else if(id.startsWith("md-edit")) {
	    modal = document.getElementById("modal-edit");
        modal.className = modal.className + " md-show";
        var text = document.getElementById("post-description-" + modal.getAttribute("post-id")).innerText;
        document.getElementById("md-modal-edit-input").value = text;

        var top = window.pageYOffset;
        document.body.style.position = "fixed";
        document.body.style.top = "-"+top;
        localStorage.setItem("top",top+"");
    }
    else if(id.startsWith("project-")) {

        let id_post = $('#modal-add-project').attr('post-id');
        $.ajax({
            type: "POST",
            url: localStorage.getItem("web") + "/php/projects.php",
            data: {id: id_post, action: 3},
            success: function (response) {
                if (response.includes("SUCCESS:ADD:TO:PROJECT")) {
                    modal = document.getElementById(id);
                    document.getElementById(modal.getAttribute("data-modal")).className = document.getElementById(modal.getAttribute("data-modal")).className + " md-show";

                    var top = window.pageYOffset;
                    document.body.style.position = "fixed";
                    document.body.style.top = "-" + top;
                    localStorage.setItem("top", top + "");
                } else {
                    let alertSection = document.getElementById("alerts-2");
                    let text = alertSection.innerHTML;
                    alertSection.innerHTML = text + response;
                    closeAlert('remove');
                }
            }
        });
    }
    else if(id.startsWith("publish")){

	    let id_project = id.split('-')[2];

        modal = document.getElementById("publish-projects");
        modal.className = modal.className + " md-show";
        modal.setAttribute('post-id',id_project);

        var top = window.pageYOffset;
        document.body.style.position = "fixed";
        document.body.style.top = "-"+top;
        localStorage.setItem("top",top+"");
    }
    else{
        modal = document.getElementById(id);
        document.getElementById(modal.getAttribute("data-modal")).className = document.getElementById(modal.getAttribute("data-modal")).className+ " md-show";

        document.getElementById(modal.getAttribute("data-modal")).setAttribute("post-id",id);
        var top = window.pageYOffset;
        document.body.style.position = "fixed";
        document.body.style.top = "-"+top;
        localStorage.setItem("top",top+"");
    }

	$(".md-overlay").click(function () {
	    $(".md-overlay").removeClass('visible');
	    close_modal();
    });

    $(document).keypress(function (e) {
        if(id==null)return;

        if(e.keyCode===27){
            close_modal();
        }
    });

    function close_modal() {
        if(id.startsWith("report")){
            $(modal).removeClass('md-show');
            //var b = modal.className.split(" ");
            //modal.className = b[0]+" "+b[1];
        }else if(id.startsWith("md-edit")) {
            $(modal).removeClass('md-show');
            //console.log("Dsssssssssssssssssssssssss");
            //var b = modal.className.split(" ");
            //modal.className = b[0] + " " + b[1];
        }else if(id.startsWith("publish")){
            $('#publish-projects').removeClass('md-show');
        }else{
            $(document).unbind('keypress');
            var aa = document.getElementById(modal.getAttribute("data-modal"));
            var b = aa.className.split(" ");
            aa.className = b[0]+" "+b[1];
        }

        document.body.style.position = "static";
        document.body.style.top = null;
        let md_really = document.getElementsByClassName('md-modal-really');
        for(let i=0;  i<md_really.length;i++){
            md_really[i].style.maxHeight=null;
        }
        //document.body.style.overflowY = "auto";
        window.scrollTo(0,localStorage.getItem("top"));
        $(".md-overlay").removeClass('visible');
    }

    $('.md-close').click(function () {
        close_modal();
    });
});

function close_modal(id) {
    $(".md-overlay").removeClass('visible');
    $(document).unbind('keypress');
    var modal = document.getElementById(id);
    var classmodal = modal.className.split(" ");
    modal.className = classmodal[0]+" "+classmodal[1];
    document.body.style.position = "static";
    document.body.style.top = null;
    //document.body.style.overflowY = "auto";
    window.scrollTo(0,localStorage.getItem("top"));
    let md_really = document.getElementsByClassName('md-modal-really');
    for(let i=0;  i<md_really.length;i++){
        md_really[i].style.maxHeight=null;
    }
}


var coll = document.getElementsByClassName("md-modal-delete");
var i;
for(i=0; i< coll.length;i++){
    coll[i].addEventListener("click",function () {
       this.classList.toggle("active");
       var content = this.nextElementSibling;
       if(content.style.maxHeight){
           content.style.maxHeight=null;
       }else{
           content.style.maxHeight= content.scrollHeight+ "px";
       }
    });
}

function getID(modal,secmodal) {
    var modal = document.getElementById(modal);
    var report = document.getElementById(secmodal);
    report.setAttribute("post-id",modal.getAttribute("post-id"));
}








