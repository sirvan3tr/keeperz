<?php
  require_once('header.php');
  require_once('config.php');
?>
<div class="toggle-bar">Toggle: 
  <span class="togglebarelement toggle-hrs">Toggle hours: <span class="on-off-btn"></span></span>
  <span class="togglebarelement toggle-newtask">Toggle new task: <span class="on-off-btn"></span></span>
  <span class="togglebarelement toggle-actions">Toggle actions: <span class="on-off-btn"></span></span>

  <form class="form-inline HomeDateFilter" role="form">
    <?php
    /*$filterusers = ORM::for_table('users')->select('name')->find_many();*/


    $todaysdate = date('Y-m-d');
    $firstdate = date('Y-m-d', strtotime('-1 day', strtotime($todaysdate)));
    $seconddate = date('Y-m-d', strtotime('+11 day', strtotime($todaysdate)));
    echo '<input id="firstdate" type="text" placeholder="From y-m-d" value="'.$firstdate.'" class="input-sm form-control "> ';
    echo '<input id="seconddate" type="text" placeholder="To y-m-d" value="'.$seconddate.'" class="input-sm form-control"> ';
    /*
    echo '<select>
            <option>All users</option>';
    foreach ($filterusers as $filterusers) {
      echo '<option>'.htmlspecialchars($filterusers->name).'</option>';
    }
    echo '</select> ';
    */
    ?>
    <button id="date_btn" class="btn btn-default btn-sm" type="button">Filter</button>
  </form>
	<?php
		if(isset($_SESSION['user_id'])){
			$person = ORM::for_table('users')->find_one($_SESSION['user_id']);
			if ($person->ability=="architect" || $person->ability=="oracle") {
			  echo '<button href="#taskAdditionModal" id="batch_add_btn" class="btn btn-sm btn-primary" type="button"  data-toggle="modal">Batch Add</button> ';
			  echo '<button id="batch_delete_btn" class="btn btn-sm btn-primary" type="button">Batch Delete</button>';
			}
		}
	?>

</div>
    <div class="container-fluid">
      <div class="row-fluid">
       
        <div class="span12">
          <!--Body content-->
          <div id="taskAdditionModal" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 id="myModalLabel">Add a new task</h3>
                </div>
                <div class="modal-body">
                  <form role="form" id="newtaskform">
                    <div class="form-group">
                      <label><b>Insert number of hours:</b></label>
                      <input class="allocated-hours form-control" type="text" placeholder="0.00">
                    </div>

                    <div class="">
                      <div class="form-group">
                        <select class="selected-task form-control">
                          <?php
                        $modaltasks = ORM::for_table('tasks')->select('id')->select('project_name')->find_many();
                        foreach ($modaltasks as $modaltasks) {
                        echo '<option taskid="'.htmlspecialchars($modaltasks->id).'">'.htmlspecialchars($modaltasks->project_name).'</option>';
                        }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <select class="selected-skill-type form-control">
                          <?php
                        $taskaddSkill = ORM::for_table('skill_type')->select('id')->select('skill')->select('skill_full')->find_many();
                        foreach ($taskaddSkill as $taskaddSkill) {
                        echo '<option skillid="'.htmlspecialchars($taskaddSkill->id).'">['.htmlspecialchars($taskaddSkill->skill).'] '.htmlspecialchars($taskaddSkill->skill_full).'</option>';
                        }
                          ?>
                        </select>
                      </div>
                      <textarea class="task-comment form-control" placeholder="Insert your comment here..."></textarea>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <img id="modalloader" src="img/ajax-loader.gif" />
                  <button type="button" class="btn btn-primary newtask">Save changes</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
              <div id="msg"></div>
        </div><!-- /span12 -->
      </div>
    </div>
<script>
  jQuery(function ($) {
  $('#firstdate').datepicker({
  format: 'yyyy-mm-dd'
  });
  $('#seconddate').datepicker({
  format: 'yyyy-mm-dd'
  });

  $.ajaxSetup({ cache: false });
  var dateajax = function() {
    firstdate = $("#firstdate").val();
    seconddate = $("#seconddate").val();

    //Ajax function
    $.ajax({ url: 'date_script.php',
      data: {firstdate: firstdate, seconddate: seconddate},
      type: 'post',
      beforeSend: function(){
        $("#loading").show();
      },
      success: function(data) {
        $("#loading").hide();
        $("#msg").html(data);


      }, // Success function
    }).done(function(data){

        // Toggle Task Details
        $(document).on('click', ".tasks", function () {
          $(this).find('.matrixdetails').toggle('fast', function() {
          // Animation complete.
          });
        }); // End of task details click

                      $( document )
                        .drag("start",function( ev, dd ){
                          return $('<div class="selection" />')
                          .css('opacity', .65 )
                          .appendTo( document.body );
                        })
                        .drag(function( ev, dd ){
                        $( dd.proxy ).css({
                          top: Math.min( ev.pageY, dd.startY ),
                          left: Math.min( ev.pageX, dd.startX ),
                          height: Math.abs( ev.pageY - dd.startY ),
                          width: Math.abs( ev.pageX - dd.startX )
                        });
                        })
                        .drag("end",function( ev, dd ){
                          $( dd.proxy ).remove();
                        });
                        $('.alltasks')
                        .drop("start",function(){
                          $( this ).addClass("active");
                        })
                        .drop(function( ev, dd ){
                          $( this ).toggleClass("dropped");
                        })
                        .drop("end",function(){
                          $( this ).removeClass("active");
                        });
                        $.drop({ multi: true });

                        //Toggle Hours
                        /*
                        $('.toggle-hrs').show();
                          $('.toggle-hrs').toggle(function() {
                            alert('First handler for .toggle() called.');
                          }, function() {
                            alert('Second handler for .toggle() called.');
                          });
*/
                        $(".toggle-hrs").click(function () {
                          $(".totalend").toggle();
                          $(this).find(".on-off-btn").toggleClass("on-off-btnOFF");
                        });

                        $(".toggle-newtask").click(function () {
                          $(".task-addition").toggle();
                          $(this).find(".on-off-btn").toggleClass("on-off-btnOFF");
                        });
                        $(".toggle-actions").click(function () {
                          $(".actions").toggle();
                          $(this).find(".on-off-btn").toggleClass("on-off-btnOFF");
                        });


                        $(document).on("click", ".taskstatusA", function (e) {
                          e.stopPropagation();
                          var date = $(this).parent().closest("td").attr("date");
                          var workinghrs = $(this).parent().closest("td").attr("workinghrs");
                          var userid = $(this).parent().closest("td").attr("userid");
                          var taskid = $(this).attr("taskid");

                          var checkboxupdate = function() {
                                //Ajax function
                                $.ajax({ url: 'update_rep_status.php',
                                  data: {taskid: taskid, status: status},
                                  type: 'post',
                                  beforeSend: function(){
                                    $("#loading").show();
                                  },
                                  success: function(data) {
                                    alert(data);
                                    $("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                                    $("#loading").hide();
                                  }, // Success function
                                })
                          }
                          if($(this).hasClass("taskstatusComplete")) {
                            $(this).removeClass("taskstatusComplete");
                            var status = 0;
                            checkboxupdate();
                          } else {
                            $(this).addClass("taskstatusComplete");
                            var status = 1;
                            checkboxupdate();
                          }
                        });


	                      $(document).on('click', ".removetask", function () {
                            taskid = $(this).attr('taskid');
                            userid = $(this).attr('userid');
                            date = $(this).attr('date');
                            var workinghrs = $(this).parent().closest("td").attr("workinghrs");

                            //Ajax function
                            $.ajax({ url: 'remove_task.php',
                                type: 'post',
                                data: {taskid: taskid},
                                 beforeSend: function ( xhr ) {
                                xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                },
                                success: function(data) {
                                    alert(data);
                                    $("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                                },
                                error: function (data) {
                                    alert("There was an error. Image could not be added, please try again");
                                } // Success function
                            }); // Ajax Function
                          }) //removetask click fn
						  
                        $(document).on("click", ".task-addition", function () {
                          $('#taskAdditionModal').modal('show');
                          var userid = $(this).attr('userid');
                          var date = $(this).attr('date');
                          var workinghrs = $(this).parent().closest("td").attr("workinghrs");

                          $(".newtask").unbind('click').click(function() {

                            var hours = $("#newtaskform").find('.allocated-hours').val();
                            var comment = $("#newtaskform").find('.task-comment').val();

                            var task = $("#newtaskform").find('.selected-task');
                            var taskid = $("option:selected", task).attr("taskid");

                            var skill = $("#newtaskform").find('.selected-skill-type');
                            var skillid = $("option:selected", skill).attr("skillid"); 

                            //Ajax function
                            var request = $.ajax({ url: 'new_task_script.php',
                                type: 'post',
                                data: {hours: hours, comment: comment, taskid: taskid, userid: userid, date: date, skillid: skillid},
                                beforeSend: function(){
                                    $("#modalloader").show();
                                },
                                success: function(e) {
                                    $("#modalloader").hide();
                                    $('#taskAdditionModal').modal('hide')
                                    $("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                                },
                                error: function (e) {
                                    alert("There was an error. Image could not be added, please try again");
                                } // Success function
                            }); // Ajax Function
                          }) // Click fn

                        }) // Click fn

                        ////////////////////////////////////////////////////////////////////////////////////////////////////
                        $(document).on("click", "#batch_add_btn", function () {
                          $(".newtask").unbind('click').click(function() {
                            var hours = $("#newtaskform").find('.allocated-hours').val();
                            var comment = $("#newtaskform").find('.task-comment').val();

                            var task = $("#newtaskform").find('.selected-task');
                            var taskid = $("option:selected", task).attr("taskid");

                            var skill = $("#newtaskform").find('.selected-skill-type');
                            var skillid = $("option:selected", skill).attr("skillid"); 

                            $(".dropped").each(function() {
                              var date = $(this).attr("date");
                              var userid = $(this).attr("userid");
                              var workinghrs = $(this).attr("workinghrs");

                              //Ajax function
                              var request = $.ajax({ url: 'new_task_script.php',
                                  type: 'post',
                                  data: {hours: hours, comment: comment, taskid: taskid, userid: userid, date: date, skillid: skillid},
                                  beforeSend: function(){
                                      $("#modalloader").show();
                                  },
                                  success: function(e) {
                                      $("#modalloader").hide();
                                      $('#taskAdditionModal').modal('hide')
                                      $("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                                  },
                                  error: function (e) {
                                      alert("There was an error. Image could not be added, please try again");
                                  } // Success function
                              }); // Ajax Function

                            }) // each function
                          }) // Click fn

                        }) //batch add click fn
                        //end--//////////////////////////////////////////////////////////////////////////////////////////////////
                         $(document).on('click', "#batch_delete_btn", function () {
                            $(".dropped").each(function() {
                              var userid = $(this).attr('userid');
                              var date = $(this).attr('date');
                              var workinghrs = $(this).attr("workinghrs");

                              $(this).find(".tasks").each(function() {
                                var taskid = $(this).attr("taskid");
                               
                              
                              
                                //Ajax function
                                $.ajax({ url: 'remove_task.php',
                                    type: 'post',
                                    data: {taskid: taskid},
                                     beforeSend: function ( xhr ) {
                                    xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                    },
                                    success: function(data) {
                                        alert(data);
                                        $("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                                    },
                                    error: function (data) {
                                        alert("There was an error. Image could not be added, please try again");
                                    } // Success function
                                }); // Ajax Function
                              })
                            })
                          }) //removetask click fn
                        //end--//////////////////////////////////////////////////////////////////////////////////////////////////
    });
  }

    dateajax();

  $("#date_btn").click(function(){
    dateajax();
  });

  });
</script>
<?php
include('footer.php');
?>