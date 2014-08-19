<div id="itemform-con" class="pull-left">
  <form id="itemform" class="form-horizontal" role="form">
    <div class="form-group">
      <label for="itemtitle" class="col-sm-3 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="itemtitle" placeholder="Title" name="title" value="tech login details for rbx">
      </div>
    </div>
    <div class="form-group">
      <label for="itemusername" class="col-sm-3 control-label">Username</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="itemusername" placeholder="Username" name="username" value="tech@rockaboxmedia.com">
      </div>
    </div>
    <div class="form-group">
      <label for="itempass" class="col-sm-3 control-label">Password</label>
      <div class="col-sm-9">
        <input type="password" class="form-control" id="itempass" placeholder="Password" name="password" value="helloworld">
      </div>
    </div>
    <div class="form-group">
      <label for="itempassrepeat" class="col-sm-3 control-label">Password repeat</label>
      <div class="col-sm-9">
        <input type="password" class="form-control" id="itempassrepeat" placeholder="Password" name="passrepeat" value="helloworld">
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
    <div class="form-group">
      <label for="itemurl" class="col-sm-3 control-label"><span class="glyphicon glyphicon-globe"></span> URL</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="itemurl" placeholder="URL" value="http://rbx.rockabox.com">
      </div>
    </div>
    <div class="form-group">
      <label for="itemdesc" class="col-sm-3 control-label" name="description"><span class="glyphicon glyphicon-comment"></span> Description</label>
      <div class="col-sm-9">
        <textarea id="itemdesc" class="form-control" rows="3">Rockabox is a platform. A platform. massive platforms
        </textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button id="itemformsubmit" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-floppy-disk"></span> Update</button>
      </div>
    </div>
  </form>
</div>
