<div class="widget">
    <div id="dyn2" class="shownpars">
        <table  cellpadding="0" cellspacing="0" border="0" class="dTable tablesorter">
            <thead>
                <tr>
                    <th style="width: 5px;"></th>
                    <th>Gambar</th>
                    <th>Nama Produk (kode)</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th style="width: 50px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $Cart_query = mysql_query('select * from '. PREFIX_TABLE .'cart_product');
                while($result = mysql_fetch_object($Cart_query)):
                ?>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td><?php ?></td>
                    <td><?php echo $result->nama_barang . " (".$result->kode_barang.")"?></td>
                    <td><?php echo $result->hje?></td>
                    <td><?php echo $result->stok;?></td>
                    <td>
                        <a href="#" class="tablectrl_small bRed tipS" title="Edit"><span class="iconb" data-icon="&#xe1db;"></span></a>
                        <a href="#" class="tablectrl_small bBlack tipS" title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a>
                    </td>
                </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>
</div>
