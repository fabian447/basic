<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Noticia;
use yii\data\Pagination;

class SiteController extends Controller
{

    //Acción entry para el formulario
    public function actionEntry(){
        //Llamado al modelo EntryForm
        $model= new EntryForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            //Validar los datos recibidos en el modelo con las reglas especificadas.

            return $this->render('entry-confirm', ['model'=> $model]);
            //Como ya fueron validados los datos, se renderisa la vista entrt-confirm
        }else{   //Si no sucede la validación, entonces...

            //Se renderiza el modelo con las alertas de validación
            return $this->render('entry', ['model' => $model]);
        }
    }


    /**
    Acción de Prueba
    */
    
    public function actionSay( $message = 'Que bonita es la vida'){
        return $this->render('say', ['message' => $message]);
    }
    /*
    Fin Acción de prueba
    /*
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         //se busca en la base de datos la tabla Noticias
        $query = Noticia::find();

          //Se declara la variable country y se definde por cual campo de la DB sera ordenada la lista.
        $pagination = new Pagination([
            //cantidad de noticias por página
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        //Se declara la variablw noticias y se estable por cual campo de la tabla se ordenaran los elementos
        $noticias = $query->orderBy('titulo')
               ->offset($pagination->offset)
        //La paginación mostrara la totalidad de los elementos
                    ->limit($pagination->limit)
                    ->all();

        //Return render enviara los datos que estamos obteniendo de la base de datos a la vista
         return $this->render('index',[
            'noticias' => $noticias,
           //se envia la paginación correspondiente
            'pagination' => $pagination,
        ]);  
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

     public function actionMarvel()
    {
        return $this->render('marvel');
    }
}
