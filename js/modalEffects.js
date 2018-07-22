$(".md-trigger").click(function () {
	var id= $(this).attr('id');
	var modal = document.getElementById(id);
	document.getElementById(modal.getAttribute("data-modal")).className = document.getElementById(modal.getAttribute("data-modal")).className+ " md-show";
	var close = document.getElementById(modal.getAttribute("data-modal")).querySelector('.md-close');

	var top = window.pageYOffset;
    document.getElementById(modal.getAttribute("data-modal")).setAttribute("post-id",id);
    document.body.style.position = "fixed";
    document.body.style.overflowY = "scroll";
    document.body.style.top = "-"+top;
    localStorage.setItem("top",top+"");


	$(".md-overlay").click(function () {
        var aa = document.getElementById(modal.getAttribute("data-modal"));
        var b = aa.className.split(" ");
        aa.className = b[0]+" "+b[1];
        document.body.style.position = "static";
        document.getElementById('md-modal-really').style.maxHeight=null;
        document.body.style.overflowY = "auto";
        window.scrollTo(0,localStorage.getItem("top"));
    });

	$(close).click(function () {
        var aa = document.getElementById(modal.getAttribute("data-modal"));
        var b = aa.className.split(" ");
        aa.className = b[0]+" "+b[1];
        document.body.style.position = "static";
        document.body.style.overflowY = "auto";
        window.scrollTo(0,localStorage.getItem("top"));
        document.getElementById('md-modal-really').style.maxHeight=null;
    });

});

function close_modal(id) {
    var modal = document.getElementById(id);
    var classmodal = modal.className.split(" ");
    modal.className = classmodal[0]+" "+classmodal[1];
    document.body.style.position = "static";
    document.body.style.overflowY = "auto";
    window.scrollTo(0,localStorage.getItem("top"));
    document.getElementById('md-modal-really').style.maxHeight=null;
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


/*function init() {

		var overlay = document.querySelector( '.md-overlay' );

		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {
			
			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.md-close' );
			function removeModal() {
				//classie.remove( modal, 'md-show' );
                document.body.style.position = "static";
                document.body.style.overflowY = "auto";
				window.scrollTo(0,localStorage.getItem("top"));
				modal.removeEventListener('click',removeModalHandler);
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) );
			}
			el.addEventListener( 'click', function( ev ) {
				//classie.add( modal, 'md-show' );
                var top = window.pageYOffset;
                modal.setAttribute("post-id",ev['explicitOriginalTarget']['id']);
				document.body.style.position = "fixed";
                document.body.style.overflowY = "scroll";
				document.body.style.top = "-"+top;
				localStorage.setItem("top",top+"");
				overlay.removeEventListener( 'click', removeModalHandler);
				overlay.addEventListener( 'click', removeModalHandler);
				modal.addEventListener('click', removeModalHandler);
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();*/







