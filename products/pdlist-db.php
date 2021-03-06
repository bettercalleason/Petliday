<?php include __DIR__ . '/../parts/config.php' ?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<link rel="stylesheet" href="pro-list.css">
<?php include __DIR__ . '/../parts/html-navbar.php' ?>
<!-- 分類tag 篩選-->
<div class="container trip-select">
    <div class="topic">
        <p>行程一覽</p>
        <p class="topic-line"></p>
    </div>

    <!-- <div class="time align-items-center">
        <p class="pr-3">玩多久？</p>
        <php foreach ($c_rows as $c) : ?>
            <a class="tag<= $cate == $c['time_sid'] ? '' : '-not' ?>-on" href="?cate=<= $c['time_sid'] ?>"><= $c['time'] ?></a>
        <php endforeach ?>
    </div> -->
    <div class="time align-items-center">
        <p class="pr-3">玩多久？</p>
        <a class="tag-not-on tag-on" data-time="3">三日遊</a>
        <a class="tag-not-on tag-on" data-time="2">二日遊</a>
        <a class="tag-not-on tag-on" data-time="1">一日遊</a>
        <a class="tag-not-on tag-on" data-time="4">活動</a>
    </div>
    <div class="area align-items-center">
        <p class="pr-3">去哪玩？</p>
        <a class="tag-not-on tag-on" data-area="n">北部出發</a>
        <a class="tag-not-on" data-area="c">中部出發</a>
        <a class="tag-not-on" data-area="s">南部出發</a>
        <a class="tag-not-on" data-area="e">東部出發</a>
    </div>
    <form action="" class="order">
        <div class="form-group d-flex align-items-center justify-content-end">
            <label for="exampleFormControlSelect1">排序方式</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>依熱門程度</option>
                <option>依價錢低至高</option>
                <option>依價錢高至低</option>
            </select>
        </div>
    </form>
</div>
<!-- card -->
<div class="container">
    <div class="row product-row align-items-center">
    </div>
</div>
<!-- 11/13 研究分頁按鈕連結-->

<!-- <div class="container">
    <div class="row mt-4">
        <ul class="page-list p-0 d-flex">
            <li class="pages p-arrow <= $page == 1 ? 'pages-off' : '' ?>">
                <a href="?<php
                            $params['page'] = $page - 1;
                            echo http_build_query($params);
                            ?>" aria-label="Previous">
                    <div class="arrow-page">
                        <img src="/Petliday/icon/left.png" alt="">
                    </div>
                </a>
            </li>
            <php for ($i = $page - 3; $i <= $page + 3; $i++) : ?>
                <php if ($i >= 1 and $i <= $totalPages) : ?>
                    <li class="pages <= $page == $i ? 'pages-on' : 'pages' ?>">
                        <a href="?<php
                                    $params['page'] = $i;
                                    echo http_build_query($params);
                                    ?>"><= $i ?></a>
                    </li>
                <php endif ?>
            <php endfor ?>
            <li class="pages p-arrow <= $page == $totalPages ? 'pages-off' : '' ?>">
                <a href="?<php
                            $params['page'] = $page + 1;
                            echo http_build_query($params);
                            ?>" aria-label="Next">
                    <div class="arrow-page">
                        <img src="/Petliday/icon/right.png" alt="">
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div> -->
<!-- ------------------ body結束 ------------------ -->
<?php include __DIR__ . '/../parts/html-footer.php' ?>
<!-- ---------------js/jq 開始 ------------------ -->
<?php include __DIR__ . '/../parts/html-script.php' ?>
<script>
    // ------JS開始 以上勿刪-------
    const productTpl = function(a) {
        return `
            <div class="product-item col-md-4 col-12 p-4" data-sid="${a.sid}">
            <div class="card c3">
                <div class="heart-circle">
                    <div class="heart"><img src="/Petliday/icon/heart-red.png" alt=""></div>
                </div>
                <div class="card-pic w-100">
                    <img src="/Petliday/products/img/prolist${a.sid}.jpg" alt="...">
                </div>
                <div class="card-text pt-3 pb-1 px-4">
                    <p>${a.product_name}</p>
                    <div class="info d-flex justify-content-between">
                        <div class="info-left d-flex align-items-center">
                            <div class="star mb-2 mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 66.3 63.4" width="14px">
                                    <defs>
                                    </defs>
                                    <g id="圖層_2" data-name="圖層 2">
                                        <g id="圖層_1-2" data-name="圖層 1">
                                            <path class="cls-3" d="M51.47,63.4A3.55,3.55,0,0,1,49.84,63L33.15,54.22,16.45,63a3.49,3.49,0,0,1-5.07-3.69l3.18-18.59L1.06,27.55a3.5,3.5,0,0,1,1.94-6l18.66-2.71L30,2a3.5,3.5,0,0,1,6.28,0l8.35,16.92L63.3,21.58a3.5,3.5,0,0,1,1.94,6L51.74,40.71,54.92,59.3a3.5,3.5,0,0,1-3.45,4.1Z" />
                                        </g>
                                    </g>
                                </svg>

                            </div>
                            <div class="rate text-gray t-m">${a.star}</div>
                            <div class="rate-all t-xs ml-2"><u class="text-gray">${a.rate}則評論 </u></div>
                        </div>
                        <div class="info-right pr-2 t-l orange-color">$${a.price_all}</div>
                    </div>
                </div>
                <p class="card-info px-4 t-xs">
                    ${a.intro}
                </p>
            </div>
        </div>
        `;
    }
    // tag selection
    $('.time a, .area a').on('click', function() {
        $(this).toggleClass('tag-on');

        const dataTime = [];
        const dataArea = [];
        $('.time a.tag-on').each(function(i, el) {
            console.log($(this).attr('data-time'));
            dataTime.push($(this).attr('data-time'));
        })
        $('.area a.tag-on').each(function(i, el) {
            console.log($(this).attr('data-area'));
            dataArea.push($(this).attr('data-area'));
        })
        // const dTime = dataTime.join(',');
        // const dArea = dataArea.join(',');
        let sendTime = [];
        let sendArea = [];
        let whereArray = [];
        let whereStr = '';
        dataTime.forEach(function(el) {
            sendTime.push('`cate`=' + el);
            // sendData.push('dTime[]=' + el);
        });
        dataArea.forEach(function(el) {
            sendArea.push('`area`=' + `'${el}'`);
            // sendData.push('dArea[]=' + el);
        });
        const sendTimeStr = sendTime.join(' OR ');
        const sendAreaStr = sendArea.join(' OR ');

        // console.log('sendTime', sendTimeStr);
        // console.log('sendArea', sendAreaStr);
        whereArray.push(sendTimeStr);
        whereArray.push(sendAreaStr);
        console.log('whereArray', whereArray);
        if (sendTimeStr.length !== 0 && sendAreaStr.length !== 0) {
            console.log('hi')
            whereStr = whereArray.join(") AND (");
        } else {
            console.log('nono')
            whereStr = whereArray.join("");
        }
        console.log('whereStr', whereStr);
        location.href = "#" + whereStr;

        $.get('pdlist-db-api.php', {
                where: whereStr,
            },
            function(data) {
                console.log('daaaaaaa', data);

                let str = '';
                if (data && data.length) {
                    data.forEach(function(el) {
                        str += productTpl(el);
                    });
                }
                $('.product-row').html(str);
            }, 'json');

    })
    $.get('pdlist-db-api.php', {
            none: '?',
        },
        function(data) {
            console.log('daaaaaaa', data);

            let str = '';
            if (data && data.length) {
                data.forEach(function(el) {
                    str += productTpl(el);
                });
            }
            $('.product-row').html(str);
        }, 'json');





    // from 19.product-list-ajax.php+++++++++++++++++++++++



    // function whenHashChanged() {
    //     for (let i = 0; i < sendDataStr.length; i++) {
    //         let u = parseInt(sendDataStr[i]);
    //         console.log('u', u);
    // getProductData(u);
    //     }
    // }
    // tags.removeClass('btn-primary').addClass('btn-outline-primary');
    // tags.each(function(index, el) {
    //     const sid = parseInt($(this).attr('data-sid'));
    //     if (sid === u) {
    //         $(this).removeClass('btn-outline-primary').addClass('btn-primary');
    //     }
    // });

    // window.addEventListener('hashchange', whenHashChanged);
    // whenHashChanged();



    // 取得點擊卡片的sid值
    $('.card-pic').on('click', function(event) {
        const item = $(this).closest('.product-item');
        // closest往上找最近的
        const sid = item.attr('data-sid');
        // const qty = item.find('.quantity').val();
        // find往下找
        console.log({
            sid: sid,
            // quantity: qty
        });
    });
    // ------JS結束 勿刪到-------
</script>
<?php include __DIR__ . '/../parts/html-foot.php' ?>