<?php
    $ptitle = "Homepage";
    include("includes/header.php");
    include("includes/modals.php");
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-success">
            <div class="panel-heading">Your Passwords</div>
            <div id="itemsreload_con" class="panel-body">
                <?php
                    $db = ORM::for_table('client')->find_many();
                    foreach ($db as $dbs) {
                            echo '<div class="dbparent" dbid="'.$dbs->id.'"><span class="glyphicon glyphicon-chevron-right"></span> '.$dbs->name.'</div>';
                            echo '<div id="clientid-'.$dbs->id.'" class="dbcontainer" dbid="'.$dbs->name.'">';
                            $folders = ORM::for_table('folder')->where('client_id', $dbs->id)->find_many();
                            echo '<ul>';
                            foreach ($folders as $folder) {
                                echo '<li class="folderitem" folderid="'.$folder->id.'"><span class="folderitemspan"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;'.$folder->name.'</span> <span class="newentryplusbtn glyphicon glyphicon-plus fr"></span></li>';
                                $items = ORM::for_table('item')->where('folder_id', $folder->id)->find_many();
                                echo '<ul>';
                                foreach ($items as $item) {
                                    echo '<li class="anitem" itemid="'.$item->id.'"><img src="static/img/key_icon.png" /> '.$item->name.'<span class="glyphicon glyphicon-chevron-right"></span></li>';
                                }
                                echo '</ul>';
                            }
                            echo '</ul>';
                            echo '<a class="fr newfolderbutton" dbid="'.$dbs->id.'">> New folder</a><div class="clear"></div>';
                            echo '</div>';
                    }

                ?>
            </div><!-- /panel-body -->
        </div><!-- /panel panel-success -->
    </div>
    <div class="col-md-6">
        <div class="panel panel-default formpanel_parent">
          <div class="panel-heading">Password Details<div class="pass-author-top fr">Created by: name surname</div></div>
          <div class="panel-body">
        <?php include('includes/form.php') ?>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">Logs</div>
          <div class="panel-body">
        </div>
        </div>
    </div>
</div><!-- /row -->
<div class="row">
    <style type="text/css">
        #passwordhint {
            position: relative;
            height: 239px;
            width: 276px;
            margin: 0 auto;
        }
        #passwordhint .pwdhint-activeclass {
            border-color: #A2A2A2!important;
        }
        #passwordhint .passwordhint-item {
            position: absolute;
            border-color: #E6E6E6;
            border-style: solid;
            border-width:0;
        }

        #passwordhint .pswhint-lshape {
            width: 100px;
            height: 75px;
            border-left-width: 25px;
            border-bottom-width: 25px;
        }
        #passwordhint .pswhint-rotlshape {
            width: 100px;
            height: 75px;
            border-right-width: 25px;
            border-top-width: 25px;
        }
        #passwordhint .pswhint-rotlshapedeux {
            width: 100px;
            height: 75px;
            border-left-width: 25px;
            border-top-width: 25px;
        }
        #passwordhint .pswhint-rothorlshape {
            width: 100px;
            height: 75px;
            border-right-width: 25px;
            border-bottom-width: 25px;
        }

        #passwordhint .pswhint-longshape {
            width: 100px;
            height: 25px;
            //background-color: #ccc;
            border-top-width: 25px;
        }

        #passwordhint #pswhint-un {
            //top: 25px;
        }

        #passwordhint #pswhint-deux {
            left: 50px;
        }

        #passwordhint #pswhint-trois {
            left: 175px;
        }

        #passwordhint #pswhint-quatre {
            top: 50px;
            left: 125px;
        }

        #passwordhint #pswhint-cinq {
            left: 175px;
            top:100px;
        }
        #passwordhint #pswhint-six {
            left: 0;
            top:100px;
        }
        #passwordhint #pswhint-sept {
            left: 0;
            top:150px;
        }
        #passwordhint #pswhint-huit {
            left: 125px;
            top:150px;
        }
        #passwordhint #pswhint-neuf {
            left: 175px;
            top:200px;
        }
    </style>

    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="decryptionkeymodal" tabindex="-1" role="dialog" aria-labelledby="decryptionkeymodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="decryptionkeymodalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div id="passwordhint">
            <div class="passwordhint-item pswhint-lshape" id="pswhint-un"></div>
            <div class="passwordhint-item pswhint-longshape" id="pswhint-deux"></div>
            <div class="passwordhint-item pswhint-rotlshape" id="pswhint-trois"></div>
            <div class="passwordhint-item pswhint-rotlshapedeux" id="pswhint-quatre"></div>
            <div class="passwordhint-item pswhint-rotlshape" id="pswhint-cinq"></div>
            <div class="passwordhint-item pswhint-rotlshapedeux" id="pswhint-six"></div>
            <div class="passwordhint-item pswhint-rothorlshape" id="pswhint-sept"></div>
            <div class="passwordhint-item pswhint-rotlshapedeux" id="pswhint-huit"></div>
            <div class="passwordhint-item pswhint-longshape" id="pswhint-neuf"></div>
        </div>
          <div class="form-group">
            <input type="password" class="form-control" id="entersecurepassword" placeholder="Enter Your Password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="entersecurekey" placeholder="Enter Secure Key">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



</div>

<script type="text/javascript" src="static/js/javascripts/pidcrypt_util.js"></script>
<script type="text/javascript" src="static/js/javascripts/pidcrypt.js"></script>
<script type="text/javascript" src="static/js/javascripts/md5.js"></script>
<script type="text/javascript" src="static/js/javascripts/aes_core.js"></script>
<script type="text/javascript" src="static/js/javascripts/aes_cbc.js"></script>

<script src="static/js/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function() {
    // select the first client folder
    $('#itemsreload_con div.dbparent').first().addClass('dbparent-selected');

    $(document).on('click', '.newfolderbutton', function(e) {
      var dbid = $(this).attr('dbid');
      var userid = <?php echo $person->id; ?>;
      var foldername = prompt("Enter new folder name:");
      if (foldername != null) {
        $.ajax({ url: 'scripts/newfolder.php',
            type: 'post',
            data: {foldername: foldername, clientid: dbid, userid: userid},
            success: function(data) {
                alert('New folder created.');
                itemsreload();
            },
            error: function (data) {
                alert("Sorry an error occured.");
            } // Success function
        }); // Ajax Function
      }
    });
    function itemsreload() {
        $.get( "includes/itemsreload.php", function( data ) {
          $( "#itemsreload_con" ).html( data );
          alert( "Success." );
        });
    }
    function encrypt(pass, key) {
        var aes = new pidCrypt.AES.CBC();
        return crypted = aes.encryptText(pass, key, {nBits: 256});
    }

    function decrypt(pass, key) {
        var aes = new pidCrypt.AES.CBC();
        return plain = aes.decryptText(pass, key, {nBits: 256});
    }
    function encryptionProcess(key) {
      var passfield = $('#itempass');
      var pass = passfield.val();
      passfield.val(decrypt(pass, key));
    }

    $('#decryptionkey').click(function() {
      key = prompt("Please enter the secure key.");
      if (key !== '') {
        encryptionProcess(key);
      }
    })
    var xxpass = 'mysecurepassword'; //delete
    //pidCrypt.MD5();
    //console.log(decrypt('U2FsdGVkX199Sa08BIU6iGF8Ki+6H5pciCuBjH4V/QU=', key));
    var sirvanspass = 'U2FsdGVkX19DgMssSz1O5vhYgB+XHjEM1TJHrwfFycTr8np18HnCsTLhDcGK5HCs';


        var secretkeygraphic = ['#pswhint-un','#pswhint-deux','#pswhint-trois', '#pswhint-quatre', '#pswhint-cinq', '#pswhint-six', '#pswhint-sept', '#pswhint-huit', '#pswhint-neuf'];
        $("#entersecurekey").keyup(function() {
            $('.passwordhint-item').removeClass('pwdhint-activeclass');
            var key = $(this).val();
            var enteredsecurepass = $('#entersecurepassword').val();

            var decryptpass = decrypt(sirvanspass, key);

            if(decryptpass==enteredsecurepass) {
                $('.passwordhint-item').addClass('pwdhint-activeclass');
            } else {
                // failed key
                var numbers = [];
                var i = 0;
                while (i < 3) {
                    var rand = Math.ceil(Math.random() * 10);
                    if ($.inArray(rand, numbers)==-1) {
                        // number not in inArray
                        $(secretkeygraphic[rand-1]).addClass('pwdhint-activeclass');

                        numbers.push(rand);
                        i++;
                    }
                } // end of while
            }
        });


    //console.log(encrypt("my secure password", key));

    $(document).on('click', '#itemformsubmit', function(e) {
        var form = $(itemform),
            data = form.serialize();
        if (confirm("You've made changes, do you wish to still continue?") == true) {

        } else {

        }
    });
    $(document).on('click', '#itemformdelete', function(e) {
        e.preventDefault();
        var itemid = $(this).attr('itemid');
        if (confirm("Are you sure you want to delete this item?") == true) {
          $.ajax({ url: 'scripts/deleteitem.php',
              type: 'post',
              data: {itemid: itemid},
              success: function(data) {
                  alert('Item successfuly deleted');
                  itemsreload();
              },
              error: function (data) {
                  alert("Sorry an error occured.");
              } // Success function
          }); // Ajax Function
        }
    });

    $(document).on('click', '.folderitemspan', function() {
        $(this).parent().next().slideToggle('fast');
    });
    $(document).on('click', '#generatepassword', function(e) {
        var password = generatePassword(12);
        $('#itempassrepeat').val(password);
        $('#itempass').val(password);
    });

    //decrypt("my secure password", "crM753MmD6WQqp9TPgjTu9LAy1uMm8HqBgUe47F7wfM=");
        function generatePassword(length) {
            var charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                retVal = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            return retVal;
        }

        var s = 0;
        $(document).on('click', '#showpasswordbtn', function(e) {
            if (s==0) {
                s = 1;
                $('#itempassrepeat').attr('type', 'text');
                $('#itempass').attr('type', 'text');
                $(this).html('Hide Passwords');
            } else {
                s = 0;
                $('#itempassrepeat').attr('type', 'password');
                $('#itempass').attr('type', 'password');
                $(this).html('Show Passwords');
            }
        });

        $(document).on('click', '.newentryplusbtn', function(e) {
            e.preventDefault();
            for(i=0;i<2;i++) {
              $('.formpanel_parent').fadeTo('fast', 0.1).fadeTo('fast', 1.0);
            }
            $('#itemtitle').focus();
            var folderid = $(this).parent().attr('folderid'),
                userid = $('#itemuserid').val(),
                form = $('#itemform');
            form.find('input').val('');
            form.find('textarea').val('');
            $('#itemfolderid').val(parseInt(folderid));
            $('#itemuserid').val(userid);
        });

        function newentryValidation() {
            var errors = [];
            if ($('#itemtitle').val()=='') {
                $('#itemtitle').addClass('has-error');
                errors.push(1);
            }
            if ($('#itemusername').val()=='') {
                $('#itemusername').addClass('has-error');
                errors.push(1);
            }
            if ($('#itempass').val()=='') {
                $('#itempass').addClass('has-error');
                errors.push(1);
            }
            if ($('#itempassrepeat').val()=='') {
                $('#itempassrepeat').addClass('has-error');
                errors.push(1);
            }
            var pass = $('#itempass').val();
            var passrepeat = $('#itempassrepeat').val();
            if (pass !== passrepeat) {
                $('#itempassrepeat').addClass('has-error');
                alert('Passwords do not match.');
                errors.push(1);
            }
            if ($('#itemurl').val()=='') {
                $('#itemurl').addClass('has-error');
                errors.push(1);
            }
            if ($('#itemdesc').val()=='') {
                $('#itemdesc').addClass('has-error');
                errors.push(1);
            }
            if (errors.length>0) {
                return false
            } else {
                return true;
            }
        }
        $(document).on('click', '#newentrybtn', function(e) {
                e.preventDefault();

            if (newentryValidation()) {
                var pass = $('#itempass').val();
                var encryptedpass = encrypt(pass, key);
                $('#encrypted_password').val(encryptedpass);

                var form = $('#itemform');
                var data = form.serialize();

                $.ajax({ url: 'scripts/newentry.php',
                    type: 'post',
                    data: data,
                    beforeSend: function ( xhr ) {
                        xhr.overrideMimeType("text/plain; charset=x-user-defined");
                    },
                    success: function(data) {
                        itemsreload();
                        //$("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                    },
                    error: function (data) {
                        alert("There was an error. Image could not be added, please try again");
                    } // Success function
                }); // Ajax Function
            } else {
              alert("errors");
            }


        });

        $(document).on('click', "#newdatabasebtn", function (e) {
            e.preventDefault();
            var data = $("#newdbform").serialize();
            $.ajax({ url: 'scripts/newdb.php',
                type: 'post',
                data: data,
                 beforeSend: function ( xhr ) {
                xhr.overrideMimeType("text/plain; charset=x-user-defined");
                },
                success: function(data) {
                    //$("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
                },
                error: function (data) {
                    alert("There was an error. Image could not be added, please try again");
                } // Success function
            }); // Ajax Function
        });
        // ^ end of newdatabasebtn click function
        // show the first folder.
        $('.dbcontainer:first').show();
        // Clicking on a database/client
        $(document).on('click', ".dbparent", function (e) {
            var dbid = $(this).attr('dbid');
            $('.dbcontainer').slideUp('fast');
            $('#clientid-'+dbid).slideDown('fast');
            $('.dbparent').removeClass('dbparent-selected');
            $(this).addClass('dbparent-selected');

            $('.dbparent').find('span').removeClass('glyphicon-chevron-down');
            $('.dbparent').find('span').addClass('glyphicon-chevron-right');
            $(this).find('span').removeClass('glyphicon-chevron-right');
            $(this).find('span').addClass('glyphicon-chevron-down')
        });
        // ^ end of click function
        $(document).on('click', ".anitem", function (e) {
            var itemid = $(this).attr('itemid');
            $.ajax({ url: 'scripts/getitem.php',
                type: 'post',
                data: {itemid: itemid},
                success: function(data) {
                    var data = JSON.parse(data);
                    $('#itemform').slideUp("fast");
                    $('#itemfolderid').val(data.folderid);
                    $('#itemtitle').val(data.name);
                    $('#itemusername').val(data.username);
                    $('#itempass').val(data.pass);
                    if (key !== '') {
                      encryptionProcess(key);
                    }
                    $('#itemurl').val(data.url);
                    $('#itemdesc').val(data.desc);
                    $('#itemformdelete').attr('itemid', data.id);
                    $('#itemform').slideDown("fast");
                },
                error: function (data) {
                    alert("There was an error. Image could not be added, please try again");
                } // Success function
            }); // Ajax Function
        });
    });
</script>
<!-- Footer -->
<?php include("includes/footer.php");
