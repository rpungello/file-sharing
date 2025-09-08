<?php

use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\FileRequestUploadedController;
use App\Livewire\CreateContact;
use App\Livewire\CreateFileRequest;
use App\Livewire\EditContact;
use App\Livewire\EditFile;
use App\Livewire\ManageContacts;
use App\Livewire\ManageFileRequests;
use App\Livewire\ManageFiles;
use App\Livewire\ManageFolders;
use App\Livewire\ManageTags;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\ShowFile;
use App\Livewire\ShowFolder;
use App\Livewire\UploadFile;
use App\Livewire\UploadFileRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');

Route::get('files/{file}/download', DownloadFileController::class)->name('files.download');
Route::get('requests/{fileRequest}/upload', UploadFileRequest::class)->name('requests.upload');
Route::get('requests/uploaded', FileRequestUploadedController::class)->name('requests.uploaded');

Route::middleware(['auth', 'approved'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('tags', ManageTags::class)->name('tags.index');

    Route::get('folders', ManageFolders::class)->name('folders.index');
    Route::get('folders/{folder}', ShowFolder::class)->name('folders.show');
    Route::get('files', ManageFiles::class)->name('files.index');
    Route::get('files/upload', UploadFile::class)->name('files.upload');
    Route::get('files/{file}', ShowFile::class)->name('files.show');
    Route::get('files/{file}/edit', EditFile::class)->name('files.edit');

    Route::get('requests', ManageFileRequests::class)->name('requests.index');
    Route::get('requests/create', CreateFileRequest::class)->name('requests.create');

    Route::get('contacts', ManageContacts::class)->name('contacts.index');
    Route::get('contacts/create', CreateContact::class)->name('contacts.create');
    Route::get('contacts/{contact}/edit', EditContact::class)->name('contacts.edit');
});

require __DIR__.'/auth.php';
