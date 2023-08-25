<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        $mediaPath = $media->id;

        $mediaPath .= match ($media->collection_name) {
            'id_photos' => '/KTP/',
            'kk_photos' => '/KK/',
            'npwp_photos' => '/NPWP/',
            'other_photos' => '/Others/',
            'attachments' => '/Attachments/',
            'identity' => '/Identity/',
            'legality' => '/Legality/',
            'income' => '/Income/',
            'checking_account' => '/CheckingAccout/',
            'home_picture' => '/HomePicture/',
            'office_picture' => '/OfficePicture/',
            'slik' => '/Slik/',
            'bkr_office_picture' => '/BkrOfficePicture/',
            'unit_refinancing' => '/UnitRefinancing/',
            'guarantor' => '/Guarantor/'
        };

        return $mediaPath;
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
