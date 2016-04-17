<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/assets/css/blog.css"/>
<title><?= $title ?></title>
<br>
<?php if ($authorisation): ?>

    <table align="center" cellpadding="0" cellspacing="0" border="0" width="95%"
           style="position: absolute; top: 100px; left: 30px">
        <tbody>
        <tr>
            <td width="100%" align="top">
                <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" class="lenta" style=" ">
                    <tbody>
                    <tr>
                        <td class="note_head"><?= htmlspecialchars($output['title']); ?></td>
                    </tr>
                    <tr>
                        <td class="note_body"><?= htmlspecialchars($output['body']); ?></td>
                    </tr>
                    <tr>
                        <td class="note_bottom">
                            <?php
                            if ($output['updated'])
                                echo "<div>Редактировалось: " . $output['updated'] . "</div>";
                            ?>
                            Создана: <?= $output['created']; ?>
                        </td>
                    </tr>
                    <?php while ($data = $comments->fetch()): ?>
                        <tr>
                        <tr>
                            <td class="note_comment"><?= htmlspecialchars($data['body']); ?></td>

                        </tr>
                        <td>
                            <?php
                            if ($output['updated'])
                                echo "<div>Редактировалось: " . $data['updated'] . "</div>";
                            ?>

                        <td class="note_comment">Коментарий создан: <?= $data['created']; ?>
                            by <?= htmlspecialchars($data['autor_name']); ?></td>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td>
                            <form method="post">
                                Ваш комментарий<br>
                                <textarea name="body" cols="100" rows="5"></textarea><br>
                                <input type="submit" name="Edit" value="Оставить комментарий">
                                <input type="hidden" name="token" value="<?= $token ?>">
                                <input type="hidden" name="note_id" value="<?= $output['id'] ?>">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>

        </tr>

        </tbody>
    </table>


<?php endif; ?>
</html>
