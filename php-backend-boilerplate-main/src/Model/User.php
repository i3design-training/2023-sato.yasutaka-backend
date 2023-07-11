<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $incrementing = false;
    // id 列のデータ型を指定
    protected $table = 'users'; // テーブル名
    protected $keyType = 'string';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id'; // プライマリーキー
    public $timestamps = false; // タイムスタンプの自動更新

    // テーブルのカラムとの対応関係を定義する
	protected $fillable = ['username', 'email', 'password', 'email_verified'];

    public function emailVerification()
    {
        return $this->hasOne(EmailVerifications::class);
    }
}
