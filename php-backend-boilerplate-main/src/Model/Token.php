<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $incrementing = false;
    // id 列のデータ型を指定
    protected $table = 'tokens'; // テーブル名
    protected $keyType = 'string';
    protected $primaryKey = 'id'; // プライマリーキー
    public $timestamps = false; // タイムスタンプの自動更新


    // テーブルのカラムとの対応関係を定義する
	protected $fillable = ['user_id', 'token','expiry_date'];

    // User モデルとの関連を定義する
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
