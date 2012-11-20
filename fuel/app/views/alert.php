<?php
	echo View::forge('header');
	echo View::forge('navbar');
?>

<div class="in-center">

   <?php if( !isset($alert['type']) ): ?>
      <div class="well">
   <?php elseif( $alert['type'] == 'error' ): ?>
      <div class="alert alert-error">
   <?php elseif( $alert['type'] == 'warning' ): ?>
      <div class="alert">
   <?php elseif( $alert['type'] == 'success' ): ?>
      <div class="alert alert-success">
   <?php elseif( $alert['type'] == 'info' ): ?>
      <div class="alert alert-info">
   <?php else: ?>
      <div class="well">
   <?php endif; ?>


   <?php if( isset($alert['title'] )): ?>
      <h3><?php echo $alert['title']; ?></h3>
   <?php endif; ?>

   <p><?php echo $alert['text']; ?></p>

   <?php if( isset( $alert['return'] ) ): ?>
         <a class="btn" href="<?php echo $alert['return']; ?>">OK</a>
   <?php endif; ?>

   </div>
</div>

<?php
	echo View::forge('footer');

