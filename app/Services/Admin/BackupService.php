<?php

namespace App\Services\Admin;

use App\Enums\BackupStatus;
use App\Enums\BackupType;
use App\Models\Backup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BackupService
{
    public function create(BackupType $type, User $user): Backup
    {
        $name = $type->value . '_backup_' . now()->format('Y-m-d_H-i-s');
        $path = 'backups/' . $name . '.zip';

        $backup = Backup::create([
            'name' => $name,
            'type' => $type,
            'path' => $path,
            'size' => 0,
            'status' => BackupStatus::PROCESSING,
            'created_by' => $user->id,
        ]);

        try {
            $fullPath = storage_path('app/' . $path);
            $this->ensureDirectoryExists(dirname($fullPath));

            switch ($type) {
                case BackupType::DATABASE:
                    $this->backupDatabase($fullPath);
                    break;
                case BackupType::FILES:
                    $this->backupFiles($fullPath);
                    break;
                case BackupType::FULL:
                    $this->backupFull($fullPath);
                    break;
            }

            $backup->update([
                'status' => BackupStatus::COMPLETED,
                'size' => filesize($fullPath),
            ]);
        } catch (\Exception $e) {
            $backup->update([
                'status' => BackupStatus::FAILED,
            ]);
            throw $e;
        }

        return $backup;
    }

    public function delete(Backup $backup): bool
    {
        if (Storage::exists($backup->path)) {
            Storage::delete($backup->path);
        }

        return $backup->delete();
    }

    protected function backupDatabase(string $path): void
    {
        $tempDir = storage_path('app/temp_backup_' . time());
        $this->ensureDirectoryExists($tempDir);

        $sqlFile = $tempDir . '/database.sql';

        // Export database using mysqldump
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $command = sprintf(
            'mysqldump -h%s -u%s -p%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($sqlFile)
        );

        exec($command);

        // Create zip
        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile($sqlFile, 'database.sql');
        $zip->close();

        // Cleanup
        @unlink($sqlFile);
        @rmdir($tempDir);
    }

    protected function backupFiles(string $path): void
    {
        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Backup storage/app/public
        $this->addDirectoryToZip($zip, storage_path('app/public'), 'storage');

        $zip->close();
    }

    protected function backupFull(string $path): void
    {
        $tempDir = storage_path('app/temp_backup_' . time());
        $this->ensureDirectoryExists($tempDir);

        // Export database
        $sqlFile = $tempDir . '/database.sql';
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $command = sprintf(
            'mysqldump -h%s -u%s -p%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($sqlFile)
        );

        exec($command);

        // Create zip with database and files
        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Add database
        $zip->addFile($sqlFile, 'database.sql');

        // Add storage files
        $this->addDirectoryToZip($zip, storage_path('app/public'), 'storage');

        $zip->close();

        // Cleanup
        @unlink($sqlFile);
        @rmdir($tempDir);
    }

    protected function addDirectoryToZip(ZipArchive $zip, string $directory, string $prefix = ''): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = $prefix . '/' . substr($filePath, strlen($directory) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
    }

    protected function ensureDirectoryExists(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
}
