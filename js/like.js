function like(id) {
    var x = document.getElementById("like"+id);
    var y = document.getElementById("countlikes"+id);
    if(x.src.includes("unlike")){
        x.src = x.src.replace("unlike","like");
        var num = parseInt(y.innerText)+1;
        y.innerHTML = num+"";

        $(document).ready(function () {
            $(".like").load(localStorage.getItem("web")+"/php/like.php", {id: id, action: 0});
        });

    }else {
        x.src = x.src.replace("like", "unlike");
        var num = parseInt(y.innerText)-1;
        y.innerHTML = num+"";

        $(document).ready(function () {
            $(".like").load(localStorage.getItem("web")+"/php/like.php", {id: id, action: 1});
        });
    }
}