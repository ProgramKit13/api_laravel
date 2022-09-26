<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/ping', function() {
    return[
        'pong' => true
    ];
});

/* CRUD DO TODO
    ** POST = INSERIR UMA TAREFA NO SISTEMA
    ** GET = LER TODAS AS TAREFAS DO SISTEMA
    ** PUT = AQUALIZAR UMA TAREFA DO SISTEMA
    ** DELETE = DELETAR UMA TAREFA DO SISTEMA
*/

Route::post('/todo', [ApiController::class, 'createTodo']);
Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);
Route::put('/todo/{id}', [ApiController::class, 'updateTodo']);
Route::delete('/todo/{id}', [ApiController::class, 'deleteTodo']);
