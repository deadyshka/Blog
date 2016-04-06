<!DOCTYPE html>
<html lang="en">
<style>.lenta {
        /*background: linear-gradient(to top,dimgray,whitesmoke);*/
        /* border: 1px solid;*/
        border-radius: 5px;
        opacity: 0.95;
    }

    .note_head {
        line-height: 20px;
        height: 14px;
        font-weight: bold;
        font-size: 32px;
        padding: 15px 15px 0 15px;
        color: navy;

    }

    .note_body {
        padding: 15px 15px 15px 15px;
        text-align: justify;
        font-size: 13px;
        line-height: 160%;

    }

    .note_bottom {
        padding: 0 15px 0 15px;
        border-bottom: 1px solid;
        text-align: right;
        font-size: 10px;
        font-style: italic;

    }</style>
<!--<link rel="stylesheet" href="http://192.168.100.220/templates/css/blog.css"/>-->
<?php if ($_SESSION["authorisation"]): ?>
    <form method="post" action="CreateNewNote.php" style="position: absolute; top: 55px; left: 30px">
        <input type="submit" class="btn btn-success" name="btn_create_new_note" value="Поделится новостью" >
    </form>
    <table align="center" cellpadding="0" cellspacing="0" border="0" width="95%"
           style="position: absolute; top: 100px; left: 30px">
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

