<?php
   echo View::forge('header');
   echo View::forge('navbar');
?>

<div class="in-center">

   <?php if( !isset($dialog['type']) ): ?>
      <div class="well">
   <?php elseif( $dialog['type'] == 'error' ): ?>
      <div class="alert alert-error">
   <?php elseif( $dialog['type'] == 'warning' ): ?>
      <div class="alert">
   <?php elseif( $dialog['type'] == 'success' ): ?>
      <div class="alert alert-success">
   <?php elseif( $dialog['type'] == 'info' ): ?>
      <div class="alert alert-info">
   <?php else: ?>
      <div class="well">
   <?php endif; ?>


   <?php if( isset($dialog['title'] )): ?>
      <h3><?php echo $dialog['title']; ?></h3>
   <?php endif; ?>

   <p><?php echo $dialog['text']; ?></p>

   <?php if( isset( $dialog['next'] ) ): ?>
      <a class="btn" href="<?php echo $dialog['next']; ?>"><?php echo $dialog['next_hint']; ?></a>
   <?php endif; ?>

   </div>
</div>

<?php echo View::forge('footer'); ?>
