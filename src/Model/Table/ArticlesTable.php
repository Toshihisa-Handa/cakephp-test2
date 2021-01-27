<?php
// src/Model/Table/ArticlesTable.php
//Table オブジェクトを ArticlesTable と名付けることで、CakePHP は、命名規則により articles テーブルを使用するモデルであると解釈
namespace App\Model\Table;
use Cake\Validation\Validator;

use Cake\ORM\Table;

use Cake\Utility\Text;


class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        // created や modified カラムを自動的に更新する Timestamp ビヘイビアー
        $this->addBehavior('Timestamp');
    }


    //記事の保存の記述
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // スラグをスキーマで定義されている最大長に調整
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

    //バリデーションチェックを入れる記述
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmptyString('title', false)
            ->minLength('title', 10)
            ->maxLength('title', 255)
    
            ->allowEmptyString('body', false)
            ->minLength('body', 10);
    
        return $validator;
    }



    
}