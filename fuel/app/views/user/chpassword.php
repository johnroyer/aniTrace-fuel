<?php
	echo View::forge('header');
	echo View::forge('navbar');
?>

<h2>修改密碼</h2>
<p> </p>
<form class="form-horizontal">
   <div class="control-group">
      <label class="control-label" for="">原密碼：</label>
      <div class="controls">
         <input type="password" id="origPassword" name="origPassword">
      </div>
   </div>

   <div class="control-group">
      <label class="control-label" for="">新密碼：</label>
      <div class="controls">
         <input type="password" id="password" name="password">
      </div>
   </div>

   <div class="control-group">
      <label class="control-label" for="">密碼確認：</label>
      <div class="controls">
         <input type="password" id="passwordConfirm" name="passwordConfirm">
      </div>
   </div>

   <div class="control-group">
      <div class="controls">
         <button class="btn btn-primary" type="submit">修改密碼</button>
      </div>
   </div>
</form>

<?php
	echo View::forge('footer');

