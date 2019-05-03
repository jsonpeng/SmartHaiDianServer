$(function(){
    $('#zhezhao').click(function(){
        $(this).parent().hide();
    })
    $('#iknow').click(function(){
        $('.method-box').hide();
    })
    var src=$('.weui-bar__item_on img').attr('src');
    if(src==undefined){
        return false;
    }
    else{
        var a=src.lastIndexOf('/')+1;
        var b=src.slice(a, src.length)
        src=src.replace(b,'l_'+b);
        $('.weui-bar__item_on img').attr('src',src);
    }
})
function popup(){
    $('.method-box').show();
}
function switchItem(obj,child,func){
    $(obj).on('click', child, function() {
        if(!$(this).hasClass('active')){
            $(this).addClass('active').siblings().removeClass('active');
        }
    });
}
