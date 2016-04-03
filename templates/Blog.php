<link rel="stylesheet" href="http://192.168.100.220/templates/css/blog.css" />
<?php if ($_SESSION["authorisation"]): ?>
    <form method="post" action="CreateNewNote.php">
        <input type="submit" name="btn_create_new_note" value="Создать запись">
    </form>
    <table align="center" cellpadding="0" cellspacing="0" border="0" width="95%">
        <tbody>
        <tr>
            <td width="100%" align="top">
                <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" class="lenta" style=" ">
                    <tbody>
                    <?php

                    while ($output = $data->fetch()):
                        ?>
                        <tr>
                            <td class="note_head"><?= htmlspecialchars($output['title']); ?></td>
                        </tr>
                        <tr>
                            <td class="note_body"><?= htmlspecialchars($output['body']); ?></td>
                        </tr>
                        <tr>
                            <td class="note_bottom"><?= $output['created']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </td>

        </tr>

        </tbody>
    </table>
<?php endif; ?>

