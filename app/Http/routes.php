<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('projetos', ['as'=>'projetos.index', 'uses'=>'Projetos\ProjetosController@index']);

Route::get('projetos/create', ['as'=>'projetos.create', 'uses'=>'Projetos\ProjetosController@create']);

Route::post('projetos/store', ['as'=>'projetos.store', 'uses'=>'Projetos\ProjetosController@store']);

Route::get('projetos/edit/{id}', ['as'=>'projetos.edit', 'uses'=>'Projetos\ProjetosController@edit']);

Route::put('projetos/update/{id}', ['as'=>'projetos.update', 'uses'=>'Projetos\ProjetosController@update']);

Route::get('projetos/destroy/{id}', ['as'=>'projetos.destroy', 'uses'=>'Projetos\ProjetosController@destroy']);


Route::get('aplicacoes', ['as'=>'aplicacoes.index', 'uses'=>'Aplicacoes\AplicacoesController@index']);

Route::get('aplicacoes/create', ['as'=>'aplicacoes.create', 'uses'=>'Aplicacoes\AplicacoesController@create']);

Route::post('aplicacoes/store', ['as'=>'aplicacoes.store', 'uses'=>'Aplicacoes\AplicacoesController@store']);

Route::get('aplicacoes/edit/{id}', ['as'=>'aplicacoes.edit', 'uses'=>'Aplicacoes\AplicacoesController@edit']);

Route::put('aplicacoes/update/{id}', ['as'=>'aplicacoes.update', 'uses'=>'Aplicacoes\AplicacoesController@update']);

Route::get('aplicacoes/destroy/{id}', ['as'=>'aplicacoes.destroy', 'uses'=>'Aplicacoes\AplicacoesController@destroy']);
