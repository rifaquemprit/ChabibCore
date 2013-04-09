<table>
    <thead>
        <tr>
            <th></th>
            <th>Nama Plugin</th>
            <th>Deskripsi</th>
            <th>Author</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (Plugin::__list() as $plugin_list): ?>
        <tr>
            <td></td>
            <td><?php echo $plugin_list['PLUGIN_NAMA_PLUGIN'];?></td>
            <td><?php echo $plugin_list['PLUGIN_DESCRIPTION'];?></td>
            <td><?php echo $plugin_list['PLUGIN_PEMBUAT'];?></td>
            <td><?php echo 'DELETE';?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>