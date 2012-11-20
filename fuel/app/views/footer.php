</div>

<script type="text/javascript" charset="utf-8">
   var site_url = '<?php echo Uri::base(true); ?>';
</script>

<?php
   echo Asset::js('jquery-1.8.0.min.js');
   echo Asset::js('jquery.validate.min.js');
   echo Asset::js('jquery.tmpl.min.js');
   echo Asset::js('bootstrap.min.js');

   echo Asset::js('admin.js');
   echo Asset::js('user.form.js');
   echo Asset::js('ani.js');
   echo Asset::js('common.js');
?>
</body>
</html>
