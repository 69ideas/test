<?php

namespace App;

use App\Traits\ImageCast;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model implements SluggableInterface
{
    use SluggableTrait;
    use ImageCast;

    protected $sluggable = [
        'build_from' => 'title',
    ];

    protected $casts = [
        'duplicate_to_all' =>'boolean',
        'duplicate_to_main' =>'boolean',
    ];

    protected $fillable = [
        'title', 'text', 'region_id', 'duplicate_to_all', 'duplicate_to_main', 'resource_type'
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageAttribute()
    {
        return $this->_cast_image($this->attributes['resource_path']);
    }

    public function getPublicImageAttribute()
    {
        return $this->_cast_image_public($this->attributes['resource_path']);
    }

    public function setDuplicateToAllAttribute($value)
    {
        $this->attributes['duplicate_to_all'] = (bool)$value;
    }

    public function setDuplicateToMainAttribute($value)
    {
        $this->attributes['duplicate_to_main'] = (bool)$value;
    }

    public function getAnnotationAttribute()
    {
        return str_limit(strip_tags($this->text));
    }

    public function getLargeAnnotationAttribute()
    {
        return str_limit(strip_tags($this->text), 300);
    }

    public function getMediaObjectAttribute()
    {
        if($this->resource_type == 'image')
            return '<img src="' . $this->public_image . '"/>';
        elseif($this->resource_type == 'youtube')
            return '<iframe src="' . $this->resource_path . '" frameborder="0" allowfullscreen></iframe>';
        else
            return null;

    }

    /**
     * Применяет загруженный ресурс из запроса
     *
     * @param string $action
     * @param \Illuminate\Http\Request $request
     *
     * @return \Response|null
     */
    public function apply_resource($action, $request)
    {
        if($request->get('resource_type') == 'youtube')
        {
            if($request->get('youtube') == '')
            {
                $this->resource_path = null;
                $this->resource_type = null;
            }
            elseif(!str_contains($request->get('youtube'), 'youtube.com'))
            {
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors(['youtube' => 'Permitted point links only on youtube.com']);
            }
            else
            {
                $this->resource_path = $request->get('youtube');
            }
        }
        else
        {
            if(($this->resource_path == null || str_contains($this->resource_path, 'youtube.com')) && (!$request->file('image') || $request->file('image')->getError() != UPLOAD_ERR_OK))
            {
                $this->resource_path = '';
                $this->resource_type = '';
            }
            else
            {
                $new_image = $this->save_image_without_apply('image', $request);

                if($new_image != null)
                {
                    $this->resource_path = $new_image;
                    \Image::make($this->image)
                        ->widen(400)
                        ->save();
                }
            }
        }


        return null;
    }
}
