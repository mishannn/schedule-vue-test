<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\ClassModel;
use Exception;
use Illuminate\Http\Request;
use Validator;

class ClassesController extends Controller {
    /**
     * @return array
     * @throws ApiException
     */
    public function getAll() {
        try {
            return ClassModel::all();
        } catch (Exception $exception) {
            throw new ApiException($exception->getMessage(), 500);
        }
    }

    /**
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function get($id) {
        $class = ClassModel::whereId($id)->first();
        if (!isset($class)) {
            throw new ApiException('Объект не найден', 404);
        }

        return $class->toArray();
    }

    /**
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'integer|required',
            'teacher_id' => 'integer|required',
            'room_id' => 'integer|required',
            'type' => 'integer|required',
            'repeated' => 'boolean|required',
            'week_num' => 'integer|required',
            'day_num' => 'integer|required',
            'class_num' => 'integer|required',
        ]);

        if ($validator->fails()) {
            throw new ApiException('Неверные параметры запроса', 400);
        }

        $repeated = $request->get('name');
        $weekNum = $request->get('name');
        $dayNum = $request->get('name');
        $classNum = $request->get('name');

        $classExists = ClassModel::where([
            'repeated' => $repeated,
            'week_num' => $weekNum,
            'day_num' => $dayNum,
            'class_num' => $classNum
        ])->exists();

        if ($classExists) {
            throw new ApiException('Объект уже существует', 400);
        }

        $class = new ClassModel();
        $class->fill($request->all());
        try {
            $class->save();
        } catch (Exception $exception) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $class->toArray();
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function edit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'integer|required',
            'teacher_id' => 'integer|required',
            'room_id' => 'integer|required',
            'type' => 'integer|required',
            'repeated' => 'integer|required',
            'week_num' => 'integer|required',
            'day_num' => 'integer|required',
            'class_num' => 'integer|required',
        ]);

        if ($validator->fails()) {
            throw new ApiException('Неверные параметры запроса', 400);
        }

        $class = ClassModel::whereId($id)->first();
        if (!isset($class)) {
            throw new ApiException('Объект не найден', 404);
        }

        $class->fill($request->all());
        if (!$class->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $class->toArray();
    }

    /**
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function delete($id) {
        $class = ClassModel::whereId($id)->first();
        if (!isset($class)) {
            throw new ApiException('Объект не найден', 404);
        }

        try {
            $class->delete();
        } catch (Exception $exception) {
            throw new ApiException('Ошибка при удалении объекта' . $exception->getMessage(), 404);
        }

        return [
            'result' => 'OK',
        ];
    }
}