window.onload = function (){
    var html = document.documentElement;
    var body = document.body;
    var height_diff =   html.clientHeight - body.clientHeight;
    if(height_diff > 0) {
        document.getElementsByClassName('footer')[0].style.marginTop = height_diff - 70 + "px";
        console.log(height_diff);
    }
    var width = html.clientWidth;
   
};