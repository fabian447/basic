<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Marvel';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
	.footer{
		display: none;
	}
</style>
<link rel="stylesheet" href="css/style.css">

<title> Personajes de Marvel</title>


<div class="container">
	<center><h1>Personajes de Marvel</h1></center>

	<p class="lead text-center" id="message"></p>
	<div id="marvel-container">
		
	</div>
</div>

<footer class="footer">
      <div class="container">
        <span class="text-muted" id="footer"></span>
      </div>
    </footer>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/marvel.js"></script>
