<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Portal de noticias</h1>

        <p class="lead">Noticias al dia para todos</p>
    </div>

    <div class="body-content">

        <div class="row">
            <!--Creamos el ciclo foreach con los datos que estan siendo enviados desde SiteController con la acción actionIndex. -->
            <?php foreach ($noticias as $noticia): ?>
            <div class="col-lg-4">
                <img width="350px" height="250px" src="<?= Html::encode("{$noticia->imagen}")?>" alt="">
                <center><h2><?= Html::encode("{$noticia->titulo}")?></h2></center>
            </div>
             <?php endforeach; ?>
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>

    </div>
</div>
