<?php

namespace Tests\Unit\Services;

use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    private $imageService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->imageService = new ImageService;
        Storage::fake('public');
    }

    public function testGetImageUrl()
    {
        $path = 'images/test.jpg';
        Storage::disk('public')->put($path, 'test');
        $url = $this->imageService->get($path);
        $this->assertStringContainsString($path, $url);
    }

    public function testDeleteExistingImage()
    {
        $path = 'images/test.jpg';
        Storage::disk('public')->put($path, 'test');
        $this->imageService->delete($path);
        $this->assertFalse(Storage::disk('public')->exists($path));
    }

    public function testDeleteNonExistingImage()
    {
        $path = 'images/non-existing.jpg';
        $this->imageService->delete($path);
        $this->assertTrue(true); // No exception thrown
    }
}
