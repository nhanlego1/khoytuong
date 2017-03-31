<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 2/21/17
 * Time: 1:56 PM
 */
global $user;
if($user->uid > 0){
    $url = 'node/add/idea';
}else{
    $url = 'user/login';
}
?>
<div class="news post-article-click">
    <a class="" href="<?php print url($url) ?>">
        <span><i class="fa fa-icon-post" aria-hidden="true"></i></span>
        <input type="text" value="Chia sẻ ý tưởng của bạn" name="news" style="background: #fff;"
               placeholder="Chia sẻ ý tưởng của bạn">
        <span><i class="fa fa-pencil-custom" aria-hidden="true"></i></span>
    </a>
</div>
