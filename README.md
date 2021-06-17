<p>API REST PARA PARCIAL 3 DE CALIDAD DE SOFTWARE</p>
<p>Desarrollado por Roberto Pérez para un examen</p>

<p>ENDPOINT A CONSULTAR:</p>

<p>
<!-- CRUD DE FESTIVALES -->
Route::resource('festival', FestivalController::class);
<!-- CRUD DE SALAS -->
Route::resource('sala', SalaController::class);
<!-- CRUD DE TEATROS -->
Route::resource('teatro', TeatroController::class);
<!-- CRUD DE PELICULAS -->
Route::resource('pelicula', PeliculaController::class);
<!-- CRUD DE BOLETAS -->
Route::resource('boleta', BoletaController::class);
<!-- CRUD DE HORARIO -->
Route::resource('horario', HorarioController::class);
<!-- CRUD DE CLIENTE -->
Route::resource('cliente', ClienteController::class);


<!-- Asignaciones many to many -->
Route::post('/festival/teatro', [FestivalController::class, 'sincronizarFestivalTeatro']);
Route::post('/pelicula/horario', [HorarioController::class, 'sincronizarHorarioPelicula']);
Route::post('/pelicula/salas', [PeliculaController::class, 'sincronizarPeliculaSala']);


</p>
