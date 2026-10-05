$(function(){
    //いいねがクリックされたとき
    $('.js-like').click(function(e){
        const this_obj=$(this);
        const like_id=$(this).data("like-id");
        const like_count_obj=$(this).parent().find(".js-like-count");
        let like_count=Number(like_count_obj.html());

    if(like_id){
    //いいね解除
    like_count--;
    like_count_obj.html(like_count);
    this_obj.data("like-id",null);
    //いいねの色をグレーに変更
    $(this).find('img')
           .attr("src",'../Views/img/icon-heart.svg');
    }else{
    //いいねを付与
    //いいねを増やす
    like_count++;
    like_count_obj.html(like_count);
    this_obj.data("like-id",true);
    //いいねの色を青に変更
    $(this).find('img')
           .attr("src",'../Views/img/icon-heart-twitterblue.svg');

    //ハートが浮き上がるエフェクト
    const heart = document.createElement("span");
    heart.classList.add("heart");
    heart.textContent = "\u2764\uFE0E";
    document.body.appendChild(heart);
    const x = e.pageX;
    const y = e.pageY;
    heart.style.left = x + "px";
    heart.style.top = y + "px";
    setTimeout(() => {
        heart.remove();
    }, 1500);
}

    })
});