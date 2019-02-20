<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Validator;

class RoomsController extends Controller {
    /**
     * @return array
     * @throws ApiException
     */
    public function getAll() {
        try {
            return Room::all();
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
        $room = Room::whereId($id)->first();
        if (!isset($room)) {
            throw new ApiException('Объект не найден', 404);
        }

        return $room->toArray();
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
        if (Room::whereName($name)->exists()) {
            throw new ApiException('Объект уже существует', 400);
        }

        $room = new Room();
        $room->fill($request->all());
        if (!$room->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $room->toArray();
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

        $room = Room::whereId($id)->first();
        if (!isset($room)) {
            throw new ApiException('Объект не найден', 404);
        }

        $room->fill($request->all());
        if (!$room->save()) {
            throw new ApiException('Ошибка сохранения объекта', 500);
        }

        return $room->toArray();
    }

    /**
     * @param $id
     * @return array
     * @throws ApiException
     */
    public function delete($id) {
        $room = Room::whereId($id)->first();
        if (!isset($room)) {
            throw new ApiException('Объект не найден', 404);
        }

        try {
            $room->delete();
        } catch (Exception $exception) {
            throw new ApiException('Ошибка при удалении объекта' . $exception->getMessage(), 404);
        }

        return [
            'result' => 'OK',
        ];
    }
}