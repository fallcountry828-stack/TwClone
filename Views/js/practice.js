/**
 * ========================================================
 *  jQuery 練習用スクリプト (practice.js)
 *  
 *  エディタで直接コードを書いて練習したい場合は、
 *  ここにコードを記述して practice.php をブラウザで再読み込みしてください。
 * ========================================================
 */

$(function() {
    console.log("practice.js が読み込まれました！準備完了です。");

    // ----------------------------------------------------
    // 【課題1】いいねボタンがクリックされたらコンソールに出力してみましょう
    // ----------------------------------------------------
    // $('.js-practice-like').click(function(e) {
    //     console.log("いいねボタンがクリックされました！");
    // });


    // ----------------------------------------------------
    // 【課題2】クリックした要素の画像(img)を切り替えてみましょう
    // ----------------------------------------------------
    // $('.js-practice-like').click(function(e) {
    //     $(this).find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');
    // });


    // ----------------------------------------------------
    // 【課題3】いいねカウントの数値を「+1」してみましょう
    // ----------------------------------------------------
    // $('.js-practice-like').click(function(e) {
    //     const countObj = $(this).parent().find('.js-practice-like-count');
    //     let count = Number(countObj.text());
    //     countObj.text(count + 1);
    // });


    // ----------------------------------------------------
    // 【課題4】data-like-id を使って「いいね付与 / 解除」を作ってみましょう
    // ----------------------------------------------------
    // $('.js-practice-like').click(function(e) {
    //     const thisObj = $(this);
    //     const likeId = thisObj.data('like-id');
    //     const countObj = thisObj.parent().find('.js-practice-like-count');
    //     let count = Number(countObj.text());
    //
    //     if (likeId) {
    //         // いいね解除
    //         count--;
    //         countObj.text(count);
    //         thisObj.data('like-id', null);
    //         thisObj.find('img').attr('src', '../Views/img/icon-heart.svg');
    //     } else {
    //         // いいね付与
    //         count++;
    //         countObj.text(count);
    //         thisObj.data('like-id', true);
    //         thisObj.find('img').attr('src', '../Views/img/icon-heart-twitterblue.svg');
    //     }
    // });


    // ----------------------------------------------------
    // 【課題5】クリック位置 (e.pageX, e.pageY) に浮き上がるハートを作ってみましょう
    // ----------------------------------------------------
    // $('.js-practice-like').click(function(e) {
    //     const heart = document.createElement("span");
    //     heart.classList.add("heart");
    //     heart.textContent = "\u2764\uFE0E";
    //     document.body.appendChild(heart);
    //
    //     heart.style.left = e.pageX + "px";
    //     heart.style.top = e.pageY + "px";
    //
    //     setTimeout(() => {
    //         heart.remove();
    //     }, 1500);
    // });

});
