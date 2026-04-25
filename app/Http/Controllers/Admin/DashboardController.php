<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::with('sites')->orderByDesc('created_at')->get()
            ->map(function (User $user) {
                return [
                    'user'       => $user,
                    'site_count' => $user->sites->count(),
                    'storage_kb' => $user->sites->sum(fn($s) => $this->siteStorageKb($s->id)),
                ];
            });

        return view('admin.dashboard', compact('users'));
    }

    private function siteStorageKb(int $siteId): float
    {
        $path = Storage::disk('public')->path("sites/{$siteId}");
        if (! is_dir($path)) return 0;

        $size = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $file) {
            if ($file->isFile()) $size += $file->getSize();
        }
        return round($size / 1024, 1);
    }
}
