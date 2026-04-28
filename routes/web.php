<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
})->name('inicio');

Route::get('/laliga', function () {
  return view('laliga');
})->name('laliga');

Route::get('/laligahypermotion', function () {
  return view('laligahypermotion');
})->name('laligahypermotion');

Route::get('/seriea', function () {
  return view('seriea');
})->name('seriea');

Route::get('/premierleague', function () {
  return view('premierleague');
})->name('premierleague');

Route::get('/league1', function () {
  return view('league1');
})->name('league1');

Route::get('/bundesliga', function () {
  return view('bundesliga');
})->name('bundesliga');

Route::get('/ligaargentina', function () {
  return view('ligaargentina');
})->name('ligaargentina');

Route::get('/mas1', function () {
  return view('mas1');
})->name('mas1');

Route::get('/espana', function () {
  return view('espana');
})->name('espana');

Route::get('/argentina', function () {
  return view('argentina');
})->name('argentina');

Route::get('/brasil', function () {
  return view('brasil');
})->name('brasil');

Route::get('/francia', function () {
  return view('francia');
})->name('francia');

Route::get('/alemania', function () {
  return view('alemania');
})->name('alemania');

Route::get('/italia', function () {
  return view('italia');
})->name('italia');

Route::get('/inglaterra', function () {
  return view('inglaterra');
})->name('inglaterra');

Route::get('/portugal', function () {
  return view('portugal');
})->name('portugal');

Route::get('/mas2', function () {
  return view('mas2');
})->name('mas2');

Route::get('/anos90', function () {
  return view('anos90');
})->name('anos90');

Route::get('/anos2000', function () {
  return view('anos2000');
})->name('anos2000');

Route::get('/clasicas', function () {
  return view('clasicas');
})->name('clasicas');

Route::get('/tallanino', function () {
  return view('tallanino');
})->name('tallanino');

Route::get('/cortos', function () {
  return view('cortos');
})->name('cortos');

Route::get('/largos', function () {
  return view('largos');
})->name('largos');

Route::get('/botas', function () {
  return view('botas');
})->name('botas');

Route::get('/clubes', function () {
  return view('clubes');
})->name('clubes');

Route::get('/selecciones', function () {
  return view('selecciones');
})->name('selecciones');

Route::get('/retro', function () {
  return view('retro');
})->name('retro');