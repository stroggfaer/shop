<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="row">
    <!--sidebar-->
    <div class="col-md-3 col-sm-12 sidebar">
        <div class="row">
            <div class="col-sm-12 block">
                <h2 class="title">Поиск по сайту</h2>
                <form class="search" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Поиск">
                    </div>
                    <button type="submit" class="btn btn-default">Отправить</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 block">
                <h2 class="title">Каталог</h2>
                <div class="navbar">
                    <div class="nav">
                        <div class="item"><a href="#" class="open-down">Одежда</a></div>
                        <div class="item"><a href="#">Одежда</a></div>
                        <div class="item"><a href="#">Одежда</a></div>
                        <div class="item groups">
                            <a href="#">Одежда <span class="open-down"></span></a>
                            <div class="i"><a href="#">Телефон</a></div>
                            <div class="i"><a href="#">Телефон</a></div>
                            <div class="i groups">
                                <a href="#">Часы <span class="open-down"></span></a>
                                <div class="i"><a href="#">Телефон</a></div>
                                <div class="i"><a href="#">Телефон</a></div>
                                <div class="i groups">
                                    <a href="#">Часы <span class="open-down"></span></a>
                                    <div class="i"><a href="#">Часы</a></div>
                                    <div class="i"><a href="#">Часы</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="item"><a href="#">Одежда</a></div>
                        <div class="item"><a href="#">Одежда</a></div>
                        <div class="item"><a href="#">Одежда</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--/sidebar-->
    <div class="col-lg-9 col-md-9 col-sm-12 content">
        <!--main-->
        <div id="main">
            <div class="slides">
                <div class="items">
                    <div class="item"><a href="#"><img src="files/slides/slide1.jpg" alt="" /></a></div>
                    <div class="item"><a href="#"><img src="files/slides/slide1.jpg" alt="" /></a></div>
                    <div class="item"><a href="#"><img src="files/slides/slide1.jpg" alt="" /></a></div>
                </div>
            </div>
            <!--Модуль-->
            <div class="module">
                <h2><a href="#" class="black">Новинки</a><span class="line-br"></span></h2>
                <h3 class="min-title">новая коллекция весна-лето 2016</h3>

                <div class="row">
                    <div class="col-md-4 col-sm-4  goods">
                        <div class="item">
                            <div class="images"><a href="/"><img src="files/goods/big1.jpg" alt=""> </a></div>
                            <div class="block">
                                <div class="title">Lorem ipsum dolor sitamet<span class="min-title">women</span></div>
                                <div class="price">2 003 р. <span class="price-discount">1 000 р.</span></div>
                                <div class="button_green"><div>Купить</div></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="col-md-4 col-sm-4 goods">
                        <div class="item">
                            <div class="images"><a href="/"><img src="files/goods/big1.jpg" alt=""> </a></div>
                            <div class="block">
                                <div class="title">Lorem ipsum dolor sitamet<span class="min-title">women</span></div>
                                <div class="price">2 003 р. <span class="price-discount">1 000 р.</span></div>
                                <div class="button_green"><div>Купить</div></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="col-md-4 col-sm-4 goods">
                        <div class="item">
                            <div class="images"><a href="/"><img src="files/goods/big1.jpg" alt=""> </a></div>
                            <div class="block">
                                <div class="title">Lorem ipsum dolor sitamet<span class="min-title">women</span></div>
                                <div class="price">2 003 р. <span class="price-discount">1 000 р.</span></div>
                                <div class="button_green"><div>Купить</div></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>
                <div class="clear"></div>
            </div> <!--/Модуль-->

        </div>
        <!--/main-->
    </div>
</div>
<div class="clear"></div>
