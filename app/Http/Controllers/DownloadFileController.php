<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DownloadFileController extends Controller
{
    public function __invoke(Request $request, File $file): Response
    {
        if ($file->download_token !== $request->input('token')) {
            abort(403);
        }

        $file->downloads()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->away(
            Storage::temporaryUrl(
                $file->path,
                now()->addMinutes(5),
                [
                    'ResponseContentDisposition' => 'attachment; filename="'.$file->filename.'"',
                ]
            ),
        );
    }
}
