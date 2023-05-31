<Style>
    .swiper img{
       display: block;
  margin: 0 auto;
    }
    .swiper-button-next{
      color:red
    }
    .swiper-button-prev{
      color:red
    }

</Style>
<BR></BR>
<BR></BR>
<BR></BR>
<div class="container">
 <div class="swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="style/img/slider/1.jpg" alt="" height="300" width="500" /></div>
    <div class="swiper-slide"><img src="style/img/slider/2.jpg" alt="" height="300" width="500" /></div>
     <div class="swiper-slide"><img src="style/img/slider/4.jpg" alt="" height="300" width="500" /></div>
    <div class="swiper-slide"><img src="style/img/slider/3.png" alt="" height="300" width="500" /></div>
  </div>
  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
 <script>
 const swiper = new Swiper('.swiper', {
     autoplay :{
         delay :3000,
         disableOnInteraction : false ,
     } ,
  loop: true,

  pagination: {
    el: '.swiper-pagination',
    clickable : true ,
  },
  navigation: {
    nextEl: '.swiper-button-next ',
    prevEl: '.swiper-button-prev',
  },

});
 </script>
 <BR></BR>
 <BR></BR>
 <BR></BR>
 
