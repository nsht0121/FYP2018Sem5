<?php

return [

    'name' => '管理系統',
    'welcome' => '歡迎！',
    'backhome' => '返回主頁',
    'overview' => '總覽',
    'control' => '操作',
    'view' => '顯示詳情',
    'edit' => '修改',
    'delete' => '刪除',

    'nav' => [
        'menu' => '目錄',
        'dashboard' => '後台主頁',
        'user' => '用戶',
        'event' => '活動',
        'eventCategory' => '活動類別',
        'news' => '文章',
        'newsCategory' => '文章類別',
    ],

    'dashboard' => [
        'title' => '後台主頁',
        'subtitle' => '總目錄',
        'latsetUser' => '最新用戶',
        'board' => [
            'user' => '用戶',
            'post' => '文章',
            'event' => '活動',
            'visitor' => '瀏覽次數',
        ],
        'secondBoard' => [
            'username' => '用戶名稱',
            'email' => '電郵地址',
            'dateJoined' => '加入日期',
        ],
    ],

    'users' => [
        'title' => '用戶',

        'subtitle' => [
            'index' => '總覽',
            'create' => '建立新用戶',
            'edit' => '修改用戶',
            'show' => '顯示用戶詳情',
        ],

        'list' => [
            'email' => '電郵地址',
            'username' => '用戶名稱',
            'dateCreated' => '建立時間',
        ],

        'table' => [
            'info' => '內容',
            'username' => '用戶名稱 *',
            'email' => '電郵地址 *',
            'password' => '用戶密碼 *',
            'save' => '儲存',
        ],
    ],

    'events' => [
        'title' => '活動',
        'class' => '組別',

        'subtitle' => [
            'index' => '總覽',
            'create' => '建立新活動',
            'edit' => '修改活動',
            'show' => '顯示活動詳情',
        ],

        'list' => [
            'title' => '標題',
            'description' => '簡介',
            'venue' => '舉辦地點',
            'fee' => '費用',
            'quota' => '人數限制',
            'applyDate' => '報名日期',
            'eventDate' => '舉辦日期',
            'dateCreated' => '建立時間',
            'hidden' => '已隱藏',
            'canceled' => '已取消',
        ],

        'table' => [
            'info' => '資料',
            'title' => '標題 *',
            'description' => '簡介',
            'venue' => '舉辦地點',
            'fee' => '費用',
            'quota' => '人數限制',
            'dateAndTime' => '日期和時間',
            'eventStart' => '活動開始',
            'eventEnd' => '活動結束',
            'applyStart' => '報名開始',
            'applyEnd' => '報名結束',
            'attribute' => '屬性',
            'image' => '圖片',
            'category' => '類別',
            'isHidden' => '已隱藏',
            'isCanceled' => '已取消',
            'save' => '儲存',
        ],
    ],

    'eventCategory' => [
        'title' => '活動類別',

        'subtitle' => [
            'index' => '總覽',
            'create' => '建立新類別',
            'edit' => '修改類別',
            'show' => '顯示類別詳情',
        ],

        'list' => [
            'name' => '名稱',
            'dateCreated' => '建立時間',
        ],

        'table' => [
            'info' => '內容',
            'name' => '類別名稱 *',
            'save' => '儲存',
        ],
    ],

    'eventClass' => [
        'title' => '活動組別',

        'subtitle' => [
            'index' => '總覽',
            'create' => '建立新組別',
            'edit' => '修改組別',
            'show' => '顯示組別詳情',
        ],

        'list' => [
            'name' => '名稱',
            'participant' => '參與人數',
            'dateCreated' => '建立時間',
        ],

        // 'table' => [
        //     'info' => '內容',
        //     'name' => '類別名稱 *',
        //     'save' => '儲存',
        // ],
    ],

    'news' => [
        'title' => '文章',

        'subtitle' => [
            'index' => '總覽',
            'create' => '建立新文章',
            'edit' => '修改文章',
            'show' => '顯示文章詳情',
        ],

        'list' => [
            'title' => '標題',
            'dateCreated' => '建立時間',
            'hidden' => '已隱藏',
        ],

        'table' => [
            'info' => '資料',
            'title' => '標題 *',
            'content' => '內文',
            'attribute' => '屬性',
            'currentImage' => '目前圖片',
            'image' => '圖片',
            'category' => '類別',
            'hidden' => '隱藏文章',
            'save' => '儲存',
        ],
    ],

    'newsCategory' => [
        'title' => '文章類別',

        'subtitle' => [
            'index' => '總覽',
            'create' => '建立新類別',
            'edit' => '修改類別',
            'show' => '顯示類別詳情',
        ],

        'list' => [
            'name' => '名稱',
            'dateCreated' => '建立時間',
        ],

        'table' => [
            'info' => '內容',
            'name' => '類別名稱 *',
            'save' => '儲存',
        ],
    ],

];
