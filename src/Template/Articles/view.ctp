<!-- File: src/Template/Articles/view.ctp -->
<!-- article/indexページの記事タイトルをクリックした際に飛ぶ記事詳細ページ -->
<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><small>作成日時: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>