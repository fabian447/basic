<?php


namespace app\controllers;


use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller{

	//Definición de la acción actionIndex 
	public function actionIndex(){

		//se busca en la tabla de DB Country
		$query = Country::find();

		// se definde la paginación y se establece la cantidad de elementos que la misma mostrara
		$pagination = new Pagination([
			//cantidad de elementos por página
			'defaultPageSize' => 5,
			'totalCount' => $query->count(),
		]);


		//Se declara la variable country y se definde por cual campo de la DB sera ordenada la lista.
		$countries = $query->orderBy('name')
					->offset($pagination->offset)
		//La paginación mostrara la totalidad de los elementos
					->limit($pagination->limit)
					->all();
        

        //Return render envia los datos para que sean mostrados porla vista index
        return $this->render('index',[
           //se envian los datos de la tbala countries por la variable
        	'countries' => $countries,
           //se envia la paginación correspondiente
        	'pagination' => $pagination,
        ]);			

	}
}

?>
