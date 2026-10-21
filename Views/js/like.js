$(function(){
    //いいねがクリックされたとき
    $('.js-like').click(function(e){
        const this_obj=$(this);
        const like_id=$(this).data("like-id");
        const tweet_id=$(this).data("tweet-id");
        const like_count_obj=$(this).parent().find(".js-like-count");
        let like_count=Number(like_count_obj.html());

    if(like_id){
    //いいね解除
    $.ajax({
        url: '../Controllers/like.php',
        type: 'POST',
        data: {'like_id': like_id,},
        timeout: 10000,
    })
    .done((res) => {
        //成功したとき
        //いいねを減らす
        like_count--;
        like_count_obj.html(like_count);
        this_obj.data("like-id",null);

        //いいねの色をグレーに変更
        $(this).find('img').attr("src",'../Views/img/icon-heart.svg');
    })
    .fail((data) => {
        //失敗したとき
        alert('処理中にエラーが発生しました');
        console.log(data);  
    });





    }else{
    $.ajax({
        url: '../Controllers/like.php',
        type: 'POST',
        data: {'tweet_id': tweet_id},
        timeout: 10000,
    })
    .done((data) => {
        //成功したとき
        //いいねを増やす
        like_count++;
        like_count_obj.html(like_count);
        this_obj.data("like-id",data['like_id']);

        //いいねの色を青に変更
        $(this).find('img').attr("src",'../Views/img/icon-heart-twitterblue.svg');

        // ハートが浮き上がるエフェクト
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
    })

    .fail((data) => {
        //失敗したとき
        alert('処理中にエラーが発生しました');
        console.log(data);  
    });



}

    })
});