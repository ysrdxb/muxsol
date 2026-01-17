<?php

namespace App\Services\Admin;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaService
{
    public function upload(UploadedFile $file, string $folder = '/', ?int $userId = null): Media
    {
        $userId = $userId ?? auth()->id();
        $disk = 'public';

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        $fileName = $this->generateUniqueFileName($originalName);
        $folderPath = trim($folder, '/');
        $path = $folderPath ? "{$folderPath}/{$fileName}" : $fileName;

        // Store the file
        $file->storeAs($folderPath, $fileName, $disk);

        $dimensions = null;
        if (str_starts_with($mimeType, 'image/')) {
            $dimensions = $this->getImageDimensions($disk, $path);
            $this->createThumbnail($disk, $path);
        }

        return Media::create([
            'name' => pathinfo($originalName, PATHINFO_FILENAME),
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'path' => $path,
            'disk' => $disk,
            'size' => $size,
            'dimensions' => $dimensions,
            'folder' => '/' . $folderPath,
            'uploaded_by' => $userId,
        ]);
    }

    public function uploadMultiple(array $files, string $folder = '/', ?int $userId = null): array
    {
        $media = [];
        foreach ($files as $file) {
            $media[] = $this->upload($file, $folder, $userId);
        }
        return $media;
    }

    public function delete(Media $media): bool
    {
        return $media->delete();
    }

    public function move(Media $media, string $newFolder): Media
    {
        $newFolder = '/' . trim($newFolder, '/');
        $oldPath = $media->path;
        $newPath = trim($newFolder, '/') . '/' . $media->file_name;

        Storage::disk($media->disk)->move($oldPath, $newPath);

        // Move thumbnail if exists
        if ($media->isImage()) {
            $oldThumb = $this->getThumbnailPath($oldPath);
            $newThumb = $this->getThumbnailPath($newPath);
            if (Storage::disk($media->disk)->exists($oldThumb)) {
                Storage::disk($media->disk)->move($oldThumb, $newThumb);
            }
        }

        $media->update([
            'path' => $newPath,
            'folder' => $newFolder,
        ]);

        return $media;
    }

    public function rename(Media $media, string $newName): Media
    {
        $media->update(['name' => $newName]);
        return $media;
    }

    public function updateAltText(Media $media, string $altText): Media
    {
        $media->update(['alt_text' => $altText]);
        return $media;
    }

    protected function generateUniqueFileName(string $originalName): string
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $name = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $timestamp = now()->format('YmdHis');
        $random = Str::random(6);

        return "{$name}-{$timestamp}-{$random}.{$extension}";
    }

    protected function getImageDimensions(string $disk, string $path): ?array
    {
        try {
            $fullPath = Storage::disk($disk)->path($path);
            $imageSize = getimagesize($fullPath);

            if ($imageSize) {
                return [
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                ];
            }
        } catch (\Exception $e) {
            // Silently fail
        }

        return null;
    }

    protected function createThumbnail(string $disk, string $path): void
    {
        try {
            $fullPath = Storage::disk($disk)->path($path);
            $thumbPath = Storage::disk($disk)->path($this->getThumbnailPath($path));

            // Create thumbnail using intervention/image or simple copy
            if (class_exists(Image::class)) {
                $image = Image::read($fullPath);
                $image->cover(300, 300);
                $image->save($thumbPath);
            }
        } catch (\Exception $e) {
            // Silently fail - thumbnail is optional
        }
    }

    protected function getThumbnailPath(string $path): string
    {
        $info = pathinfo($path);
        return $info['dirname'] . '/' . $info['filename'] . '_thumb.' . $info['extension'];
    }
}
