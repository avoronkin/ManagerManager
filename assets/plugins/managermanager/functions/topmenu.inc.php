<?php

global $mm_top_menu,$mm_debug;
$mm_debug = true;//debug?
$mm_top_menu = array(
        'site'=>array('id'=>'#limenu3','href'=>'#menu3'),
        'home'=>array('href'=>'index.php?a=2'),
        'preview'=>array('href'=>'../'),
        'clear cache'=>array('href'=>'index.php?a=26'),
        'search'=>array('href'=>'index.php?a=71'),
        'new resource'=>array('href'=>'index.php?a=4'),
        'new weblink'=>array('href'=>'index.php?a=72'),
        
        'elements'=>array('id'=>'#limenu5','href'=>'#menu5'),
        'manage elements'=>array('href'=>'index.php?a=76'),
        'manage files'=>array('href'=>'index.php?a=31'),
        'manage metatags'=>array('href'=>'index.php?a=81'),

        'modules'=>array('id'=>'#limenu9','href'=>'#menu9'),
        'manage modules'=>array('href'=>'index.php?a=106'),

        'security'=>array('id'=>'#limenu2','href'=>'#menu2'),
        'manager users'=>array('href'=>'index.php?a=75'),
        'web users'=>array('href'=>'index.php?a=99'),
        'roles'=>array('href'=>'index.php?a=86'),
        'manager permissions'=>array('href'=>'index.php?a=40'),
        'web permissions'=>array('href'=>'index.php?a=91'),

        'tools'=>array('id'=>'#limenu1-1','href'=>'#menu1-1'),
        'backup'=>array('href'=>'index.php?a=93'),
        'remove locks'=>array('href'=>'javascript:removeLocks();'),
        'import html'=>array('href'=>'index.php?a=95'),
        'export html'=>array('href'=>'index.php?a=83'),
        'configuration'=>array('href'=>'index.php?a=17'),

        'reports'=>array('id'=>'#limenu1-2','href'=>'#menu1-2'),
        'shedule'=>array('href'=>'index.php?a=70'),
        'system events'=>array('href'=>'index.php?a=114'),
        'manager actions'=>array('href'=>'index.php?a=13'),
        'system info'=>array('href'=>'index.php?a=53')
);


function renameMenu($name, $newname, $roles='') {
    $name = strtolower($name);
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output .= " // ----------- rename tab -------------- \n";
        if((int)$name > 0) {
            //rename module tab
            $output .= "\$j(\"a[href='index.php?a=112&id=".$name."']\").html('".$newname."');\n";
        }
        else {
            //rename tab
            $output .= "\$j(\"a[href='".$mm_top_menu[$name]['href']."']\").html('".$newname."');\n";
        }
        echo ($output . "\n");
    }
}


function hideMenu($names, $roles='') {
    $name = strtolower($name);
    global $mm_top_menu;
    if (useThisRule($roles)) {
        $output .= " // ----------- hide tab -------------- \n";
        $tabsArray = explode(',',$names);
        foreach($tabsArray as $name) {
            if((int)$name > 0) {
                //hide module tab
                $output .= "\$j(\"a[href='index.php?a=112&id=".$name."']\").parent().remove();\n";
            }
            else {
                //hide tab
                $output .= "\$j(\"a[href='".$mm_top_menu[$name]['href']."']\").parent().remove();\n";
            }
        }
        echo ($output . "\n");
    }
}

function moveMenu($name, $index='', $roles='') {
    $name = strtolower($name);
    global $mm_top_menu;
    (int)$index;
    if (useThisRule($roles)) {
        $output = " // ----------- move top tab -------------- \n";
        if($index) {
            $output .= "tab = \$j('".$mm_top_menu[$name]['id']."');\n";
            $output .= "tabs = \$j('#nav').children('li');\n";
            $output .= "tabs.eq(larry(".$index.", tabs.size())).before(tab);\n";
        }
        else {
            $output .= "\$j('#nav').append(tab);\n";
        }
        echo ($output . "\n");
    }
}


function addMenu($name,$id,$index='', $roles='') {
    global $mm_debug;
    (int)$index;
    if (useThisRule($roles)) {
        $output .= " // ----------- add top tab -------------- \n";
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

function addSubMenu($name,$parentTabId,$path='',$index='', $roles='') {
    global $mm_top_menu,$mm_debug;
    (int)$index;
    if (useThisRule($roles)) {
        $output .= " // ----------- add subtab -------------- \n";
        if(in_array($parentTabId,array_keys($mm_top_menu))) {
            $output.= "parentTab = \$j('".$mm_top_menu[$parentTabId]['id']."');\n";
        }
        else {
            $output.= "parentTab = \$j('#limenu".$parentTabId."');\n";
        }
        $output.="tab = \$j('<li class=\"\"><a target=\"main\" href=\"".$path."\" onclick=\"this.blur();\">".$name."</a></li>');\n";
        $output.="tabs = \$j(parentTab).children('ul').children('li');\n";
        if($mm_debug) {
            $output .= "console.log(\"add subtab ".$name."\",tabs,tabs.length);\n";
        }
        if($index) {
            $output .= "tabs.eq(larry(".$index.", tabs.length)).after(tab);\n";
        }
        else {
            $output .= "\$j(tab).appendTo(parentTab.children('ul'));\n";
        }

        echo ($output . "\n");
    }
}










?>
