<?php

include SITEPATH.'core/plugin.php';
$no = 0;
?>
<h2>Plugins</h2>
<p><b>Daftar Plugin</b></p>
<table border="1">
    <tr>
        <th></th>
        <th>Nama Plugin</th>
        <th>Deskripsi</th>
    </tr>

    <?php foreach (Plugin::__list() as $plugin) : ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $plugin['PLUGIN_PEMBUAT'] ?></td>
        <td></td>
    </tr>
    <?php endforeach;?>

</table>