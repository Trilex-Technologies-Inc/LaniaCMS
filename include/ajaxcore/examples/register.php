<?php
require_once("AjaxFunctions.class.php"); // include our class
$ajax=new AjaxFunctions();
?>
<html>
<head>
    <title>Register page</title>
    <script type="text/javascript" src="../prototype.js"></script> <!-- include stantard prototype library -->
    <script type="text/javascript" src="../AjaxCore.js"></script> <!-- include AjaxCore library -->
    <?php
    echo $ajax->getJSCode();
    ?>
</head>
<body>
<table border="0" style="font-size: 10pt; font-family: Verdana">
    <tr>
        <td style="width: 300px; height: 50px;">
            Username:
        </td>
        <td style="width: 400px; height: 50px;">
            <input type="text" id="username" name="username" style="width: 200px" />
            <input type="button" id="checkButton" name="checkButton" value="Check" /> 
            <?php
                echo $ajax->bind("checkButton","onclick","checkUsername","username");
            ?>   
            <div id="resultsDiv">&nbsp;</div>
        </td>
    </tr>
    <tr>
        <td style="width: 300px; height: 50px;">
            Password:
        </td>
        <td style="width: 400px; height: 50px;">
            <input type="password" id="password" name="password" style="width: 200px" />
        </td>
    </tr>
    <tr>
        <td style="width: 300px; height: 200px;">
            Signature:
        </td>
        <td style="width: 400px; height: 200px;">
            <textarea rows="5" style="width: 200px"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2"  align="center">
            <input type="button" id="registerButton" name="registerButton" value="Register" disabled="disabled"/>
        </td>
    </tr>
</table>
</body>
</html>