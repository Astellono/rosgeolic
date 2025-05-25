<?php
require_once 'php/connect.php';
// require_once 'php/filter.php';
session_start();

$result = $connect->query("SELECT * from `licenses`");
$rows = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <script>
        let data = []
        <?php 
        foreach ($users as $user) {
            
            ?>
            data.push({
                licId:<?= json_encode($user['license_id']) ?>,
                company_name: <?php
                
                $sql = "SELECT `company_name` FROM `subsoilusers` WHERE `user_id` = '{$user['user_id']}'";
                $result = $connect->query($sql);
                $nameOrg = $result->fetch_assoc();

                echo json_encode($nameOrg['company_name']);
                ?>,
                reg_number:<?= json_encode($user['reg_number']) ?>,
                date_gosNumber:<?= json_encode($user['issue_date']) ?>,
                date_finish: <?= json_encode($user['expiration_date']) ?>,
                authorityId: <?= json_encode($user['authority_id']) ?>
            })
            <?php
        }
        ?>
        console.log(data);
    </script>
    <script src="js/renderData.js" defer>

    </script>
</head>

<body>
    <h1>РОСГЕОЛИЦ</h1>
    <form method="POST" class="input__container" action="">
    <div class="input__box">
            <label class="label" for="сompName">Название компании:</label>
            <input class="input__filter" id="сompName" type="text" name="сompName">
        </div>
        <div class="input__box">
            <label class="label" for="gosNumber">Гос номер:</label>
            <input class="input__filter" id="gosInput" type="text" name="gosNumber">
        </div>
        <div class="input__box">
            <label class="label" for="gosNumber">Начало лицензии:</label>
            <input class="input__filter" id="dateStartInput" type="date" name="dateStart">
        </div>
        <div class="input__box">
            <label class="label" for="dateFinish">Окончание лицензии:</label>
            <input class="input__filter" id="dateFinishInput" type="date" name="dateFinish">
        </div>
    </form>
    <table id="keywords" class="container">
        <thead>
            <tr style="pointer-events: none;">
                <!-- <th scope="col">id</th> -->
                <th scope="col">Компания</th>
                <th scope="col">Государственный номер</th>
                <th scope="col">Дата начала лицензии</th>
                <th scope="col">Дата окончания лицензии</th>
            </tr>
        </thead>
        <tbody id="tbody">

          
        </tbody>
    </table>
    <button id="vievNext" class="viev__btn">
        Показать еще
    </button>
    <ul>


    </ul>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script>
    function redir() {
        
    }
   </script>
   
</body>

</html>