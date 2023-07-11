<?php

namespace App\Model;

// 他の必要なインポート文も追加する場合があります
use Illuminate\Database\Eloquent\Model;

class UserCreateModel
{
    public function registerUser($email, $password)
    {
        // パスワードのハッシュ化
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // データベースへの接続
        $pdo = new PDO('pgsql:host=localhost;dbname=users', 'username', 'password');

        // バリデーションなどのチェック
        if ($this->validateEmail($email)) {
            // データベースへのクエリの実行
            $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            // 登録が成功した場合の処理
            return true;
        } else {
            // バリデーションエラーの場合の処理
            return false;
        }
    }

    private function validateEmail($email)
    {
        // バリデーションルールに従ったチェックを行う
        // 例えば、正しいメールアドレス形式かどうかを確認するなど

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}
