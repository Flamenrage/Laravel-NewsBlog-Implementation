<?php


namespace App\Http\Controllers;


use App\Models\Country;
use App\Models\Post;
use App\Models\Rubric;
use App\Models\Tag;

class EloquentController extends Controller
{
    public function index(){
        /*$post = new Post();
       $post->title = 'Article 5';
       $post->content = 'This is a new article 5!';
       $post->save();*/
        //$data = Country::all(); // все записи
        $data = Country::query()->limit(5)->get(); // 5 записей, query нужен, чтобы IDE понимала, что в модели есть методы limit и get и тд
        $data_country = Country::find('AGO');
        //либо добавляем примесь в модель
        //dd($data);
        //Post::query()->create(['title' => 'Post 6', 'content' => 'This is a new article 6!']);
        //или $post = new Post(); $post->fill(/.../);
        /*
        ОБНОВЛЕНИЕ данных
        $post = Post::find(5);
        $post->content() = 'Some new text you may need';
        $post->save();*/
        /*Запрос с обновлением данных
        Post::where('id', '>', 3)->update(['updated_at' => NOW()]);
        */

        /*Удаление данных
        destroy или delete
        $post = Post::find(10);
        $post->delete(); объект null - выдаст exception
        Post::destroy(10); полное удаление, даже если объекта нет
        вместо 10 у destroy может быть массив айдишников [1, 2, 3] и тд
        */
        dd($data_country);
        $post = Post::query()->find(2);
        dump($post);
        $show_me = $post->rubric->title;
        dump($show_me);
        $rubric = Rubric::query()->find(1)->posts;
        $post_search = Post::query()->with('rubric')->where('id', '>', 1)->get();
        foreach ($post_search as $post){
            // dump($post->title, $post->rubric->title);
        }
        $post_many = Post::query()->find(1);
        dump($post_many->title);
        foreach ($post_many->tags as $tag) { //проходимся по тегам поста
            dump($tag->title);
        }
        $tag = Tag::query()->find(1);
        dump($tag->title);
        foreach ($tag->posts as $post) { //проходимся по тегам поста
            dump($post->title);
        }
        // dump($rubric);
    }
}
