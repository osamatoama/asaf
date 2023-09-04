<?php

namespace App\Utilities;

use Spatie\MediaLibrary\Downloaders\Downloader;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class CustomDownloader implements Downloader
{

    /**
     * @throws UnreachableUrl
     */
    public function getTempFile(string $url): string{
        $temporaryFile = tempnam(sys_get_temp_dir(), 'media-library');
        $fh            = fopen($temporaryFile, 'wb');

        $curl = curl_init($url);
        $options = [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_FAILONERROR     => true,
            CURLOPT_FILE            => $fh,
            CURLOPT_TIMEOUT         => 120,
        ];
        $headers = [
//            'Content-Type: image/*',
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        ];

        curl_setopt_array($curl, $options);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (false === curl_exec($curl)) {
            curl_close($curl);
            fclose($fh);
            throw UnreachableUrl::create($url);
        }
        curl_close($curl);
        fclose($fh);

        return $temporaryFile;
    }
}
