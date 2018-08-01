<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    
    //Son las variables que estan en la base de datos, los campos qie pertenecen al usuario.
    public $id_user;
    public $username;
    public $email;
    public $password;
    public $authKey;
    public $accessToken;
    public $activate;

    /**
     * @inheritdoc
     */
    
    // busca la identidad del usuario a través de su $id

    //funcion identificar mediante el id del usuario
    public static function findIdentity($id_user)
    {
        //Busca el id ingresado en el login en la tabla Users
        $user = Users::find()
                //Verifica que el estado del  usuario sea 1 o sea activo.
                ->where("activate=:activate", [":activate" => 1])
                //Verifica que el id del usuario coincida
                ->andWhere("id_user=:id_user", ["id_user" => $id_user])
                ->one();
         
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    // Busca la identidad del usuario a través de su token de acceso 
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = Users::find()
                //Verifica que el estado del  usuario sea 1 o sea activo.
                ->where("activate=:activate", [":activate" => 1])
                //busca dond el token de acceso coincida con los registros
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    // Busca la identidad del usuario a través del username 
    public static function findByUsername($username)
    {
        $users = Users::find()
                //Verifica que el estado del  usuario sea 1 o sea activo.
                ->where("activate=:activate", ["activate" => 1])
                //verifica que el user name coincida con los registros
                ->andWhere("username=:username", [":username" => $username])
                ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    
    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // Valida el password, que coincida con los registros
        if ($password == $this->password)
        {
        return $password === $password;
        }
    }
}
