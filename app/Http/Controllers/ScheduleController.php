<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Helpers\ScheduleHelper;
use App\Models\ClassModel;
use App\Models\Subject;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Validator;

class ScheduleController extends Controller {
    /**
     * @return array
     * @throws Exception
     */
    public function schedule() {
        $dateTimeFormat = 'Y-m-d';
        $dateTime = DateTime::createFromFormat($dateTimeFormat, '2019-02-11');

        $schedule = [];

        $classItems = ClassModel::with('subject')->with('teacher')->with('room')->get()->all();

        for ($week = 1; $week <= 20; $week++) {
            for ($day = 1; $day <= 7; $day++) {
                $classes = [];

                for ($class = 1; $class <= 6; $class++) {
                    $classItem = ScheduleHelper::findClassModel(0, $week, $day, $class, $classItems);
                    if (isset($classItem)) {
                        $classes[$class] = ScheduleHelper::convertClassItem($classItem);
                        continue;
                    }

                    $classItem = ScheduleHelper::findClassModel(1, $week % 2, $day, $class, $classItems);
                    if (isset($classItem)) {
                        $classes[$class] = ScheduleHelper::convertClassItem($classItem);
                    }
                }

                $schedule[] = [
                    'date' => $dateTime->format($dateTimeFormat),
                    'week' => $week,
                    'day' => $day,
                    'classes' => $classes,
                ];

                $dateTime->add(new DateInterval('P1D'));
            }
        }

        return $schedule;
    }
}