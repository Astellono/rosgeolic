

ymaps.ready(init);

function calculateCenter(coordinates) {
    let latSum = 0;
    let lonSum = 0;
    const count = coordinates.length;

    coordinates.forEach(coord => {
        latSum += coord[0]; // Широта
        lonSum += coord[1]; // Долгота
    });

    return [latSum / count, lonSum / count];
}

function init() {

    let arrCoord = decimalCoordinates
    let arrPoints = []

    arrCoord.forEach((e, index) => {
        arrPoints.push([e.latitude, e.longitude])
    });


    if (arrPoints.length > 0) {
        arrPoints.push([arrCoord[0].latitude, arrCoord[0].longitude]);
    }
    const center = calculateCenter(arrPoints);
    console.log(center);

    var map = new ymaps.Map("map", {
        center: center, // Москва
        zoom: 11
    });




    var polygon = new ymaps.Polygon(
        [arrPoints], // Массив координат
        {
            hintContent: "Мой полигон", // Подсказка
            balloonContent: "Это полигон на Яндекс Картах" // Балун
        },
        {
            fillColor: '#FF0000', // Цвет заливки
            strokeColor: '#0000FF', // Цвет обводки
            opacity: 0.5, // Прозрачность
            strokeWidth: 2 // Толщина обводки
        }
    );
    map.geoObjects.add(polygon);

}



