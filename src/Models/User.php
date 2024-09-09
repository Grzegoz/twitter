<?php

namespace Artur\Twitter\Models;

use Artur\Twitter\Core\Database;
use Ramsey\Uuid\Uuid;

class User
{

    private const TABLE = 'users';

    public int $id = 0; 
    public string $username; 
    public string $email;
    public string $password;
    private array $errors = [];
    
    public function validate() {
        
        if(empty($this->username) || strlen($this->username) < 3 || strlen($this->username) > 20) {
            $this->errors['username'] = "Имя должно состоять от 3-ех до 20-ти символов";
        }
        if(empty($this->email)) {
            $this->errors['email'] = "Поле email должно быть заполненно";
            return false;
        }
        if(empty($this->password) || strlen($this->password) < 3 || strlen($this->password) > 20) {
            $this->errors['password'] = "Пароль должен состоять не менее 5-ти символов и не более 15 символов";
            return false;
        }
        if($this->checkUniq()) {
            $this->errors['uniqueness'] = "Такой пользователь существует";
            return false;
        }
        return true;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function checkUniq(){
        $sql = "
            SELECT 
                * 
            FROM " . self::TABLE . " 
            WHERE 
                username = '{$this->username}' OR email = '{$this->email}'
        ";
        
        $result = Database::query($sql);
        return $result;
    }

    public function save() {
        $data = [
            'username' => "'" . $this->username . "'",
            'email' => "'" . $this->email . "'",
            'password' => "'" . md5($this->password) . "'",
        ];
        
        Database::insert(self::TABLE, $data);
    }

    public function canAuthorize() {
        $hash = md5($this->password);
        $sql = "
            SELECT
                id
            FROM " . self::TABLE . "
            WHERE 
                username = '{$this->username}' and password = '$hash'
        ";
        $result = Database::query($sql);
        if(empty($result)) {
            return false;
        }
        $this->id =  $result[0]['id'];//обращение к свойсву\полю класса
        return true;       
    }

    public static function findByUuid($uuid): ?self {
        $sql = "
            SELECT
                id, username, email, password, uuid
            FROM " . self::TABLE . "
            WHERE uuid = '$uuid'
        ";
        $result = Database::query($sql);
        if($result) {
            $user = new self;
            $user->id = $result[0]['id'];
            $user->username = $result[0]['username'];
            $user->email = $result[0]['email'];
            $user->password = $result[0]['password'];

            return $user;
        }
    }

    public function updateUuid($uuid){
        $sql = "
            UPDATE " . self::TABLE . "
            SET uuid = '$uuid'
            WHERE id = {$this->id}
        "; 
        Database::query($sql);
    }
}











//$stm = self::$pdo->prepare("SELECT * FROM " . self::TABLE_REGISTERED . " WHERE uuid = '$uuid'");
//$stm->execute();