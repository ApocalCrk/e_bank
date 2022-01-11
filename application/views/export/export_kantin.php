<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=kantin_".date('Y-m-d').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kantin</th>
                    <th>Nama Kantin</th>
                    <th>No Hp</th>
                    <th>Pengurus Kantin</th>
                    <th>ID Foto Kantin</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $start = 0;
                $sql = $this->db->get("kantin");
                foreach ($sql->result() as $row) {
                 ?>
                <tr>
                    <td><?php echo ++$start; ?></td>
                    <td><?php echo $row->kode_kantin; ?></td>
                    <td><?php echo $row->nama_kantin; ?></td>
                    
                    <td><?php echo $row->no_hp_kantin; ?></td>
                    <td><?php echo $row->pengurus_kantin; ?></td>
                    <td><?php echo $row->foto_kantin; ?></td>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>