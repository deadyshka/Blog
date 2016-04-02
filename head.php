<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 01.04.16
 * Time: 14:33
 */

?>

</head>
<body>
<a href="index.php">
    <table align="center"
    ">
    <tr>
        <td colspan="2" width="1080" height="100" align="center"
            style=" font-size: 50px;color: whitesmoke; text-shadow: black 0 0 2px">Личный бложек <? if (!empty($_SESSION["user"])):  ?>
            <?= $_SESSION["user"]; ?>
            <? endif; ?>
        </td>
    </tr>
    </table>
</a>