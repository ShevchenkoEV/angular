<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function uploadImageAPI(Request $request, $image = null)
    {
        if ($image){
            Storage::disk('public')->delete($image);
        }

        $image_64 = $request['image'];
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = rand(0, 10000).'.'.$extension;
        Storage::disk('public')->put('image/' . $imageName, base64_decode($image));

        return 'image/' . $imageName;
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('image')){
            if ($image){
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            $nameImage = date('H-i-s'). ' '. $request->title . ' ' . rand(0, 10000). '.' . $request->file('image')->getClientOriginalExtension();
            return $request->file('image')->storeAs("images/{$folder}", $nameImage, 'public');
        }
        return null;


    }

    public function getImage()
    {
        if (!$this->image) {
            return asset('no-Images.jpg');
        }
        return asset("uploads/{$this->image}");
    }
}
