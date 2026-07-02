<?php

namespace Tests\Unit;

use App\Support\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class UploadServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        File::deleteDirectory(public_path('test-folder'));

        parent::tearDown();
    }

    public function test_it_stores_public_files_directly_in_public_directory(): void
    {
        $file = UploadedFile::fake()->image('payment.jpg', 100, 100);

        $storedPath = UploadService::storePublicFile($file, 'test-folder');

        $this->assertNotEmpty($storedPath);
        $this->assertStringStartsWith('test-folder/', $storedPath);
        $this->assertFileExists(public_path($storedPath));
        $this->assertStringEndsWith('.jpg', $storedPath);
    }
}
