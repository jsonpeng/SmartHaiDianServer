(function () {
   //  var html = document.documentElement
   //  var resizeEvent = 'orientationchange' in window ? 'orientationchange' : 'resize'
  	// window.addEventListener(resizeEvent, function () {
   //  	html.style.fontSize = html.clientWidth / 7.5 + 'px'
  	// })
  	// window.onload = function () {
   //  	html.style.fontSize = html.clientWidth / 7.5 + 'px'
  	// }
    if (/Android (\d+\.\d+)/.test(navigator.userAgent)) {
        var version = parseFloat(RegExp.$1);
        if (version > 2.3) {
            var phoneScale = parseInt(window.screen.width) / 750;
            document.write('<meta name="viewport" content="width=750, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi, user-scalable=no">');
        } else {
            document.write('<meta name="viewport" content="width=750, user-scalable=no, target-densitydpi=device-dpi">');
        }
    } else {
        document.write('<meta name="viewport" content="width=750, user-scalable=no, target-densitydpi=device-dpi">');
    }
 
    window.alert = function(name){
	    var iframe = document.createElement("IFRAME");
	    iframe.style.display="none";
	    iframe.setAttribute("src", 'data:text/plain,');
	    document.documentElement.appendChild(iframe);
	    window.frames[0].window.alert(name);
	    iframe.parentNode.removeChild(iframe);
    }
})()