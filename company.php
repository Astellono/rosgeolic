<?php

require_once 'php/connect.php';
// require_once 'php/filter.php';
session_start();
$id = $_GET['id'];
$result = $connect->query("SELECT * from `opendata10` where `id` = '$id'");
$data = $result->fetch_assoc();


$text = $data['geo_coord'];


$polygons = explode('Тип пространственного объекта - Полигон', $text);

$coordinates = array();
foreach ($polygons as $polygon) {

    $pattern = '/(\d+)°(\d+)\'(\d+\.?\d*)\"([NЕ])/';


    preg_match_all($pattern, $polygon, $matches);

    $points = array();
    foreach ($matches[0] as $key => $match) {
        $points[$key] = array(
            'grad' => $matches[1][$key],
            'min' => $matches[2][$key],
            'sec' => $matches[3][$key],
            'dec' => $matches[1][$key] + $matches[2][$key] / 60 + $matches[3][$key] / 3600
        );
    }

} ?>
<pre>
<?php

?>
</pre>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="style/reset.css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=199de9b4-eaf5-45e1-95c2-3510af592354&lang=ru_RU"
        type="text/javascript"></script>

    <!-- <link rel="stylesheet" href="style/style.css"> -->
    <script>
        let data = <?php echo json_encode($data); ?>;
        let gradMass = <?php echo json_encode($points); ?>;
        console.log(data);
    </script>
    <script defer src="js/grad.js"></script>
    <script defer src="js/map.js"></script>
    <script defer src="js/companyMenu.js"></script>

    <link rel="stylesheet" href="style/company.css">
</head>

<body>

    <div class="container">
        <hr>
        <h1><?= $data['name_org'] ?></h1>
        <hr>
        <ul class="info__menu">
            <li id="info" class="info__menu__item active__menu">Информация</li>
            <li id="poly" class="info__menu__item">Полигоны</li>
        </ul>
        <hr>
        <ul class="info__list">
            <?php
            if ($data['sved_nedr'] != "") {
                ?>
                <li class="info__item"><span class="zag"> Сведения о пользователе недр: </span><?= $data['sved_nedr'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($data['gos_number'] != "") {
                ?>
                <li class="info__item"><span class="zag">Гос номер: </span><?= $data['gos_number'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['date_gosNumber'] != "") {
                ?>
                <li class="info__item"><span class="zag">Дата присвоения гос номера: </span><?= $data['date_gosNumber'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($data['date_finish'] != "") {
                ?>
                <li class="info__item"><span class="zag">Дата окончания лицензии: </span><?= $data['date_finish'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['is_elObrz'] != "") {
                ?>
                <li class="info__item"><span class="zag">Наличие электронного образца: </span><?= $data['is_elObrz'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['for_license'] != "") {
                ?>
                <li class="info__item"><span class="zag">На что лицензии: </span><?= $data['for_license'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['type_iskop'] != "") {
                ?>
                <li class="info__item"><span class="zag">Тип ископаемых: </span><?= $data['type_iskop'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['name_area'] != "") {
                ?>
                <li class="info__item"><span class="zag">Название территории: </span><?= $data['name_area'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['name_subRus'] != "") {
                ?>
                <li class="info__item"><span class="zag">Название субьекта РФ: </span><?= $data['name_subRus'] ?></li>
                <?php
            }
            ?>

            <?php
            if ($data['status_nedr'] != "") {
                ?>
                <li class="info__item"><span class="zag">Статус недр: </span><?= $data['status_nedr'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['doc_req'] != "") {
                ?>
                <li class="info__item"><span class="zag">Реквизиты документы на основании которого выдана лицензия:
                    </span><?= $data['doc_req'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['sved_changeLicense'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения в внесении изменений:
                    </span><?= $data['sved_changeLicense'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['sved_changeOform'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения о перефоромлении лицензии:
                    </span><?= $data['sved_changeOform'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['prikaz_req'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения о приказа о прекращении лицензии права пользования
                        недрами:
                    </span><?= $data['prikaz_req'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['date_stop'] != "") {
                ?>
                <li class="info__item"><span class="zag">Дата приоставнки лицензии: </span><?= $data['date_stop'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['date_usl'] != "") {
                ?>
                <li class="info__item"><span class="zag">Условия и сроки приостановки лицензии
                    </span><?= $data['date_usl'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($data['sved_reestr'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения о реестровых записях: </span><?= $data['sved_reestr'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($data['link_cardLicence'] != "") {
                ?>
                <li class="info__item"><span class="zag">Ссылка на карточку лицензии:
                        <a href="<?= $data['link_cardLicence'] ?>"><?= $data['link_cardLicence'] ?></a>
                </li>
                <?php
            }
            ?>

        </ul>
        <div class="container__coord" style="display: none;">
            <?php
            if ($data['geo_coord'] != "") {
                ?>
                
                <h2 class="coord__title">Координаты полигонов</h2>
                <hr>
                <div id="rootCoord" class="coordList">

                </div>
                <hr>
                <div id="boxMap" class="boxMap">

                </div>
                <?php
            }
            ?>
        </div>


        <!-- <div id="map-0" style="width: 600px; height: 400px"></div> -->

    </div>


</body>

</html>