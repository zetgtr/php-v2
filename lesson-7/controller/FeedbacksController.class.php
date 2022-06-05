<?php
class FeedbacksController extends Controller
{
    /**
     * Страница отзывов '/feedbacks.php'
     */
    public function index() {
        $this->title .= ' | Отзывы';
        $template = $this->twig -> loadTemplate('feedbacks.twig');
        $feedbacks = $this->page-> feedbacks('опубликован');
        $this->content = $template -> render(array('feedbacks' => $feedbacks));
    }
}