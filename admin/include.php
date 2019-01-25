<!-- Style Sheet -->
<link  rel="stylesheet" type="text/css" href="/admin/css/global.css"/>
<!-- //Style Sheet -->

<!-- Common Javascript -->
<script type="text/javascript" src="/lib/js/jquery-1.7.2.min.js"></script>

<!--<script  src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<script type="text/javascript" src="/lib/function.js"></script>
<script type="text/javascript" src="/lib/js/common.js"></script>
<!-- //Common Javascript -->

<script type="text/javascript" src="/admin/admin.js"></script>

<link rel="stylesheet" href="/lib/js/plugin/jquery_ui/themes/redmond/jquery.ui.all.css">
<script src="/lib/js/plugin/jquery_ui/jquery.ui.core.js"></script>
<script src="/lib/js/plugin/jquery_ui/jquery.ui.widget.js"></script>
<script src="/lib/js/plugin/jquery_ui/jquery.ui.datepicker.js"></script>
<script src="/lib/js/plugin/jquery_ui/jquery.ui.datepicker-ko.js"></script>
<script type="text/javascript" src="/lib/js/plugin/jquery.popup.js"></script>
<?php
/* 자동생성 js / css */
$Ipath = includeDir();
if($Ipath != "undefined")
{
    if (is_file(ROOT_PATH."{$Ipath}.js")) echo "<script type='text/javascript' src='$Ipath.js'></script>\n";
    if (is_file(ROOT_PATH."{$Ipath}.css")) echo "<link rel='stylesheet' type='text/css' href='$Ipath.css'/>\n";
}

/* 페이지 특화 js / css */
if($Ipath != "undefined")
{
    $tmpIpath = explode("/", $Ipath);
    $tmpIpath = "/{$tmpIpath[1]}/{$tmpIpath[2]}/";
    $fileName = explode("/", $_SERVER['SCRIPT_NAME']);
    $fileName = explode(".", $fileName[sizeof($fileName)-1]);
    $fileName = "{$tmpIpath}{$fileName[0]}";
    if ($Ipath != $fileName)
    {
        if (is_file(ROOT_PATH."{$fileName}.js")) echo "<script type='text/javascript' src='$fileName.js'></script>\n";
        if (is_file(ROOT_PATH."{$fileName}.css")) echo "<link rel='stylesheet' type='text/css' href='$fileName.css'/>\n";    
    } 
}
?>

