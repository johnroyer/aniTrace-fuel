<?php
   echo View::forge('header');
   echo View::forge('navbar');
?>

<h2>使用者管理</h2>
<p style="margin-top: 25px;"> </p>

<div class="span6 pull-center alert alert-error">
   <h3>刪除確認</h3>
   <p>你正準備要刪除一個帳號！</p>
   <p>ID: <?php echo $target['id']; ?></p>
   <p>帳號： <?php echo $target['username']; ?></p>
   <p>Email: <?php echo $target['email']; ?></p>
   <p>
      <a class="btn btn-danger" href="<?php echo Uri::create('admin/deleteUser/'.$target['id'].'/confirmed'); ?>">刪除</a>
      <a class="btn" href="<?php echo Uri::create('admin/'); ?>">取消</a>
   </p>
</div>

<?php echo View::forge('footer'); ?>
