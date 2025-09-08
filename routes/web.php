<?php

use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\FileRequestUploadedController;
use App\Livewire\CreateFileRequest;
use App\Livewire\EditFile;
use App\Livewire\ManageFileRequests;
use App\Livewire\ManageFiles;
use App\Livewire\ManageFolders;
use App\Livewire\ManageTags;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\ShowFile;
use App\Livewire\UploadFile;
use App\Livewire\UploadFileRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');

Route::get('files/{file}/download', DownloadFileController::class)->name('files.download');
Route::get('requests/{fileRequest}/upload', UploadFileRequest::class)->name('requests.upload');
Route::get('requests/uploaded', FileRequestUploadedController::class)->name('requests.uploaded');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('tags', ManageTags::class)->name('tags.index');

    Route::get('folders', ManageFolders::class)->name('folders.index');
    Route::get('files', ManageFiles::class)->name('files.index');
    Route::get('files/upload', UploadFile::class)->name('files.upload');
    Route::get('files/{file}', ShowFile::class)->name('files.show');
    Route::get('files/{file}/edit', EditFile::class)->name('files.edit');

    Route::get('requests', ManageFileRequests::class)->name('requests.index');
    Route::get('requests/create', CreateFileRequest::class)->name('requests.create');
});

require __DIR__.'/auth.php';
