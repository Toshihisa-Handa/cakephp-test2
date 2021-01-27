<?php
// src/Model/Entity/Article.php
//エンティティーは、 データベースの１つのレコードを表し、データに対して行レベルの振る舞いを提供

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}