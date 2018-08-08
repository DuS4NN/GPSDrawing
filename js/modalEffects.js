$(document).on('click','.md-trigger',function () {
	var id= $(this).attr('id');
	if(id.startsWith("report")) {
	    if(id.endsWith("user")){
            var modal = document.getElementById("modal-report-user");
            modal.className = modal.className + " md-show";
            var close = modal.querySelector(".md-close");
        }else{
            var modal = document.getElementById("modal-report");
            modal.className = modal.className + " md-show";
            var close = modal.querySelector(".md-close");
        }


    }else if(id.startsWith("md-edit")){
        var modal = document.getElementById("modal-edit");
        modal.className = modal.className + " md-show";
        var text = document.getElementById("post-description-"+modal.getAttribute("post-id")).innerText;
        document.getElementById("md-modal-edit-input").value = text;
        var close = modal.querySelector(".md-close");

    }else{
        var modal = document.getElementById(id);
        document.getElementById(modal.getAttribute("data-modal")).className = document.getElementById(modal.getAttribute("data-modal")).className+ " md-show";
        var close = document.getElementById(modal.getAttribute("data-modal")).querySelector('.md-close');
        document.getElementById(modal.getAttribute("data-modal")).setAttribute("post-id",id);
    }

	var top = window.pageYOffset;
    document.body.style.position = "fixed";
    //document.body.style.overflowY = "scroll";
    document.body.style.top = "-"+top;
    localStorage.setItem("top",top+"");


	$(".md-overlay").click(function () {
	    if(id.startsWith("report")){
	        var b = modal.className.split(" ");
	        modal.className = b[0]+" "+b[1];
        }else if(id.startsWith("md-edit")) {
            var b = modal.className.split(" ");
            modal.className = b[0]+" "+b[1];
        }else{
            var aa = document.getElementById(modal.getAttribute("data-modal"));
            var b = aa.className.split(" ");
            aa.className = b[0]+" "+b[1];
        }

        document.body.style.position = "static";
        document.body.style.top = null;
        document.getElementsByClassName('md-modal-really')[0].style.maxHeight=null;
        document.getElementsByClassName('md-modal-really')[1].style.maxHeight=null;
        //document.body.style.overflowY = "auto";
        window.scrollTo(0,localStorage.getItem("top"));
    });

	$(close).click(function () {
        if(id.startsWith("report")) {
            var b = modal.className.split(" ");
            modal.className = b[0] + " " + b[1];
        }else if(id.startsWith("md-edit")){
            var b = modal.className.split(" ");
            modal.className = b[0] + " " + b[1];
        }else{
            var aa = document.getElementById(modal.getAttribute("data-modal"));
            var b = aa.className.split(" ");
            aa.className = b[0]+" "+b[1];
        }

        document.body.style.position = "static";
        document.body.style.top = null;
        //document.body.style.overflowY = "auto";
        window.scrollTo(0,localStorage.getItem("top"));
        document.getElementsByClassName('md-modal-really')[0].style.maxHeight=null;
        document.getElementsByClassName('md-modal-really')[1].style.maxHeight=null;
    });

});

function close_modal(id) {
    var modal = document.getElementById(id);
    var classmodal = modal.className.split(" ");
    modal.className = classmodal[0]+" "+classmodal[1];
    document.body.style.position = "static";
    document.body.style.top = null;
    //document.body.style.overflowY = "auto";
    window.scrollTo(0,localStorage.getItem("top"));
    document.getElementsByClassName('md-modal-really')[0].style.maxHeight=null;
    document.getElementsByClassName('md-modal-really')[1].style.maxHeight=null;
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








