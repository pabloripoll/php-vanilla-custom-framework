<?php

use Config\Route;
use App\Controller\ApiController;

/**
 * API routes
 */

// Tests database connection
Route::post('/api/test/postgre', [ApiController::class, 'testPostgre']);
Route::post('/api/test/mysql', [ApiController::class, 'testMysql']);
Route::post('/api/test/mongodb', [ApiController::class, 'testMongodb']);
Route::post('/api/test/mongodb', [ApiController::class, 'insertMongodb']);
Route::post('/api/test/redis', [ApiController::class, 'testRedis']);

// Tests mail service
Route::post('/api/test/mail', [ApiController::class, 'testMail']);
// Tests message broker connection
Route::post('/api/test/queue', [ApiController::class, 'testQueue']);

// Example
Route::get('/api/users/{id}', [ApiController::class, 'show'], ['AuthMiddleware']);
Route::post('/api/users/{id}/notes', [ApiController::class, 'addNote'], ['AuthMiddleware']);
