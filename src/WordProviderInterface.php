<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 01.03.2019
 * Time: 10:15
 */

namespace Mwil\DummyArticleBundle;


interface WordProviderInterface
{
    /**
     * Returns an array of text used to generate dummy Article
     * @return array
     *
     */

    public function getWordList(): array;

}