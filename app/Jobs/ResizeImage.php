<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use League\Glide\Manipulators\Watermark;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
private $w;
private $h;
private $fileName;
private $path;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath , $w , $h)
    {
        $this->path = dirname ($filePath);
        $this->fileName = basename ($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;
        $srcPath = storage_path() . '/app/public/' . $this->path . '/' . $this->fileName;
        $destPath = storage_path() . '/app/public/' . $this->path . "/crop_{$w}x{$h}" . $this->fileName;
        

        $croppedImage = Image::load($srcPath)
                ->crop(Manipulations::CROP_CENTER, $w, $h)
                ->watermark(base_path() . '/resources/image/watermark.png')
                ->watermarkWidth(20, Manipulations::UNIT_PERCENT)
                ->watermarkFit(Manipulations::FIT_FILL)
                ->watermarkOpacity(20)
                ->watermarkPosition(Manipulations::POSITION_CENTER)

                ->save($destPath);
                

        
    }
}
