<?php
   echo View::forge('header');
   echo View::forge('navbar');
?>
   <p id="list-control">
      <a id="act-add" class="btn btn-primary" href="#dialog-addAni" data-toggle="form-modal"><i class="icon-plus"></i> 新增</a>
   </p>

   <table class="table" id="ani-list">
      <thead>
         <tr>
            <td>動畫</td>
            <td>字幕組</td>
            <td>追蹤進度</td>
            <td></td>
         </tr>
      </thead>

      <tbody>
         <tr id="row-template">
            <td class="col-name">
               <div class="name">${name}</div>
               <div class="link hide"><a href="${link}" target="_blank"><i class="icon-link"></i></a></div>
            </td>
            <td class="col-sub">${sub}</td>
            <td class="col-vol unselectable">
               <div class="vol">${volumn}</div>
               <div class="vol-act">
                  <i class="icon-plus"></i>
                  <i class="icon-minus"></i>
               </div>
            </td>
            <td class="col-act unselectable">
               <i class="act-edit act-icon icon-edit" title="修改" data-toggle="form-modal" data-target="#dialog-edit" data-id=""></i>
               <i class="act-delete act-icon icon-trash" title="刪除"></i>
               <i class="act-icon icon-ok" title="標示為「完結」，閱畢後自動隱藏"></i>
            </td>
         </tr>

      </tbody>
   </table>

   <?php echo View::forge('tracker/dialog'); ?>

   <script type="text/javascript" charset="utf-8">
      var navbarHighlight = 'watchable-list';
   </script>

<?php echo View::forge('footer'); ?>
