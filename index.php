<?php
    $ptitle = "Homepage";
    include("includes/header.php");
    include("includes/modals.php");
?>
<h1>KEEPERZ</h1>
<div class="dbparent-tabs">
    <?php
        $dbarr=array();
        $db = ORM::for_table('client')->find_many();
        foreach ($db as $dbs) {
            echo '<div class="fl dbparent" dbid="'.$dbs->id.'">'.$dbs->name.'</div>';
            array_push($dbarr, $dbs->id);
        }
    ?>
    <div class="clear"></div>
</div>
<div class="folders-container fl">
    <?php
        //print_r($dbarr);
        foreach ($dbarr as $dbarrs) {
            echo '<div id="clientid-'.$dbarrs.'" class="dbcontainer" dbid="'.$dbarrs.'">';
            $folders = ORM::for_table('folder')->where('client_id', $dbarrs)->find_many();
            echo '<ul>';
            foreach ($folders as $folder) {
                echo '<li class="folderitem" folderid="'.$folder->id.'"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;'.$folder->name.' <span class="glyphicon glyphicon-plus-sign pull-right"></span></li>';
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
<?php include('includes/form.php') ?>

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
        $(this).next().toggle();
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
            $('.dbcontainer').hide();
            $('#clientid-'+dbid).show();
            $('.dbparent').removeClass('dbparent-selected');
            $(this).addClass('dbparent-selected');

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
