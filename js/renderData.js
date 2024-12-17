
let tbody = document.getElementById('tbody')
let cntRow = 8

function renderData(mass) {
    tbody.innerHTML = '';
    mass.forEach(e => {
        let tr = document.createElement('tr')
        let td = document.createElement('td')
        let td1 = document.createElement('td')
        let td2 = document.createElement('td')
        let td3 = document.createElement('td')

        // th.setAttribute('scope', 'row')
        tr.classList.add('trData')
        td.textContent = e.id
        td1.textContent = e.gos_number
        td2.textContent = e.date_gosNumber
        td3.textContent = e.date_finish
        tr.addEventListener('click', ()=>{
            document.location.href = 'company.php?id=' + e.id;
        })
        tbody.append(tr)
        tr.append(td)
        tr.append(td1)
        tr.append(td2)
        tr.append(td3)
    });
}
function hiddenList(mass, cnt) {
    let btnOpen = document.getElementById('vievNext')
   
    if (mass.length == 0) {
        btnOpen.style.display = 'none'
    } else btnOpen.style.display = 'block'


    if (mass.length == cnt) {

        btnOpen.style.display = 'none'

    }

    mass.forEach((e, index) => {

        if (index >= cnt) {
            e.style.display = 'none';
        }
        if (e.style.display == 'none') {
            btnOpen.style.display = 'block'

        } else btnOpen.style.display = 'none'
      

    });

    btnOpen.addEventListener('click', () => {
        let open = 1;
      
        mass.forEach((e, index) => {



            if ((e.style.display === 'none') && (open <= cnt)) {
                e.style.display = 'table-row'
                open += 1
            }
            if (e.style.display == 'none') {
                btnOpen.style.display = 'block'

            } else btnOpen.style.display = 'none'
          

        });
     
    })
}





renderData(data);

let input = document.querySelectorAll('.input__filter')

input.forEach(e => {
    e.addEventListener('input', () => {
        filterArray()
        let trList = document.querySelectorAll('.trData')
        hiddenList(trList, cntRow)

    })

});



function filterArray() {


    let title = document.getElementById('gosInput').value.toLowerCase();
    let startDate = new Date(document.getElementById('dateStartInput').value)
    let endDate = new Date(document.getElementById('dateFinishInput').value)


    const filteredData = data.filter(item => {
        const itemStartDate = new Date(item.date_gosNumber);
        const itemEndDate = new Date(item.date_finish);

        const matchesTitle = item.gos_number.toLowerCase().includes(title);
        const matchesStartDate = isNaN(startDate) || itemStartDate >= startDate;
        const matchesEndDate = isNaN(endDate) || itemEndDate <= endDate;

        return matchesTitle && matchesStartDate && matchesEndDate;
    });

    renderData(filteredData);
}




let trList = document.querySelectorAll('.trData')

hiddenList(trList, cntRow)






