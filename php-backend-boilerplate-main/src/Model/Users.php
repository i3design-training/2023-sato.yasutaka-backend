<?php

namespace App\Model;

// use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	// use HasUuids;
    // id 列を自動生成することを設定
    public $incrementing = false;
    // id 列のデータ型を指定
    protected $keyType = 'string';
    protected $dates = ['created_at', 'updated_at'];
    protected $table = 'users'; // テーブル名
    protected $primaryKey = 'id'; // プライマリーキー
    public $timestamps = true; // タイムスタンプの自動更新

    // テーブルのカラムとの対応関係を定義する
	protected $fillable = ['id', 'username', 'email', 'password', 'email_verified', 'created_at', 'updated_at'];

    // 追加のカスタムメソッドやリレーションシップの定義などを記述する
}
