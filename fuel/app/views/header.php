<!doctype html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />

      <!-- Refresh every 1 hour -->
      <?php if( $loggedin == true ): ?>
         <meta http-equiv="refresh" content="3600" />
      <?php endif; ?>

      <title>aniTrace</title>

      <?php
         echo Asset::css('bootstrap.min.css');
         echo Asset::css('font-awesome.css');
         echo Asset::css('style.css');
      ?>
   </head>
   <body>

   <div  class="container">
