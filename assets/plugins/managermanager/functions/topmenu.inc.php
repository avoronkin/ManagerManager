<?php

function renameTab($tab, $newname, $roles='') {
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output .= " // ----------- rename top tab -------------- \n";
        $output .= "\$j('".$mm_top_menu[$tab]['id']."').children('a').html('".$newname."');\n";
        echo ($output . "\n");
    }
}


function hideTab($tabs, $roles='') {
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output = " // ----------- hide top tab -------------- \n";
        $tabsArray = explode(',',$tabs);
        foreach($tabsArray as $tabName) {
            $output .= "\$j('".$mm_top_menu[$tabName]['id']."').remove();\n";
        }
        echo ($output . "\n");
    }
}


function moveTab($tab, $index='', $roles='') {
    global $mm_top_menu;
    (int)$index;
    if (useThisRule($roles)) {
        $output = " // ----------- move top tab -------------- \n";
        if($index) {
            $output .= "tab = \$j('".$mm_top_menu[$tab]['id']."');\n";
            $output .= "tabs = \$j('#nav').children('li');\n";
            $output .= "tabs.eq(larry(".$index.", tabs.size())).before(tab);\n";
        }
        else {
            $output .= "\$j('#nav').append(tab);\n";
        }
        echo ($output . "\n");
    }
}


function addTab($name,$id,$index='', $roles='') {
    (int)$index;
    if (useThisRule($roles)) {
        $output .= " // ----------- add tab -------------- \n";
        $output.="tab = \$j('<li id=\"limenu".$id."\"><a onclick=\"new NavToggle(this); return false;\" href=\"#menu".$id."\">".$name."</a><ul id=\"menu".$id."\" class=\"subnav\"></ul></li>');\n";
        if($index) {
            $output .= "tabs = \$j('#nav').children('li');\n";
            $output .= "tabs.eq(larry(".$index.", tabs.size())).before(tab);\n";

        }
        else {
            $output .= "\$j('#nav').append(tab);\n";
        }

        echo ($output . "\n");
    }
}


function renameSubTab($tab, $newname, $roles='') {
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output .= " // ----------- rename sub tab -------------- \n";
        $output .= "\$j(\"a[href='".$mm_top_menu[$tab]['href']."']\").html('".$newname."');\n";
        echo ($output . "\n");
    }
}


function hideSubTab($tabs, $roles='') {
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output .= " // ----------- hide sub tab -------------- \n";
        $tabsArray = explode(',',$tabs);
        foreach($tabsArray as $tab) {
            $output .= "\$j(\"a[href='".$mm_top_menu[$tab]['href']."']:parent\").remove();\n";
        }
        echo ($output . "\n");
    }
}


function renameModuleTab($moduleId, $newname, $roles='') {
    if (useThisRule($roles)) {
        $output .= " // ----------- Rename module tab -------------- \n";
        $output .= "\$j(\"a[href='index.php?a=112&id=".$moduleId."']\").html('".$newname."');\n";
        echo ($output . "\n");
    }
}


function addSubTab($name,$tab,$path='', $roles='') {
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output .= " // ----------- add subtab -------------- \n";
        if(in_array($tab,array_keys($mm_top_menu))) {
            $output.= "tab = \$j('".$mm_top_menu[$tab]['id']."');\n";
        }
        else {
            $output.= "tab = \$j('#limenu".$tab."');\n";
        }
        $output.="subTab = \$j('<li class=\"\"><a target=\"main\" href=\"".$path."\" onclick=\"this.blur();\">".$name."</a></li>');\n";
        $output .= "\$j(subTab).appendTo(tab.children('ul.subnav'));\n";
        echo ($output . "\n");
    }
}

?>
