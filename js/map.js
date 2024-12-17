

ymaps.ready(init);
console.log(paraCoord);

function init(){
    
    var myMap = new ymaps.Map("map-1", {
        center: [55.616092, 37.674804],
        zoom: 18
    });

    var myPlacemark = new ymaps.Placemark([55.616092, 37.674804], null, {
        preset: 'islands#blueDotIcon'
    });
    myMap.geoObjects.add(myPlacemark);

}
   


