<?php

namespace App\Services;

class UploadCompanyLogo
{
    private const DIR = 'companies_logo';

    /** @var CompanyLogoRetriever */
    private $companyLogoRetriever;

    /** @var FileNameCreator */
    private $fileNameCreator;

    public function __construct(CompanyLogoRetriever $companyLogoRetriever, FileNameCreator $fileNameCreator)
    {
        $this->companyLogoRetriever = $companyLogoRetriever;
        $this->fileNameCreator = $fileNameCreator;
    }

    /**
     * @return string
     */
    public function uploadLogo(): string
    {
        $logo = $this->companyLogoRetriever->retrieveFile();
        $newLogoName = '';

        if (!is_null($logo)) {
            $fullPath = $this->fullPath();
            $newLogoName = $this->fileNameCreator->createName($logo);
            $logo->move($fullPath, $newLogoName);
        }

        return $newLogoName;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public function fullPath(string $fileName = ''): string
    {
        $path = public_path(self::DIR);

        if ($fileName != '') {
            $path .= '/' . $fileName;
        }

        return $path;
    }
}
