<head>
    <meta charset="utf-8">
    <style>
        body {
            /*background-image: url(http://192.168.100.220/templates/images/bg.jpg);*/
            margin: 0;
            padding: 0;
        }
    </style>
    <a href="../index.php">
        <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-radius: 50px">
            <tbody>
            <tr>
                <td colspan="2" width="100%" height="15" align="left"
                    style=" font-size: 15px;background:linear-gradient(to top,darkblue,deepskyblue);color: whitesmoke; text-shadow: black 0 0 2px"><?php if (!empty($title)): ?>
                        <?= $title; ?>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        </table>
    </a>
</head>
