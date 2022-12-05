<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MemberController::class, 'index']);
Route::get('member', [MemberController::class, 'member'])->name('member');
Route::get('member/create', [MemberController::class, 'create'])->name('member.create');
Route::get('member/edit/{code}', [MemberController::class, 'edit'])->name('member.edit');
Route::post('member/store', [MemberController::class, 'store'])->name('member.store');
Route::post('member/update/{code}', [MemberController::class, 'update'])->name('member.update');
Route::get('bonus', [MemberController::class, 'bonus']);
Route::post('bonus/show', [MemberController::class, 'show'])->name('bonus.show');
Route::get('migrasi', [MemberController::class, 'migrasi'])->name('migrasi');

