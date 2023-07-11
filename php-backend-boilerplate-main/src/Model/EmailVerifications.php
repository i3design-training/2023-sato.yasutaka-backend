<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class EmailVerifications extends Model
{
    public $incrementing = false;
    // id 列のデータ型を指定
    protected $table = 'email_verifications'; // テーブル名
    protected $keyType = 'string';
    protected $dates = ['created_at'];
    protected $primaryKey = 'id'; // プライマリーキー
    public $timestamps = false; // タイムスタンプの自動更新

    // テーブルのカラムとの対応関係を定義する
	protected $fillable = ['user_id', 'token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
