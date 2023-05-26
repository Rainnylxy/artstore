function test(){
    var price=document.getElementById('price').value;
    var date=document.getElementById('date').value;
    var width=document.getElementById('width').value;
    var height=document.getElementById('height').value;

    var datepattern=new RegExp('^[0-9]{4}$')
    var pricepattern=new RegExp('^[0-9]*$')

    if(!datepattern.test(date)){
        document.getElementById('datehint').innerText="date pattern error"
    }else{
        document.getElementById('datehint').innerText="    "
    }

    if(!pricepattern.test(price)){
        document.getElementById('pricehint').innerText="price pattern error"
    }else{
        document.getElementById('pricehint').innerText="    "
    }

    if(width<=0){
        document.getElementById('widthhint').innerText="width pattern error"
    }else{
        document.getElementById('widthhint').innerText="------------"
    }

    if(height<=0){
        document.getElementById('heighthint').innerText="height pattern error"
    }else{
        document.getElementById('heighthint').innerText="------------"
    }
}