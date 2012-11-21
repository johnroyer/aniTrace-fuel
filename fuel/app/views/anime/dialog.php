   <div id="dialog-addAni" class="modal hide fade">
      <h3>新增動畫</h3>

      <form class="well form-horizontal" action="#" method="post">
         <div class="control-group">
            <label class="control-label" for="name">動畫名稱</label>
            <div class="controls">
               <input type="text" name="name" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">相關網址</label>
            <div class="controls">
               <input type="text" name="link" value="" placeholder="http://">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">字幕組</label>
            <div class="controls">
               <input type="text" name="sub" value="">
            </div>
         </div>

         <div class="form-actions">
            <a class="btn btn-primary" href="#" id="submit-new-animation">新增</a>
            <a class="btn" href="#" data-dismiss="modal" aria-hidden="true">取消</a>
         </div>

      </form>
   </div>

   <div id="dialog-edit" class="modal hide fade">
      <h3>修改</h3>

      <form class="well form-horizontal" action="#" method="post">
         <div class="control-group">
            <label class="control-label" for="name">動畫名稱</label>
            <div class="controls">
               <input type="text" id="ani-name" name="name" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">相關網址</label>
            <div class="controls">
               <input type="text" id="ani-link" name="link" value="" placeholder="http://">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">字幕組</label>
            <div class="controls">
               <input type="text" id="ani-sub" name="sub" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">集數</label>
            <div class="controls">
               <input type="text" id="ani-vol" name="vol" value="">
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="sub">購入集數</label>
            <div class="controls">
               <input type="text" id="ani-buy" name="buy" value="">
            </div>
         </div>

         <div class="form-actions">
            <a class="btn btn-primary" id="submit-animation-change" href="#">修改</a>
            <a class="btn" href="#" data-dismiss="modal" aria-hidden="true">取消</a>
         </div>
      </form>
   </div>
