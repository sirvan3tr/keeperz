<!--
================================================================================
Modal - For new database.
================================================================================
-->
<div class="modal fade" id="newdatabase" tabindex="-1" role="dialog" aria-labelledby="newdatabaseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="newdatabaseLabel">Modal title</h2>
      </div>
      <div class="modal-body">
        <form id="newdbform" action="" role="form">
            <input type="hidden" value="<?php echo $person->id ?>" name="user_id">
          <div class="form-group">
            <label for="newdbclient">Title</label>
            <input type="text" class="form-control" id="newdbclient" placeholder="Enter Title of Database" name="title">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="newdatabasebtn" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--
================================================================================
Modal - For new item.
================================================================================
-->
<div class="modal fade" id="newitem" tabindex="-1" role="dialog" aria-labelledby="newdatabaseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="newdatabaseLabel">Modal title</h2>
      </div>
      <div class="modal-body">
        <form id="newitemform" action="" role="form">
            <input type="hidden" value="<?php echo $person->id ?>" name="user_id">
            <input type="hidden" value="" name="folder_id">
          <div class="form-group">
            <label for="newitemtitle">Title</label>
            <input type="text" class="form-control" id="newitemtitle" placeholder="Enter Title of Item" name="title">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="newdatabasebtn" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
