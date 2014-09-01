<?php
    $ptitle = "Homepage";
    include("includes/header.php");
    include("includes/modals.php");
?>
<div class="row">
    <div class="col-md-3">
        <div class="white-bg">
            <?php
                //print_r($dbarr);
                $db = ORM::for_table('client')->find_many();
                foreach ($db as $dbs) {
                        echo '<div class="dbparent" dbid="'.$dbs->id.'"><span class="glyphicon glyphicon-chevron-right"></span> '.$dbs->name.'</div>';
                        echo '<div id="clientid-'.$dbs->id.'" class="dbcontainer" dbid="'.$dbs->name.'">';
                        $folders = ORM::for_table('folder')->where('client_id', $dbs->id)->find_many();
                        echo '<ul>';
                        foreach ($folders as $folder) {
                            echo '<li class="folderitem" folderid="'.$folder->id.'"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;'.$folder->name.' <span class="newentryplusbtn glyphicon glyphicon-plus fr"></span></li>';
                            $items = ORM::for_table('item')->where('folder_id', $folder->id)->find_many();
                            echo '<ul>';
                            foreach ($items as $item) {
                                echo '<li class="anitem" itemid="'.$item->id.'">'.$item->name.'<span class="glyphicon glyphicon-chevron-right"></span></li>';
                            }
                            echo '</ul>';
                        }
                        echo '</ul>';
                        echo '</div>';
                }

            ?>
        </div>
    </div>
    <div class="col-md-6"><?php include('includes/form.php') ?></div>
    <div class="col-md-3">
        <div class="white-bg">
            <h3>Logs</h3>
        </div>
    </div>
</div>

<script type="text/javascript" src="static/js/javascripts/pidcrypt_util.js"></script>
<script type="text/javascript" src="static/js/javascripts/pidcrypt.js"></script>
<script type="text/javascript" src="static/js/javascripts/md5.js"></script>
<script type="text/javascript" src="static/js/javascripts/aes_core.js"></script>
<script type="text/javascript" src="static/js/javascripts/aes_cbc.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function() {
    function encrypt(pass, key) {
        var aes = new pidCrypt.AES.CBC();
        return crypted = aes.encryptText(pass, key, {nBits: 256});
    }

    function decrypt(pass, key) {
        var aes = new pidCrypt.AES.CBC();
        return plain = aes.decryptText(pass, key, {nBits: 256});
    }

    //var key = prompt("Please enter the secure key.");
    //encrypt("my secure password", key);
    $(document).on('click', '#itemformsubmit', function(e) {
        var form = $(itemform),
            data = form.serialize();
        console.log(data);
        if (confirm("You've made changes, do you wish to still continue?") == true) {

        } else {

        }
    });

    $(document).on('click', '.folderitem', function(e) {
        $(this).next().slideToggle('fast');
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
            var folderid = $(this).parent().attr('folderid');
            var form = $('#itemform');
            $('#itemfolderid').val(folderid);
            form.find('input').val('');
            form.find('textarea').val('');
        });

        $(document).on('click', '#newentrybtn', function(e) {
            var folderid = $(this).parent().attr('folderid');
            var form = $('#itemform');

            var data = form.serialize();
            console.log(data);
        });

        $(document).on('click', "#newdatabasebtn", function (e) {
            e.preventDefault();
            var data = $("#newdbform").serialize();
            console.log(data);
            $.ajax({ url: 'scripts/newdb.php',
                type: 'post',
                data: data,
                 beforeSend: function ( xhr ) {
                xhr.overrideMimeType("text/plain; charset=x-user-defined");
                },
                success: function(data) {
                    console.log(data);
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
                    $('#itemppassrepeat').val(data.passrepeat);
                    $('#itemurl').val(data.url);
                    $('#itemdesc').val(data.desc);
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
