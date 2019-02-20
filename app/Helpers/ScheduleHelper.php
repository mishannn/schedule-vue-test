<?php

namespace App\Helpers;

use App\Models\ClassModel;

class ScheduleHelper {
    /**
     * @param ClassModel $classItem
     * @return array
     */
    public static function convertClassItem($classItem) {
        $typeNames = [
            1 => 'лек',
            2 => 'пр',
            3 => 'лаб'
        ];

        return [
            'subject' => $classItem->subject->name,
            'teacher' => $classItem->teacher->name,
            'type' => $typeNames[$classItem->type],
            'room' => $classItem->room->name,
        ];
    }

    /**
     * @param int $repeated
     * @param int $week
     * @param int $day
     * @param int $class
     * @param ClassModel[] $classItems
     * @return ClassModel|null
     */
    public static function findClassModel($repeated, $week, $day, $class, $classItems) {
        foreach ($classItems as $classItem) {
            if ($classItem->repeated === $repeated && $classItem->week_num === $week
                && $classItem->day_num === $day && $classItem->class_num === $class) {
                return $classItem;
            }
        }

        return null;
    }
}