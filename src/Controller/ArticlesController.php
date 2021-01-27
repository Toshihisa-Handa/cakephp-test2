<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Controller\AppController;//追加

class ArticlesController extends AppController
{
    public function initialize()//追加
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // FlashComponent をインクルード
    }



    //indexのURL読取り時にarticleテーブルの内容をビューへ渡している。
    public function index()
    {
        // $this->loadComponent('Paginator'); function initalizeに記述が引っ越しになっている
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }


    //indexページの記事のタイトルリンクをクリックした際に記事ページに飛べるように
    //対になるビューはsrc/Template/Articles/view.ctp
    //???この記述のどこの部分でview.ctpの名前に紐づくようになっているのか。以下のfunction名をview2にしてview.ctpの名前をview2.ctpにしたがエラーになった。
    // public function view($slug = null)
    public function views($slug)//=nullが削除されている
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    public function add()//追加
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            // user_id の決め打ちは一時的なもので、あとで認証を構築する際に削除されます。
            $article->user_id = 1;

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
    }


    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
    
        $this->set('article', $article);
    }

    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);
    
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }

}