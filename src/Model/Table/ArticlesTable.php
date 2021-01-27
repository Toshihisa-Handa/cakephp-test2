<?php
// src/Model/Table/ArticlesTable.php
//Table オブジェクトを ArticlesTable と名付けることで、CakePHP は、命名規則により articles テーブルを使用するモデルであると解釈
namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        // created や modified カラムを自動的に更新する Timestamp ビヘイビアー
        $this->addBehavior('Timestamp');
    }
}