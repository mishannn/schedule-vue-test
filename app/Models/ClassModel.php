<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClassModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereId($value)
 * @mixin \Eloquent
 * @property int $id
 * @property int $subject_id
 * @property int $teacher_id
 * @property int $room_id
 * @property int $type
 * @property boolean $repeated
 * @property int $week_num
 * @property int $day_num
 * @property int $class_num
 * @property Subject subject
 * @property Room $room
 * @property Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereClassNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereDayNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereRepeated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel whereWeekNum($value)
 */
class ClassModel extends Model {
    protected $table = 'classes';

    protected $fillable = ['subject_id', 'teacher_id', 'room_id', 'type', 'repeated', 'week_num', 'day_num', 'class_num'];

    public $timestamps = false;

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }
}