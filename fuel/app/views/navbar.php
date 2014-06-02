<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
      <a class="brand" href="<?php echo Uri::create('/'); ?>">aniTrace</a>

<?php if( $loggedin == true ): ?>
            <ul class="nav pull-right" >

            <?php if( $user['isAdmin'] == true): ?>
               <li><a href="<?php echo Uri::create('admin/'); ?>">使用者管理</a></li>
            <?php endif; ?>

					<li id="watchable-list" class="">
						<a href="<?php echo uri::create('tracker/'); ?>"><i class="icon-list-ul"></i>動畫清單</a>
					</li>
					<li id="download-list" class="">
						<a href="<?php echo Uri::create('tracker/download/'); ?>"><i class="icon-download-alt"></i>下載清單</a>
					</li>

               <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-user icon-white"></i>
                  <?php echo $user['username']; ?>
                  <i class="caret"></i>
                  </a>

                  <ul class="dropdown-menu">
							<li><a href="<?php echo Uri::create('user/chpassword'); ?>">修改密碼</a></li>
							<li class="divider"></li>
                     <li><a href="<?php echo Uri::create('auth/logout/'); ?>">登出</a></li>
                  </ul>

               </li>
            </ul>

<?php else: ?>
            <ul class="nav pull-right" >
            <li><a href="<?php echo Uri::create('auth/'); ?>">註冊</a></li>
            <li><a href="<?php echo Uri::create('auth/'); ?>">登入</a></li>
            </ul>
<?php endif; ?>
      </div>
   </div>
</div>
