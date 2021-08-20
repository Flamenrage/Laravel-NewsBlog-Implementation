<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Post
 * @package App\Models
 * @mixin Builder
 */

class Post extends Model
{
    use HasFactory;
    // protected $table = 'my_posts'; //если таблица в БД и в модели называется по-разному
   // protected $primaryKey = 'post_id'; //если id в БД по-другому
   // public $incrementing = false; //поле id (code) не инкрементируемле
   // protected $keyType = 'string'; // поле code - строка
    //Eloquent по умолчанию ожидает от наших таблиц поля created и updated, если мы не хотим автоматического заполнения
    //этих полей, то пишем следующее: public $timestamps = false;
    protected $attributes = [
       // 'content' => 'some text', //если поле content пустое, то пишем эту заглушку
        ]; //для заполнения чего-либо в таблице автоматически

    protected $fillable = ['title', 'content', 'rubric_id'];
    public function rubric(){
        return $this->belongsTo(Rubric::class); // one to many, пост принадлежит рубрике
    }
    public function tags(){
        return $this->belongsToMany(Tag::class); //many to many
    }
    public function getFirstDate(){
        /*\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d M Y')*/
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    public function getIntlDate(){
        $formatter = new \IntlDateFormatter('ru-RU', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
        $formatter->setPattern('d MMM y');
        return $formatter->format(new \DateTime($this->created_at));

    }
    public function SetTitleAttribute($value) {
        $this->attributes['title'] = Str::title($value);
    }

    public function GetTitleAttribute($value) {
        return Str::upper($value); //возвращаем название на КАПСЕ
    }
}
