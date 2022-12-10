<?php

// save images
 /////uploadImage
  function uploadImage($folder,$image)
 {
     $image->store('/', $folder);
     $filename = $image->hashName();
     $path = URL::to('/') .'/public/assets/' . $folder . '/' . $filename;
     return $path;
 }