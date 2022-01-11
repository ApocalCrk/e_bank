<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=data_penarikan_saldo_".date('Y-m-d').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
function sign($message, $key) {
    return hash_hmac('sha256', $message, $key) . $message;
}
function verify($bundle, $key) {
    return hash_equals(
        hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
        mb_substr($bundle, 0, 64, '8bit')
    );
}
function getKey($password, $keysize = 16) {
    return hash_pbkdf2('sha256',$password,'some_token',100000,$keysize,true);
}
function decrypt($hash, $password) {
    $iv = hex2bin(substr($hash, 0, 32));
    $data = hex2bin(substr($hash, 32));
    $key = getKey($password);
    if (!verify($data, $key)) {
        return null;
    }
    return openssl_decrypt(mb_substr($data, 64, null, '8bit'),'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv);
} 
$password = 'password';
 ?>

 <table>
            <tr>
            <th>No</th>
            <th>Kode Penarikan</th>
            <th>Jumlah Penarikan</th>
            <th>Penarik</th>
            <th>Waktu</th>
            </tr><?php
            $start = 0;
            $penarikan_data = $this->db->get('penarikan_saldo');
            foreach ($penarikan_data->result() as $penarikan)
            {
                ?>
                <tr>
            <td><?php echo  ++$start ?></td>
            <td><?php echo $penarikan->kode_penarikan ?></td>
            <td><?php echo 'Rp. '.number_format($penarikan->jumlah_penarikan) ?></td>
            <td><?php echo decrypt($penarikan->kode_penarikan, $password) ?></td>
            <td><?php echo $penarikan->waktu ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>