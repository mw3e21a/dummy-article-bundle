<?php
/**
 * Created by PhpStorm.
 * User: Michał
 * Date: 07.03.2019
 * Time: 09:27
 */

namespace Mwil\DummyArticleBundle\Event;


final class MwilDummyArticleEvents
{
    /**
     * Called directly before the Dummy Article Api data is returned.
     *
     * Listeners have the opportunity to change that data
     *
     * @Event("Mwil\DummyArticleBundle\Event\FilterApiResponseEvent")
     */
    const FILTER_API = 'mwil_dummy_article.filter_api';
}