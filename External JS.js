//^ Home Trending Post Carousel
$('#TrendPost').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: false,
  arrows: true,
  nextArrow: $('.next'),
  prevArrow: $('.prev'),
  autoplay: true,
  autoplaySpeed: 3000,
});

//^ Home Recipes Carousel
$("#RecipeWrapper").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1000,
  nextArrow: $('#ArrowNext'),
  prevArrow: $('#ArrowPrev'),
});

if ( $( "#ClassBrowse" ).length ) { 
  //^ Class - Browse carousel
  $('.post-wrapper').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
  });
}

$('.menu-toggle').on('click', function(){
  $('.nav').toggleClass('showing');
  $('.nav ul').toggleClass('showing');
});