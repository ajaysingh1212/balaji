<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UploadService
{
    public static function storePublicFile(UploadedFile $file, string $folder = 'uploads'): string
    {
        $relativeFolder = trim($folder, '/');
        $targetDirectory = public_path($relativeFolder);

        if (! File::exists($targetDirectory)) {
            File::makeDirectory($targetDirectory, 0755, true, true);
        }

        $fileName = sprintf('%s.%s', Str::uuid(), $file->getClientOriginalExtension());

        $file->move($targetDirectory, $fileName);

        return $relativeFolder ? $relativeFolder . '/' . $fileName : $fileName;
    }

    public static function resolvePublicPath(?string $path, ?string $fallbackPath = null): string
    {
        if (empty($path)) {
            return public_path($fallbackPath ?? 'images/logo.png');
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $normalizedPath = ltrim($path, '/');
        $candidates = [$normalizedPath];

        if (! Str::startsWith($normalizedPath, 'storage/')) {
            $candidates[] = 'storage/' . $normalizedPath;
        } else {
            $candidates[] = Str::replaceFirst('storage/', '', $normalizedPath);
        }

        foreach ($candidates as $candidate) {
            $fullPath = public_path($candidate);
            if (File::exists($fullPath)) {
                return $fullPath;
            }
        }

        return public_path($normalizedPath);
    }

    public static function deletePublicFile(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}
