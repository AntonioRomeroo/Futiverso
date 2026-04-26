<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
})->name('inicio');

Route::get('/laliga', function () {
  return view('laliga');
})->name('laliga');

Route::get('/laligahypermotion', function () {
  return 'La Liga Hypermotion';
})->name('laligahypermotion');

Route::get('/seriea', function () {
  return 'Serie A';
})->name('seriea');

Route::get('/premierleague', function () {
  return 'Premier League';
})->name('premierleague');

Route::get('/league1', function () {
  return 'League 1';
})->name('league1');

Route::get('/bundesliga', function () {
  return 'Bundesliga';
})->name('bundesliga');

Route::get('/ligaargentina', function () {
  return 'Liga Argentina';
})->name('ligaargentina');

Route::get('/mas1', function () {
  return 'Más...';
})->name('mas1');

Route::get('/espana', function () {
  return 'España';
})->name('espana');

Route::get('/argentina', function () {
  return 'Argentina';
})->name('argentina');

Route::get('/brasil', function () {
  return 'Brasil';
})->name('brasil');

Route::get('/francia', function () {
  return 'Francia';
})->name('francia');

Route::get('/alemania', function () {
  return 'Alemania';
})->name('alemania');

Route::get('/italia', function () {
  return 'Italia';
})->name('italia');

Route::get('/inglaterra', function () {
  return 'Inglaterra';
})->name('inglaterra');

Route::get('/portugal', function () {
  return 'Portugal';
})->name('portugal');

Route::get('/mas2', function () {
  return 'Más...';
})->name('mas2');

Route::get('/anos90', function () {
  return 'Años 90';
})->name('anos90');

Route::get('/anos2000', function () {
  return 'Años 2000';
})->name('anos2000');

Route::get('/clasicas', function () {
  return 'Clásicas';
})->name('clasicas');

Route::get('/tallanino', function () {
  return 'Talla Niño';
})->name('tallanino');

Route::get('/cortos', function () {
  return 'Pantalones cortos';
})->name('cortos');

Route::get('/largos', function () {
  return 'Pantalones largos';
})->name('largos');

Route::get('/botas', function () {
  return 'Botas';
})->name('botas');

Route::get('/clubes', function () {
  return 'Bufandas clubes';
})->name('clubes');

Route::get('/selecciones', function () {
  return 'Bufandas selecciones';
})->name('selecciones');

Route::get('/retro', function () {
  return 'Bufandas retro';
})->name('retro');