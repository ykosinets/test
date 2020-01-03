<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * SearchForm is the model behind the search form.
 */
class SearchForm extends Model
{
    public $category;
    public $location;
    public $search;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, location and search are required
            [['category', 'location', 'search'], 'required'],
        ];
    }

    /**
     *
     * @return bool whether the request is completed
     */
    public function sendSearchRequest()
    {
        return false;
    }
}
