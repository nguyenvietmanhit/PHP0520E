<?php
$files = file('../Bai_tap_ve_nha/bt6.csv');
echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
print_r($files);
echo "</pre>";
//die;
foreach ($files as $file) {
  $str = explode(',', $file);
  echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
  print_r($str);
  echo "</pre>";
//  die;
}
?>
<table border="1" cellpadding="6" cellspacing="0">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Status</th>
    <th>Created_at</th>
  </tr>
  <?php foreach ($files as $file):
      $arr = explode(',', $file);
    ?>
    <tr>
      <td><?php echo $arr[0]?></td>
      <td><?php echo $arr[1]?></td>
      <td><?php echo $arr[2]?></td>
      <td><?php echo $arr[3]?></td>
      <td><?php echo $arr[4]?></td>
      <td><?php echo $arr[5]?></td>
    </tr>
  <?php endforeach; ?>
</table>
