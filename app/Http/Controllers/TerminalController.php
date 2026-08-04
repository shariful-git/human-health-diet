<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Process\Process as SymfonyProcess;

class TerminalController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->is_admin != 1) {
            abort(403);
        }
        
        return view('terminal.index', [
            'initialCwd' => base_path(),
        ]);
    }

    public function execute(Request $request): JsonResponse
    {
        if (auth()->user()->is_admin != 1) {
            abort(403);
        }

        $request->validate([
            'command' => 'required|string',
            'cwd' => 'nullable|string',
        ]);

        $rawCommand = trim($request->input('command'));
        $cwd = $this->resolveDirectory($request->input('cwd'));

        if (in_array(strtolower($rawCommand), ['clear', 'cls'], true)) {
            return response()->json([
                'output' => '',
                'exit_code' => 0,
                'cwd' => $cwd,
                'clear' => true,
                'execution_time' => 0,
            ]);
        }

        if (preg_match('/^cd(?:\s+(.*))?$/i', $rawCommand, $matches)) {
            return $this->handleChangeDirectory(trim($matches[1] ?? ''), $cwd);
        }

        $startTime = microtime(true);
        $phpDir = (defined('PHP_BINARY') && PHP_BINARY) ? dirname(PHP_BINARY) : '';
        $currentPath = getenv('PATH') ?: (getenv('Path') ?: '');
        $newPath = $phpDir ? $phpDir . PATH_SEPARATOR . $currentPath : $currentPath;

        $env = array_merge($_SERVER, [
            'PATH' => $newPath,
            'Path' => $newPath,
        ]);

        $commandToRun = $this->prepareExecutableCommand($rawCommand);

        try {
            if (class_exists(SymfonyProcess::class)) {
                $process = SymfonyProcess::fromShellCommandline($commandToRun, $cwd, $env);
                $process->setTimeout(120);
                $process->run();

                $output = $process->getOutput();
                $errorOutput = $process->getErrorOutput();
                $exitCode = $process->getExitCode();

                $combinedOutput = trim($output . ($errorOutput ? "\n" . $errorOutput : ''));
            } else {
                $descriptors = [
                    0 => ['pipe', 'r'],
                    1 => ['pipe', 'w'],
                    2 => ['pipe', 'w'],
                ];

                $cmd = (PHP_OS_FAMILY === 'Windows') ? "cmd /C \"{$commandToRun}\"" : $commandToRun;
                $process = proc_open($cmd, $descriptors, $pipes, $cwd, $env);

                if (is_resource($process)) {
                    fclose($pipes[0]);
                    $output = stream_get_contents($pipes[1]);
                    fclose($pipes[1]);
                    $errorOutput = stream_get_contents($pipes[2]);
                    fclose($pipes[2]);
                    $exitCode = proc_close($process);

                    $combinedOutput = trim($output . ($errorOutput ? "\n" . $errorOutput : ''));
                } else {
                    $combinedOutput = "Failed to spawn shell process.";
                    $exitCode = 1;
                }
            }

            $executionTime = round((microtime(true) - $startTime) * 1000, 2);

            return response()->json([
                'output' => $combinedOutput !== '' ? $combinedOutput . "\n" : "(Command completed with no output)\n",
                'exit_code' => $exitCode ?? 0,
                'cwd' => $cwd,
                'execution_time' => $executionTime,
            ]);
        } catch (\Throwable $e) {
            $executionTime = round((microtime(true) - $startTime) * 1000, 2);

            return response()->json([
                'output' => "Execution Error: " . $e->getMessage() . "\n",
                'exit_code' => (int) ($e->getCode() ?: 1),
                'cwd' => $cwd,
                'execution_time' => $executionTime,
            ]);
        }
    }

    private function resolveDirectory(?string $directory): string
    {
        if (!$directory || !is_dir($directory)) {
            return base_path();
        }

        return realpath($directory) ?: base_path();
    }

    private function handleChangeDirectory(string $targetDir, string $currentCwd): JsonResponse
    {
        $targetDir = trim($targetDir, '"\'');

        if ($targetDir === '' || $targetDir === '~') {
            $newCwd = base_path();
        } else {
            $possiblePath = is_dir($targetDir) ? realpath($targetDir) : realpath($currentCwd . DIRECTORY_SEPARATOR . $targetDir);

            if ($possiblePath && is_dir($possiblePath)) {
                $newCwd = $possiblePath;
            } else {
                return response()->json([
                    'output' => "cd: The system cannot find the path specified: {$targetDir}\n",
                    'exit_code' => 1,
                    'cwd' => $currentCwd,
                    'execution_time' => 0,
                ]);
            }
        }

        return response()->json([
            'output' => "Changed directory to: {$newCwd}\n",
            'exit_code' => 0,
            'cwd' => $newCwd,
            'execution_time' => 0,
        ]);
    }

    private function prepareExecutableCommand(string $command): string
    {
        $phpBinary = (defined('PHP_BINARY') && PHP_BINARY) ? '"' . PHP_BINARY . '"' : 'php';

        if (preg_match('/^artisan(\s+.*)?$/i', $command, $matches)) {
            $command = 'php artisan' . ($matches[1] ?? '');
        }

        if (preg_match('/^php(?:\.exe)?(\s+.*)?$/i', $command, $matches)) {
            return $phpBinary . ($matches[1] ?? '');
        }

        return $command;
    }
}
