function follow(id) {
  var className = $(".profile-follow-button").attr('class');
  if(className.endsWith('follow')){
      if(localStorage.getItem('lang')==='en'){
          $('.profile-follow-button').prop('value','Follow');
      }else if(localStorage.getItem('lang')==='sk'){
          $('.profile-follow-button').prop('value','Sledovať');
      }
      $(".profile-follow-button").load(localStorage.getItem("web")+"/php/follow.php", {id: id, action: 0});


      var span =  document.getElementById("profile-stat-item-numbers-followers");
      var number = parseInt(span.innerText)-1;
      span.innerText = number+"";

  }else{
      if(localStorage.getItem('lang')==='en'){
          $('.profile-follow-button').prop('value','Following');
      }else if(localStorage.getItem('lang')==='sk'){
          $('.profile-follow-button').prop('value','Sledované');
      }
      $(".profile-follow-button").load(localStorage.getItem("web")+"/php/follow.php", {id: id, action: 1});

      var span =  document.getElementById("profile-stat-item-numbers-followers");
      var number = parseInt(span.innerText)+1;
      span.innerText = number+"";
  }

  $(".profile-follow-button").toggleClass('follow');


}