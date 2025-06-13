<?php

require_once 'php/connect.php';
if (!$connect) {
    die("Ошибка подключения: " . $connect->connect_error);
}
session_start();
$licId = $_GET['licId'];
$authorityId = $_GET['authId'];

$result = $connect->query("SELECT 
    l.reg_number,
    l.has_electronic_copy,
    l.issue_date,
    l.purpose,
    m.mineral_name,
    p.plot_name,
    p.cadastral_number,
    r.region_name,
    p.status,
    su.company_name,
    su.inn,
    la.authority_name,
    l.basis_document,
    l.expiration_date,
    l.license_card_url,
    
    -- Координаты участка
    (SELECT GROUP_CONCAT(
        CONCAT('Точка ', pc.point_number, ': ', pc.latitude, ', ', pc.longitude) 
        SEPARATOR '\n'
    ) FROM plotcoordinates pc WHERE pc.plot_id = p.plot_id) as 'geo_coord',
    
    p.spatial_object_type,
    p.coordinate_system,
    p.upper_boundary,
    p.lower_boundary,
    
    -- Дополнительные сведения
    l.termination_order,
    l.termination_date,
    l.suspension_conditions,
    l.registry_records 
    
FROM licenses l
JOIN subsoilplots p ON l.plot_id = p.plot_id
JOIN regions r ON p.region_id = r.region_id
JOIN mineraltypes m ON l.mineral_id = m.mineral_id
JOIN subsoilusers su ON l.user_id = su.user_id
JOIN licensingauthorities la ON l.authority_id = la.authority_id
WHERE l.user_id = '$licId';");
if (!$result) {
    die("Ошибка запроса: " . $connect->error);
}

$dataLic = $result->fetch_assoc();

$geoCoord = $dataLic['geo_coord'];


// $polygons = explode('Тип пространственного объекта - Полигон', $text);

// $coordinates = array();
// foreach ($polygons as $polygon) {

//     $pattern = '/(\d+)°(\d+)\'(\d+\.?\d*)\"([NЕ])/';


//     preg_match_all($pattern, $polygon, $matches);

//     $points = array();
//     foreach ($matches[0] as $key => $match) {
//         $points[$key] = array(
//             'grad' => $matches[1][$key],
//             'min' => $matches[2][$key],
//             'sec' => $matches[3][$key],
//             'dec' => $matches[1][$key] + $matches[2][$key] / 60 + $matches[3][$key] / 3600
//         );
//     }

// } ?>

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

    <script>
        let geoMass = <?php echo json_encode($geoCoord) ?>;

    </script>
    <script defer src="js/grad.js"></script>
    <script defer src="js/map.js"></script>
    <script defer src="js/companyMenu.js"></script>

    <link rel="stylesheet" href="style/company.css">
</head>

<body>

    <div class="container">
        <hr>
        <h1><?= $dataLic['company_name'] ?></h1>
        <hr>
        <ul class="info__menu">
            <li id="info" class="info__menu__item active__menu">Информация</li>
            <?php
                if ($dataLic['geo_coord'] != "") {
                ?>
            <li id="poly" class="info__menu__item">Полигон</li>

               <?php
            }
            ?>
        </ul>
        <hr>
        <ul class="info__list">
            <?php
            if ($dataLic['authority_name'] != "") {
                ?>
                <li class="info__item"><span class="zag"> Сведения о пользователе недр:
                    </span><?= $dataLic['authority_name'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['reg_number'] != "") {
                ?>
                <li class="info__item"><span class="zag">Гос номер: </span><?= $dataLic['reg_number'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['issue_date'] != "") {
                ?>
                <li class="info__item"><span class="zag">Дата присвоения гос номера: </span><?= $dataLic['issue_date'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['expiration_date'] != "") {
                ?>
                <li class="info__item"><span class="zag">Дата окончания лицензии: </span><?= $dataLic['expiration_date'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['has_electronic_copy'] != "") {
                ?>
                <li class="info__item"><span class="zag">Наличие электронного образца:
                    </span><?= $dataLic['has_electronic_copy'] ? 'Есть' : 'Нет'; ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['purpose'] != "") {
                ?>
                <li class="info__item"><span class="zag">На что лицензия: </span><?= $dataLic['purpose'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['mineral_name'] != "") {
                ?>
                <li class="info__item"><span class="zag">Тип ископаемых: </span><?= $dataLic['mineral_name'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['region_name'] != "") {
                ?>
                <li class="info__item"><span class="zag">Название Региона: </span><?= $dataLic['region_name'] ?></li>
                <?php
            }
            ?>
            <?php

            ?>

            <?php
            if ($dataLic['status'] != "") {
                ?>
                <li class="info__item"><span class="zag">Статус недр: </span><?= $dataLic['status'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['basis_document'] != "") {
                ?>
                <li class="info__item"><span class="zag">Реквизиты документы на основании которого выдана лицензия:
                    </span><?= $dataLic['basis_document'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['sved_changeLicense'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения в внесении изменений:
                    </span><?= $dataLic['sved_changeLicense'] ?></li>
                <?php
            }
            ?>

            <?php
            if ($dataLic['termination_order'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения о приказа о прекращении лицензии права пользования
                        недрами:
                    </span><?= $dataLic['termination_order'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['termination_date'] != "") {
                ?>
                <li class="info__item"><span class="zag">Дата приоставнки лицензии:
                    </span><?= $dataLic['termination_date'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['suspension_conditions'] != "") {
                ?>
                <li class="info__item"><span class="zag">Условия приостановки лицензии
                    </span><?= $dataLic['suspension_conditions'] ?></li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['registry_records'] != "") {
                ?>
                <li class="info__item"><span class="zag">Сведения о реестровых записях:
                    </span><?= $dataLic['registry_records'] ?>
                </li>
                <?php
            }
            ?>
            <?php
            if ($dataLic['license_card_url'] != "") {
                ?>
                <li class="info__item"><span class="zag">Ссылка на карточку лицензии:
                        <a href="<?= $dataLic['license_card_url'] ?>"><?= $dataLic['license_card_url'] ?></a>
                </li>
                <?php
            }
            ?>

        </ul>

        <div class="container__coord" style="display: none;">
            <?php
            if ($dataLic['geo_coord'] != "") {
                ?>

                

              
                <div id="map" style="max-width: 600px; height: 400px; margin: 20px auto"></div>
                <?php
            }
            ?>
        </div>

        <!-- <div id="map-0" style="width: 600px; height: 400px"></div> -->

    </div>


</body>

</html>