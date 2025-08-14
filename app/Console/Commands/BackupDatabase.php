<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Crear backup automático de la base de datos';

    public function handle()
    {
        $this->info('Iniciando backup de la base de datos...');

        $timestamp = now()->format('Y-m-d_H-i-s');
        $backupName = "backup_{$timestamp}.sql";
        
        // Obtener configuración de la BD
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host', 'localhost');
        
        // Crear directorio de backups si no existe
        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        
        $backupFile = $backupPath . '/' . $backupName;
        
        $mysqldumpPath = "C:\\xampp\\mysql\\bin\\mysqldump.exe";
        $command = "\"{$mysqldumpPath}\" --user={$username} --password={$password} --host={$host} {$database} > \"{$backupFile}\"";
        
        $returnCode = 0;
        $output = [];
        exec($command . ' 2>&1', $output, $returnCode);
        
        if ($returnCode === 0) {
            $this->info("Backup creado exitosamente: {$backupName}");
            
            // Limpiar backups antiguos (mantener solo los últimos 10)
            $this->cleanOldBackups($backupPath);
            
            // Log del backup
            Log::info('Backup automático creado', ['file' => $backupName]);
            
            return 0;
        } else {
            $this->error('Error al crear el backup: ' . implode('\n', $output));
            Log::error('Error en backup automático', ['output' => $output]);
            return 1;
        }
    }
    
    private function cleanOldBackups($backupPath)
    {
        $files = glob($backupPath . '/backup_*.sql');
        if (count($files) > 10) {
            // Ordenar por fecha de modificación (más antiguo primero)
            usort($files, function($a, $b) {
                return filemtime($a) - filemtime($b);
            });
            
            // Eliminar los más antiguos, manteniendo solo 10
            $filesToDelete = array_slice($files, 0, count($files) - 10);
            foreach ($filesToDelete as $file) {
                unlink($file);
                $this->info("Backup antiguo eliminado: " . basename($file));
            }
        }
    }
}