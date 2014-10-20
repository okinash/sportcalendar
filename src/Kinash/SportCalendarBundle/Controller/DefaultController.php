<?php

namespace Kinash\SportCalendarBundle\Controller;
use Kinash\SportCalendarBundle\Service\SportCalendar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kinash\SportCalendarBundle\Entity\ExerciseRepository;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $service = $this->get('sport_calendar_service');
        $user = $this->get('security.context')->getToken()->getUser();
        $exercises = $service->getData($user);
        $twoWeeksExercises = $exercises[SportCalendar::TWO_WEEKS_AGO];
        $oneWeeksExercises = $exercises[SportCalendar::WEEK_AGO];
        $todayExercises = $exercises[SportCalendar::WEEK_AGO];
        $data = array(
            'blockTwoWeeksAgo' => $this->renderView('SportCalendarBundle:Default:list.html.twig',array('items'=>$twoWeeksExercises)),
            'blockWeekAgo' => $this->renderView('SportCalendarBundle:Default:list.html.twig',array('items'=>$oneWeeksExercises)),
            'blockToday' => $this->renderView('SportCalendarBundle:Default:list.html.twig',array('items'=>$todayExercises))
        );
        return $this->render('SportCalendarBundle:Default:index.html.twig', $data);
    }
}
