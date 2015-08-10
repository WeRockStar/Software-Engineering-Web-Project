<?php
include_once './config/config.php';
?>
<h1>Upload your images here:</h1>
<div id="fileselect" style="border-bottom:thin #000000 solid; border-collapse:collapse">
    <form id="frmSimple" method="post" enctype="multipart/form-data" action="save.php">
         Select file to upload:&nbsp;
    <input type="file" id="filename" name="filename" size="10" /><br />
    <input type="submit" id="submit" name="submit" value=" Upload " />                      
    </form>
</div>