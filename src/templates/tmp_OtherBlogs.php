<!DOCTYPE html>
<?php if ($_SESSION["authorisation"]): ?>
<link rel="stylesheet" href="/assets/css/blog.css"/>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="95%"
       style="position: absolute; top: 100px; left: 30px">
    <tbody>
    <tr>
        <td width="100%" align="top">
            <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" class="lenta" style=" ">
                <tbody>
                <?php while ($output = $data->fetch()): ?>
                    <tr>
                        <td class="note_head">
                            <a href="?user_id=<?= $output['id']; ?>"><?= htmlspecialchars($output['email']); ?> </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="note_body"></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </td>

    </tr>

    </tbody>
</table>

<?php endif;
    
    