$(window).scroll(function(){
    var scrolledFromTop = $(window).scrollTop() + $(window).height();
    $(".display_scroll").each(function(){
      var distanceFromTop = $(this).offset().top;
      console.log(scrolledFromTop)
      if(scrolledFromTop >= 1000){
        console.log("hello");
        var delaiAnim = $(this).data("delai");
        $(this).delay(delaiAnim).animate({
          top:0,
          opacity:1
        });
      }
   
    });
  });
  var closeButtons = $('.close_window');
  closeButtons.on('click', function() {
    $(this).parent().hide();
  });


  // const bouton = document.getElementById('bouton-entrergroupe');
  //   let compteur = 0;
  //   bouton.addEventListener('click', () => {
  //       compteur++;
  //       console.log(compteur);
  //   });
  //   setInterval(() => {
  //     fetch('/dashboardcompteur')
  //         .then(response => response.json())
  //         .then(data => {
  //             document.getElementById('compteur').innerHTML = data.compteur;
  //         });
  // }, 1000);

  var counterVal = 0;

function incrementClick() {
    updateDisplay(++counterVal);
}


function updateDisplay(val) {
    document.getElementById("counter-label").innerHTML = val;
}
