

ymaps.ready(init);


function init() {
    let arrCoord = paraCoord
    console.log(arrCoord);
    arrCoord.forEach((e, index) => {
        let box = document.getElementById('rootCoord')
        let mapBox = document.getElementById('boxMap')
        let map = document.createElement('div')
        let btnItem = document.createElement('button')

        btnItem.textContent = 'Точка-' + (index + 1)
        btnItem.classList.add('coord__item')
        box.classList.add('coord__list')


        mapBox.classList.add('boxMap')
        map.classList.add('map')
        mapBox.append(map)
        map.setAttribute('id', 'map-' + (index + 1))


        // map.setAttribute('style', 'width: 600px; height: 400px')


        var myMap = new ymaps.Map("map-" + (index + 1), {
            center: [e.left, e.right],
            zoom: 12
        });
        var myPlacemark = new ymaps.Placemark([e.left, e.right], null, {
            preset: 'islands#blueDotIcon'
        });
        myMap.geoObjects.add(myPlacemark);



        btnItem.setAttribute('data-id', 'map-' + (index + 1))
        btnItem.classList.add('target__btn')


        btnItem.addEventListener('click', (e) => {
            // console.log(e.target.getAttribute('data-id'));

            let mapArr = document.querySelectorAll('.map')
            mapArr.forEach(el => {
                el.style.display = 'none'
            });
            let activeMap = document.getElementById(e.target.getAttribute('data-id'))
            activeMap.style.display = 'block'
        })


        box.append(btnItem)

    });

    let itemBtn = document.querySelectorAll('.coord__item')
    let listBtn = document.getElementById('rootCoord')
    console.log(listBtn);
    console.log(itemBtn.length);
    if (itemBtn.length < 6) {
        listBtn.classList.add('coord__listFlexC')
    } 
}



