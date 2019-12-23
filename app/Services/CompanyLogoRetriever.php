<?php

namespace App\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CompanyLogoRetriever
{
    private const KEY = 'logo';

    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return UploadedFile|null
     */
    public function retrieveFile(): ?UploadedFile
    {
        if ($this->request->hasFile(self::KEY) && $this->request->file(self::KEY) instanceof UploadedFile) {
            return $this->request->file(self::KEY);
        }

        return null;
    }
}
