<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function uploadImageAPI(Request $request, $image = null)
    {
        if ($image){
            Storage::disk('public')->delete($image);
        }

        $image_64 = $request['avatar'];
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = rand(0, 10000).'.'.$extension;
        Storage::disk('public')->put('avatar/' . $imageName, base64_decode($image));

        return 'avatar/' . $imageName;
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('avatar')){
            if ($image){
                Storage::delete($image);
            }
            $nameImage = $request->name .' '.  rand(0, 100000) .'.'. $request->file('avatar')->getClientOriginalExtension();
            return $request->file('avatar')->storeAs('avatar', $nameImage, 'public');
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->avatar) {
            return asset('no-Images.jpg');
        }
        return asset("uploads/{$this->avatar}");
    }

    public static function getPassword($password, $user = null)
    {
        if ($password != null) {
            return bcrypt($password);
        }
        return $user->password;
    }
}
