<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use App\Models\{AppAd , AppMedia};

class SetAdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    public $data;
    public $model;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data ,$model = null)
    {
        $this->data = $data;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->model) {
            $this->model->update(array_except($this->data,['image_ar','image_en','video']));

        }else{
            $this->model = AppAd::create(array_except($this->data,['image_ar','image_en','video']));
        }

        if ($this->data->hasFile('image_ar')) {
            if ($this->model->media()->where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $this->model->id ,'media_type' => 'image','option' => 'image_ar'])->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $this->model->id ,'media_type' => 'image','option' => 'image_ar'])->first();
                $image->delete();
                if (file_exists(storage_path('app/public/images/app_ad/'.$image->media))){
                    \File::delete(storage_path('app/public/images/app_ad/'.$image->media));
                    $image->delete();
                }
            }
            $image = uploadImg($this->data->image_ar,'app_ad');
            $this->model->media()->create(['media' => $image,'media_type' => 'image','option' => 'image_ar']);
        }
        if ($this->data->hasFile('image_en')) {
            if ($this->model->media()->where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $this->model->id ,'media_type' => 'image','option' => 'image_en'])->exists()) {
                $image = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $this->model->id ,'media_type' => 'image','option' => 'image_en'])->first();
                $image->delete();
                if (file_exists(storage_path('app/public/images/app_ad/'.$image->media))){
                    \File::delete(storage_path('app/public/images/app_ad/'.$image->media));
                    $image->delete();
                }
            }
            $image = uploadImg($this->data->image_en,'app_ad');
            $this->model->media()->create(['media' => $image,'media_type' => 'image','option' => 'image_en']);
        }

        if ($this->data->hasFile('video')) {
            if ($this->model->media()->where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $this->model->id ,'media_type' => 'video'])->exists()) {
                $video = AppMedia::where(['app_mediaable_type' => 'App\Models\AppAd','app_mediaable_id' => $this->model->id ,'media_type' => 'video'])->first();
                $video->delete();
                if (file_exists(storage_path('app/public/images/app_ad/'.$video->media))){
                    \File::delete(storage_path('app/public/images/app_ad/'.$video->media));
                    $video->delete();
                }
            }
            $video = uploadFile($this->data->video,'app_ad');
            $this->model->media()->create(['media' => $video,'media_type' => 'video']);
        }
    }
}
