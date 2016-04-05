<link rel="stylesheet" href="http://192.168.100.220/templates/css/blog.css"/>
<?php if ($_SESSION["authorisation"]): ?>
    <form method="post" action="CreateNewNote.php">
        <input type="submit" name="btn_create_new_note" value="Поделится новостью">
    </form>
    <table align="center" cellpadding="0" cellspacing="0" border="0" width="95%">
        <tbody>
        <tr>
            <td width="100%" align="top">
                <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" class="lenta" style=" ">
                    <tbody>
                    <?php

                    while ($output = $data->fetch()):
                        if (!$output['deleted']):
                            ?>
                            <tr>
                                <td class="note_head"><?= htmlspecialchars($output['title']); ?></td>
                            </tr>
                            <tr>
                                <td class="note_body"><?= htmlspecialchars($output['body']); ?></td>
                            </tr>
                            <tr>
                                <td class="note_bottom">
                                    <form method="post" action="EditNote.php">
                                        <input type="submit" name="btn_edit_note" value="Редактировать новость">
                                        <input type="hidden" name="note_id" value="<?= $output['id']; ?>">
                                    </form>
                                    <?php if ($output['updated'])
                                        echo "<div>Редактировалось: " . $output['updated'] . "</div>";
                                    ?>
                                    Создана: <?= $output['created']; ?>
                                </td>
                            </tr>
                        <?php endif; endwhile; ?>
                    </tbody>
                </table>
            </td>

        </tr>

        </tbody>
    </table>
<?php endif; ?>

