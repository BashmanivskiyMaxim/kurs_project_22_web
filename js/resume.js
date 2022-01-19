let element1 = document.getElementById('check')
element1.onclick = function (){
    document.getElementById('salary').value = 'Не вказано'
}

let day = document.getElementById('day').value;
let month = document.getElementById('month').value;
let year = document.getElementById('year').value;
onload(function() {
    let birthday = new Date(year, month, day);
    document.getElementById('result').innerHTML = ~~(((Date.now() - birthday) / (31557600000)));

})
year.onblur = function() {
    let birthday = new Date(year, month, day);
    document.getElementById('result').innerHTML = ~~(((Date.now() - birthday) / (31557600000)));


}