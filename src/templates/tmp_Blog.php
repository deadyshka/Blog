<!DOCTYPE html>

<link rel="stylesheet" href="/assets/css/blog.css"/>
<?php if ($_SESSION["authorisation"]): ?>
    <a href="<?= SITE_URL ?>?action=CreateNewNote"
    <button class="btn btn-success" style="position: absolute; top: 55px; left: 30px">Поделится новостью
    </button>
    </a>
    <form method="get">
        <ul class="pagination" style="position: absolute; left: 200px; top: 35px">
            <li><a href="?page=1">&laquo;</a></li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li <?php if ($i == $page) {
                    echo 'class="active"';
                } ?> >
                    <a href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <li><a href="?page=<?= $pages ?>">&raquo;</a></li>
        </ul>
    </form>
    <table align="center" cellpadding="0" cellspacing="0" border="0" width="95%"
           style="position: absolute; top: 100px; left: 30px">
        <tbody>
        <tr>
            <td width="100%" align="top">
                <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" class="lenta" style=" ">
                    <tbody>
                    <?php while ($output = $data->fetch()): ?>
                        <tr>
                            <td class="note_head"><a href="?action=Comment&mess_id=<?= $output['id']; ?>">
                                    <?= htmlspecialchars($output['title']); ?></a></td>
                        </tr>
                        <tr>
                            <td class="note_body"><?= htmlspecialchars($output['body']); ?></td>
                        </tr>
                        <tr>
                            <td>Количество
                                коментариев: <?= \Epic\Lib\GetCommentsCount($connection, $output['id']); ?></td>
                        </tr>
                        <tr>
                            <td class="note_bottom">
                                <?php if ($_SESSION['id'] == $output['autor_id']): ?>
                                <form method="post" action="<?= SITE_URL ?>?action=EditNote">
                                    <input type="submit" name="btn_edit_note" value="Редактировать новость">
                                    <input type="hidden" name="note_id" value="<?= $output['id']; ?>">
                                </form>
                                <?php endif;
                                if ($output['updated'])
                                    echo "<div>Редактировалось: " . $output['updated'] . "</div>";
                                ?>
                                <div>Создана: <?= $output['created']; ?></div>
                            </td>
                        </tr>
                    <?php endwhile; ?>


                    </tbody>
                </table>
            </td>

        </tr>

        </tbody>
    </table>

<?php endif; ?>

