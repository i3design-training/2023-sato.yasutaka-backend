<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = false;
    // id 列のデータ型を指定
    protected $table = 'categories'; // テーブル名
    protected $keyType = 'string';
    protected $primaryKey = 'id'; // プライマリーキー
    public $timestamps = false; // タイムスタンプの自動更新を無効化
    protected $fillable = ['name'];
}
