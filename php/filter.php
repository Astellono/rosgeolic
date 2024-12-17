<?php

require_once 'connect.php';
session_start();
$gosNumber = $_POST['gosNumber'];
$dateStart = $_POST['dateStart'];
$dateFinish = $_POST['dateFinish'];



$result = $connect->query("SELECT * from `opendata10` WHERE ((`gos_number` = '$gosNumber' OR '$gosNumber' = '') AND (`date_gosNumber` = '$dateStart' OR '$dateStart' = '') AND (`date_finish` = '$dateFinish' OR '$dateFinish' = ''))");

$rows = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$_SESSION['newMass'] = $users;

foreach ($users as $user) {
    $idList[] = $user['id'];
}

?>
<pre>
<?php
print_r($idList);


?>
</pre>

<?php

$serializedData = serialize($idList);

setcookie('users', $serializedData, time() + 3600);
?>
<pre>
<?php

print_r($serializedData);
$datas = unserialize($_COOKIE['users']);

foreach ($datas as $data) {
    print_r($data);
}

?>
</pre>






