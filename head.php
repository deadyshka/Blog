
<head>
<a href="index.php">
    <table align="center"
    ">
    <tr>
        <td colspan="2" width="1080" height="100" align="center"
            style=" font-size: 50px;color: whitesmoke; text-shadow: black 0 0 2px">Личный бложек <?php if (!empty($_SESSION["user"])):  ?>
            <?= $_SESSION["user"]; ?>
            <?php endif; ?>
        </td>
    </tr>
    </table>
</a>
</head>