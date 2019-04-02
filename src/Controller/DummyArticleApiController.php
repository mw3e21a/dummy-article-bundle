<?php


namespace Mwil\DummyArticleBundle\Controller;

use Mwil\DummyArticleBundle\Event\FilterApiResponseEvent;
use Mwil\DummyArticleBundle\Event\MwilDummyArticleEvents;
use Mwil\DummyArticleBundle\MwilDummyArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class DummyArticleApiController extends AbstractController
{

    private $mwilDummyArticle;

    private $eventDispatcher;

    public function __construct(MwilDummyArticle $mwilDummyArticle, EventDispatcherInterface $eventDispatcher = null)
    {
        $this->mwilDummyArticle = $mwilDummyArticle;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function index()
    {

        $data = [
            'paragraphs' => $this->mwilDummyArticle->getParagraphs(),
            'sentences' => $this->mwilDummyArticle->getSentences(),
        ];

        $event = new FilterApiResponseEvent($data);
        if($this->eventDispatcher){
            $this->eventDispatcher->dispatch(MwilDummyArticleEvents::FILTER_API, $event);
        }


        return $this->json($event->getData());

    }

}