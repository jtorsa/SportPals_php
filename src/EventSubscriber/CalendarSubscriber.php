<?php

namespace App\EventSubscriber;

use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EventService;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CalendarSubscriber extends AbstractController implements EventSubscriberInterface 
{

    private  $eventoService;
    private $security;

    public function __construct(EventService $eventoService, Security $security)
    {
        $this->eventoService = $eventoService;
        $this->security = $security;
    }
    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $user = $this->security->getUser();
        if(!$user){
            return $this->redirectToRoute('index');
        }
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();
        
        // You may want to make a custom query from your database to fill the calendar
        $eventos = $this->eventoService->getEventsByUser($user);
        foreach($eventos as $evento){
            $inicio = new \DateTime (date_format($evento->getDia(),'Y-m-d').date_format($evento->getInicio(),'H:i:s'));
            $final = new \DateTime (date_format($evento->getDia(),'Y-m-d').date_format($evento->getFinal(),'H:i:s'));
            $calendar->addEvent(new Event(
                $evento->getTitle(),
                $inicio,
                $final
            ));
        }
    }
}