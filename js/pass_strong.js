var bmpDigits = /[0-9\u0660-\u0669\u06F0-\u06F9\u07C0-\u07C9\u0966-\u096F\u09E6-\u09EF\u0A66-\u0AE6\u0AE6-\u0AEF\u0B66-\u0B6F\u0BE6-\u0BEF\u0C66-\u0C6F\u0CE6-\u0CEF\u0D66-\u0D6F\u0DE6-\u0DEF\u0E50-\u0E59\u0ED0-\u0ED9\u0F20-\u0F29\u1040-\u1049\u1090-\u1099\u17E0-\u17E9\u1810-\u1819\u1946-\u194F\u19D0-\u19D9\u1A80-\u1A89\u1A90-\u1A99\u1B50-\u1B59\u1BB0-\u1BB9\u1C40-\u1C49\u1C50-\u1C59\uA620-\uA629\uA8D0-\uA8D9\uA900-\uA909\uA9D0-\uA9D9\uA9F0-\uA9F9\uAA50-\uAA59\uABF0-\uABF9\uFF10-\uFF19]/;
var hasNumber = RegExp.prototype.test.bind(bmpDigits);
$('#inputPassword').on('input',function () {


    var pass = document.getElementById("inputPassword").value;

    var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    var points=0;
    //nachadza sa male pismeno
    if(pass != pass.toUpperCase()){
        points= points+1;
    }
    //nachadza sa velke pismeno
    if(pass != pass.toLowerCase()){
        points= points+2;
    }
    if(pass.length>=5){
        points++;
    }
    if(pass.length>7){
        points= points+2;
    }
    if(format.test(pass)){
        points= points+2;
    }

    if(hasNumber(pass)){
        points= points+1;
    }
    if(pass.length>=10){
        points= points+4
    }
    if(pass.length>12){
        points= points+3
    }

    var strong = document.getElementById("strong");
    if(points <2){
        strong.innerHTML = "";
    }else if(points >1 && points <6){
        strong.style.color = "red";
        if(localStorage.getItem("lang")=="en"){
            strong.innerHTML = "Very weak";
        }else{
            strong.innerHTML = "Veľmi slabé";
        }
    }else if(points >= 6 && points < 8){
        strong.style.color = "orange";
        if(localStorage.getItem("lang")=="en"){
            strong.innerHTML = "Weak";
        }else{
            strong.innerHTML = "Slabé";
        }
    }else if(points >=8 && points<10){
        strong.style.color = "yellow";
        if(localStorage.getItem("lang")=="en"){
            strong.innerHTML = "Medium";
        }else{
            strong.innerHTML = "Dobré";
        }
    }else if(points > 10){
        strong.style.color = "green";
        if(localStorage.getItem("lang")=="en"){
            strong.innerHTML = "Strong";
        }else{
            strong.innerHTML = "Silné";
        }
    }
});


