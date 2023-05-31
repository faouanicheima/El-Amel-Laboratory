<!DOCTYPE html>

<html>
 <?php
 include("inc/connect.php");

 include("inc/functions/webSiteInformations.php");
?>
<head>
 <title><?php echo($nomLabo);?></title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <link rel="stylesheet" type="text/css" href="style/indexStyle.css">
 
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>

</head>

<body>

<?php
include("header.php");
include("slider.php");  
include("questions.php");
include("services.php");
include("footer.php");
?>
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
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});
 </script>
 <script>
  const questions = document.querySelectorAll('.question');
  questions.forEach((question) => {
    question.addEventListener('click', () => {
      const id = question.getAttribute('data-id');
      const answer = document.querySelector(`.answer[data-id="${id}"]`);
      if (answer.style.display === 'none') {
        answer.style.display = 'block';
      } else {
        answer.style.display = 'none';
      }
    });
  });
</script>
</body>
</html>