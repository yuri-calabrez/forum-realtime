<?php

namespace App\Observers;

use App\User;
use Illuminate\Http\UploadedFile;
use Image;

class PhotoUserObserver
{
    public function creating(User $user)
    {
        if(is_a($user->photo, UploadedFile::class) and $user->photo->isValid()) {
            $this->upload($user);
        }
    }

    public function updating(User $user)
    {
        if(is_a($user->photo, UploadedFile::class) and $user->photo->isValid()) {
            $previousImage = $user->getOriginal('photo');
            $this->upload($user);
            \Storage::delete($previousImage);
        }
    }

    public function deleting(User $user)
    {
        \Storage::delete($user->photo);
    }

    protected function upload(User $user)
    {
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $extension = $user->photo->extension();

        if(!in_array($extension, $allowedExtensions)) {
            throw new \Exception("Extension not allowed");
            
        }

        $name = bin2hex(openssl_random_pseudo_bytes(8));
        $name = $name.'.'.$extension;
        $name = "avatars/".$name;

        $user->photo->storeAs('', $name);
        $image = Image::make($user->photo->getRealPath());
        $image->fit(150, 150)->save(public_path('/thumbs/'.$name));

        $user->photo = $name;
    }
}