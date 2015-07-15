<div id="itemform-con" class="pull-left">
  <form id="itemform" class="form-horizontal" role="form" action="post" type="">
    <input type="hidden" id="itemuserid" name="userid" <?php echo 'value="'.$person->id.'"'; ?> />
    <input type="hidden" id="itemfolderid" name="folderId" value="">
    <div class="form-group">

      <label for="itemtitle" class="col-sm-3 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="itemtitle" placeholder="Title" name="title" value="Title">
      </div>
    </div>
    <div class="form-group">
      <label for="itemusername" class="col-sm-3 control-label">Username</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="itemusername" placeholder="Username" name="username" value="Username">
      </div>
    </div>
    <div class="form-group">
      <label for="itempass" class="col-sm-3 control-label">Password</label>
      <div class="col-sm-9">
        <input type="password" class="form-control" id="itempass" placeholder="Password" name="" value="">
      </div>
    </div>
    <div class="form-group">
      <label for="itempassrepeat" class="col-sm-3 control-label">Password repeat</label>
      <div class="col-sm-9">
        <input type="password" class="form-control" id="itempassrepeat" placeholder="Password" name="" value="">
        <button id="showpasswordbtn" type="button" class="btn btn-default btn-xs">Show Password</button>
        <div class="btn-group dropup">
          <button id="generatepassword" type="button" class="btn btn-default btn-xs">Generate Password</button>
          <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#"><input id="generatepasslength" type="text" /></a></li>
            <li><a href="#">Include numbers</a></li>
          </ul>
        </div>
      </div>
    </div>
    <input id="encrypted_password" type="hidden" name="password" value="0" />
    <div class="form-group">
      <label for="itemurl" class="col-sm-3 control-label"><span class="glyphicon glyphicon-globe"></span> URL</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="itemurl" placeholder="URL" value="URL" name="url">
      </div>
    </div>
    <div class="form-group">
      <label for="itemdesc" class="col-sm-3 control-label" ><span class="glyphicon glyphicon-comment"></span> Description</label>
      <div class="col-sm-9">
        <textarea id="itemdesc" class="form-control" rows="3" name="description">Description</textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button id="itemformsubmit" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Update</button>
        <button id="itemformdelete" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</button>
      </div>
    </div>
    <button id="newentrybtn" type="button" class="btn btn-warning btn-sm pull-right">New Entry</button>
  </form>
</div>
