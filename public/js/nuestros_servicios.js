$(".lista-serv" ).find('a').hover(function() {
  if($(this).find('i').hasClass('fa-circle-thin')==true)
  {
    $(this).find('i').removeClass('fa-circle-thin');
    $(this).find('i').addClass('fa-circle');
  }
    else {
      $(this).find('i').removeClass('fa-circle');
      $(this).find('i').addClass('fa-circle-thin');
    }
});
function setActive(){
  // Codigo para resaltar url donde se encuentre navegando
  var path = document.location.href;
    $('.lista-serv').find('a').each(function () {
        if (path==$(this).attr('href')) {
          $(this).addClass("rojo");
          $(this).find('i').removeClass('fa-circle-thin');
          $(this).find('i').addClass('fa-circle');
        }
    });
}
window.onload = setActive;

var array=[];
var t,l;
$(".lista-ordenar").each(function(){
 t=$(this).find(".service").html();
 l=$(this).find("a").attr("href");
 var chargeDetails = {
     evento : t,
     link : l
 };
 array.push(chargeDetails);
 // console.log(t);
 // array[0].push("xcvcxv");

});
// console.log("array",array);

  array.sort(function(a, b) {
  var nameA = a.evento.toUpperCase(); // ignore upper and lowercase
  var nameB = b.evento.toUpperCase(); // ignore upper and lowercase
  if (nameA < nameB) {
    return -1;
  }
  if (nameA > nameB) {
    return 1;
  }

  // names must be equal
  return 0;
});
// console.log("array",array);

for(var i=0;i<array.length;i++){
  var x=i+1;
  // console.log();
  $(".lista"+x).find(".service").html(array[i].evento);
  $(".lista"+x).find("a").attr("href",array[i].link);
}
// console.log("array",array);
// console.log("t",t,"array",t);
