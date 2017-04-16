<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<link type="text/css" rel="stylesheet" href="<?php print base_path().drupal_get_path('module','idea_custom') ?>/css/admin_panel/admin-panel.css" media="all">
<div id="admin-panel">
    <h2>Quản lý</h2>
    <ul>
        <li class="manage"><a href="/admin/ideas?destination=admin/dashboard">Quản lý bài viết</a></li>
        <li class="manage"><a href="/admin/content/comment?destination=admin/dashboard">Quản lý bình luận</a></li>
        <li class="manage"><a href="/admin/ads?destination=admin/dashboard">Quản lý Ads</a></li>
        <li class="manage"><a href="/admin/users">Quản lý Users</a></li>
        <li class="manage"><a href="/admin/orders?destination=admin/dashboard">Quản lý quà tặng</a></li>
    </ul>
</div>
<div id="admin-panel">

    <h2>Thêm nội dung</h2>
    <ul>
        <li class="add"><a href="/node/add/idea?destination=admin/dashboard">Thêm bài viết</a></li>
        <li class="add"><a href="/node/add/ads?destination=admin/dashboard">Thêm Ads</a></li>
        <li class="add"><a href="/admin/people/create?destination=admin/dashboard">Thêm user</a></li>
    </ul>
</div>
<div id="admin-panel">

    <h2>Cấu hình và reports </h2>
    <ul>
        <li class="user-logout"><a href="/admin/config/content/idea?destination=admin/dashboard">Cấu hình thông tin website</a></li>
        <li class="user-logout"><a href="/admin/config/system/googleanalytics?destination=admin/dashboard">Google Analystics</a></li>
        <li class="user-logout"><a href="/admin/config/search/metatags?destination=admin/dashboard">Quản lý Metatag</a></li>
        <li class="user-logout"><a href="/admin/config/development/performance?destination=admin/dashboard">Clear cache</a></li>
        <li class="user-logout"><a href="/user/logout">Đăng xuất</a></li>
    </ul>
</div>


