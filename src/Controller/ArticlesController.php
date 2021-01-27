<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController
{
    //indexのURL読取り時にarticleテーブルの内容をビューへ渡している。
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
    //indexページの記事のタイトルリンクをクリックした際に記事ページに飛べるように
    //対になるビューはsrc/Template/Articles/view.ctp
    //???この記述のどこの部分でview.ctpの名前に紐づくようになっているのか。以下のfunction名をview2にしてview.ctpの名前をview2.ctpにしたがエラーになった。
    public function view($slug = null)
{
    $article = $this->Articles->findBySlug($slug)->firstOrFail();
    $this->set(compact('article'));
}
}