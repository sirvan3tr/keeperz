<?php
    require '../setup.php';
    $db = ORM::for_table('client')->find_many();
    foreach ($db as $dbs) {
            echo '<div class="dbparent" dbid="'.$dbs->id.'"><span class="glyphicon glyphicon-chevron-right"></span> '.$dbs->name.'<div class="newfolderentryplusbtn fr" title="Click to create a new folder.">NEW FOLDER</div></div>';
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
            echo '</div>';
    }

?>
