<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Validator;

class SubjectsController extends Controller {
    /**
     * @return array
     * @throws ApiException
     */
    public function getAll() {
        try {
            return Subject::all();
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
        $subject = Subject::whereId($id)->first();
        if (!isset($subject)) {
            throw new ApiException('Объект не найден', 404);
        }

        return $subject->toArray();
    }

    /**
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|required',
        ]);

        if ($validator->fails()) {
            throw new ApiException('Неверные параметры запроса', 400);
        }

        $name = $request->get('name');
        if (Subject::whereName($name)->exists()) {
            throw new ApiException('Объект уже существует', 400);
        }

        $subject = new Subject();
        $subject->fill($request->all());
        if (!$subject->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $subject->toArray();
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function edit(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|required',
        ]);

        if ($validator->fails()) {
            throw new ApiException('Неверные параметры запроса', 400);
        }

        $subject = Subject::whereId($id)->first();
        if (!isset($subject)) {
            throw new ApiException('Объект не найден', 404);
        }

        $subject->fill($request->all());
        if (!$subject->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $subject->toArray();
    }

    /**
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function delete($id) {
        $subject = Subject::whereId($id)->first();
        if (!isset($subject)) {
            throw new ApiException('Объект не найден', 404);
        }

        try {
            $subject->delete();
        } catch (Exception $exception) {
            throw new ApiException('Ошибка при удалении объекта' . $exception->getMessage(), 404);
        }

        return [
            'result' => 'OK',
        ];
    }
}