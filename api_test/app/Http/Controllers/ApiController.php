<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
    public function createTodo(Request $request) {
        $array = ['error' => ''];

        $rules = [
            'title' => 'required|min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $title = $request->input('title');

        $todo = new Todo();
        $todo->title = $title;
        $todo->save();

        return $array;
    }

    public function readAllTodos() {
        $array = ['error' => ''];

        $array['list'] = Todo::all();

        return $array;
    }

    public function readTodo($id) {
        $array = ['error' => ''];

       $todo = Todo::find($id);

       if($todo) {
        $array['todo'] = $todo;
       } else {
        $array['error'] = 'A tarefa '.$id.' não existe';
       }

       return $array;


    }

    public function updateTodo($id, Request $request) {
        $array = ['error' => ''];

        $rules = [
            'title' => 'min:3',
            'done' => 'boolean'
        ];

        $validador = Validator::make($request->all(), $rules);


        if($validador->fails()) {
            $array['error'] = $validador->messages();
            return $array;
        }

        $title = $request->input('title');
        $done = $request->input('done');



        $todo = Todo::find($id);
        if($todo) {

            if($title) {
                $todo->title = $title;
            }

            if($done !== null) {
                $todo->done = $done;
            }

            $todo->save();

        } else {
            $array['error'] = 'Tarefa '.$id.' não existe.';
        }

        return $array;
    }

    public function deleteTodo($id) {
        $array = ['error' => ''];

        $todo = Todo::find($id);
        $todo->delete();

        $todo->destroy($id);

        return $array;

    }
}
