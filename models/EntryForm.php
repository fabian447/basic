<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model{

   //Variables
	public $name; 
	public $email;



	// Reglas de validación para los datos reicibidos en el formulario.
	public function rules(){
		return [

			//Regla campo requerido
			[['name', 'email'], 'required'],
		    //Regla campo tipo email
		    ['email', 'email'],
		];
	}
}

?>