<?php

namespace Kinash\SportCalendarBundle\Tests\Service;

use Kinash\SportCalendarBundle\Service\Calendar;
use Kinash\SportCalendarBundle\Service\SportCalendar;


class SportCalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $user = $this->getMock('\Kinash\SportCalendarBundle\Entity\User');

        #change this date to current Date
        $date = new \DateTimeImmutable('2014-10-21');
        $oneWeekAgo = $date->modify('1 week ago');
        $twoWeeksAgo = $date->modify('2 weeks ago');

        #mock exercises for return value
        $mockExercise1 =  $this->getMock('\Kinash\SportCalendarBundle\Entity\Exercise', NULL);
        $mockExercise1->setDate($date);

        $mockExercise2 =  $this->getMock('\Kinash\SportCalendarBundle\Entity\Exercise', NULL);
        $mockExercise2->setDate($oneWeekAgo);

        $mockExercise3 =  $this->getMock('\Kinash\SportCalendarBundle\Entity\Exercise', NULL);
        $mockExercise3->setDate($twoWeeksAgo);

        $mockExercise4 =  $this->getMock('\Kinash\SportCalendarBundle\Entity\Exercise', NULL);
        $mockExercise4->setDate($twoWeeksAgo);
        #this array will be returned by mock of getTrainingData method
        $mockExercises = array($mockExercise1, $mockExercise2, $mockExercise3, $mockExercise4);


        $datesArray = array($date->format('Y-m-d'), $oneWeekAgo->format('Y-m-d'), $twoWeeksAgo->format('Y-m-d'));

        $exerciseRepository = $this->getMockBuilder('\Kinash\SportCalendarBundle\Entity\ExerciseRepository')
           ->disableOriginalConstructor()
           ->getMock();

        $exerciseRepository->expects($this->once())
            ->method('getTrainingData')
            ->with($user, $datesArray)
            ->will($this->returnValue($mockExercises)
            );

       #create service with mocked Repo and call getData method
       $calendar = new SportCalendar($exerciseRepository);
       $actual = $calendar->getData($user);

       #check how our Exercise mocks were divided
       $this->assertEquals(1, count($actual[SportCalendar::TODAY ]));
       $this->assertEquals(1, count($actual[SportCalendar::WEEK_AGO ]));
       $this->assertEquals(2, count($actual[SportCalendar::TWO_WEEKS_AGO ]));
    }
}