
function setCookie(currency){
  console.log(`Cookie set to ${currency}`);
  urldest = obtainCurrentPath();
  $.ajax({
    url: urldest,
    data: {
      "_token": $("meta[name='csrf-token']").attr("content"),
      "cookie": currency,
    },
    dataType: "json",
    method: "POST",
    success: function(response) {
    console.log("Sent via AJAX");
    //if(urldest != "postcoin"){
      window.location.reload();
    //}  
    },
    error: function () {
      console.log("Error");
    }
  });
}

function getCookieValue(name,currency) {
  const nameString = name + "=";
  //currencyfinal = encodeURIComponent(currency);
  //document.cookie = `selected_currency=${currencyfinal}`;
  //document.cookie = "selected_currency=eur;path=/"
  const value = document.cookie.split(";").filter(item => {
    return item.includes(nameString);
  })
  console.log(value); 
  if (value.length) {
    return value[0].substring(nameString.length, value[0].length);
  } else {
    return "";
  }
}

function obtainCurrentPath(){
  path = window.location.pathname;
  patharr = path.split('/');
  urldest = "default";
  if(patharr[2] == 'coin'){
    urldest = 'postcoin';
  }else if(patharr[2] == 'market'){
    urldest = 'postmarket';
  }
  return urldest;
}

$('#usd,#eur,#gbp,#jpy,#rub,#cad,#aud').click(function(){ setCookie($(this).attr("id")); return false; })
    //console.log("Im here");
    //console.log(document.getElementById('cur-indicator').innerHTML.toLowerCase())
    idHide = document.getElementById('cur-indicator').innerText.toLowerCase();
    //console.log(`#${idHide}`);
    //console.log($(`#${idHide}`).innerText);
    //document.getElementById(``)
    console.log(idHide);
    //console.log(document.getElementById(idHide.toString()).innerText);
    $('#cad_li').hide;
    //$(document.)
    