<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Validator;

class TeachersController extends Controller {
    /**
     * @return array
     * @throws ApiException
     */
    public function getAll() {
        try {
            return Teacher::all();
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
        $teacher = Teacher::whereId($id)->first();
        if (!isset($teacher)) {
            throw new ApiException('Объект не найден', 404);
        }

        return $teacher->toArray();
    }

    /**
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:64|required',
        ]);

        if ($validator->fails()) {
            throw new ApiException('Неверные параметры запроса', 400);
        }

        $name = $request->get('name');
        if (Teacher::whereName($name)->exists()) {
            throw new ApiException('Объект уже существует', 400);
        }

        $teacher = new Teacher();
        $teacher->fill($request->all());
        if (!$teacher->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $teacher->toArray();
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function edit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:64|required',
        ]);

        if ($validator->fails()) {
            throw new ApiException('Неверные параметры запроса', 400);
        }

        $teacher = Teacher::whereId($id)->first();
        if (!isset($teacher)) {
            throw new ApiException('Объект не найден', 404);
        }

        $teacher->fill($request->all());
        if (!$teacher->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $teacher->toArray();
    }

    /**
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function delete($id) {
        $teacher = Teacher::whereId($id)->first();
        if (!isset($teacher)) {
            throw new ApiException('Объект не найден', 404);
        }

        try {
            $teacher->delete();
        } catch (Exception $exception) {
            throw new ApiException('Ошибка при удалении объекта' . $exception->getMessage(), 404);
        }

        return [
            'result' => 'OK',
        ];
    }
}