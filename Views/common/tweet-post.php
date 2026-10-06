            <!-- ツイート投稿欄 -->
            <div class="tweet-post">
                <div class="my-icon">
                    <img src="<?php echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                    
                </div>
                <div class="input-area">
                    <form action='post.php' method='post' enctype='multipart/form-data'>
                        <textarea name="body" id="" placeholder="いまどうしてる？" maxlength="140"></textarea>
                        <div class="bottom-area">
                            <div class="mb-0">
                                <input type="file" name="image" id=""class='form-control form-control-sm'>
                            </div>
                            <button class="btn" type='submit'>つぶやく</button>
                        </div>
                    </form>
                </div>
            </div>