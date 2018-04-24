<?php

Route::get('/', 'Dota2Controller@getIndex')->name('dota2Index');
Route::get('/{gameId}', 'Dota2Controller@getInfo')->name('dota2Info');