                        <div class="tweet">
                            <div class="user">
                                <a href="profile.php?user_id=<?php echo html_escape($view_tweet['user_id']); ?>">
                                    <img src="<?php echo buildimagepath($view_tweet['user_icon'],'user')?>" alt="">
                                </a>
                            </div>
                            <div class="content">
                                <div class="name">
                                    <a href="profile.php?user_id=<?php echo html_escape($view_tweet['user_id']); ?>">
                                        <span class="nickname"><?php echo html_escape($view_tweet['user_nickname']); ?></span>
                                        <span class="user-name">@<?php echo html_escape($view_tweet['user_name']); ?>・<?php echo convertTodayTimeAgo($view_tweet['tweet_created_at']); ?></span>
                                    </a>
                                </div>
                                <p><?php echo $view_tweet['tweet_body']; ?></p>
                                <?php if ($view_tweet['tweet_image_name']): ?>
                                    <img src="<?php echo buildimagepath($view_tweet['tweet_image_name'],'tweet') ?>" alt="" class='post-image'>
                                <?php endif; ?>
                                <div class="icon-list">
                                    <div class="like js-like" data-like-id="<?php echo html_escape($view_tweet['like_id']);?>">
                                        <?php if (isset($view_tweet['like_id'])){
                                            //いいね！がある場合
                                            echo '<img src="' . HOME_URL . 'Views/img/icon-heart-twitterblue.svg" alt="">';
                                        }
                                        else{
                                            //いいねがない場合
                                            echo '<img src="'.HOME_URL.'Views/img/icon-heart.svg" alt="">';
                                        } ?>
                                    </div>  
                                    
                                    <div class="like-count js-like-count"><?php echo html_escape($view_tweet['like_count']); ?></div>
                                </div>
                            </div>
                        </div>