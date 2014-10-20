<?php

namespace Kinash\SportCalendarBundle\Service;
use Doctrine\ORM\EntityRepository;
use Kinash\SportCalendarBundle\Entity\User;

class SportCalendar
{
    /** @var EntityRepository */
    protected $repository;
    const TODAY = 'today';
    const WEEK_AGO = 'weekAgo';
    const TWO_WEEKS_AGO = '2WeeksAgo';

    public function __construct(EntityRepository $entityRepository)
    {
        $this->repository = $entityRepository;
    }

    /**
     * Get exercises results
     *
     * @param User $user
     * @return array
     */
    public function getData(User $user)
    {
        $dateToday  = date('Y-m-d');
        $dateWeeksAgo = (new \DateTime('-1 WEEK'))->format('Y-m-d');
        $date2WeeksAgo = (new \DateTime('-2 WEEK'))->format('Y-m-d');

        $data =  $this->repository->getTrainingData($user, array($dateToday, $dateWeeksAgo, $date2WeeksAgo));

        $todayExercises = array();
        $weekAgoExercises = array();
        $twoWeeksAgoExercise = array();

        foreach($data as $row) {
            switch($row->getDate()->format('Y-m-d')) {
                case $dateToday:
                    $todayExercises[] = $row;
                    break;
                case $dateWeeksAgo:
                    $weekAgoExercises[] = $row;
                    break;
                case $date2WeeksAgo:
                    $twoWeeksAgoExercise[] = $row;
                    break;
            }
        }
        return array(
            self::TODAY => $todayExercises,
            self::WEEK_AGO => $weekAgoExercises,
            self::TWO_WEEKS_AGO => $twoWeeksAgoExercise,
        );
    }
}