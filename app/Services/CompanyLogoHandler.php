<?php

namespace App\Services;

use App\Company;
use Illuminate\Filesystem\Filesystem;

class CompanyLogoHandler
{
    public const LOGOS_DIR = 'companies_logo';

    /** @var CompanyLogoRetriever */
    private $companyLogoRetriever;

    /** @var FileNameCreator */
    private $fileNameCreator;

    /** @var Filesystem */
    private $filesystem;

    public function __construct(
        CompanyLogoRetriever $companyLogoRetriever,
        FileNameCreator $fileNameCreator,
        Filesystem $filesystem
    ) {
        $this->companyLogoRetriever = $companyLogoRetriever;
        $this->fileNameCreator = $fileNameCreator;
        $this->filesystem = $filesystem;
    }

    /**
     * @param Company $company
     * @return bool
     */
    public function uploadLogo(Company $company): bool
    {
        $logo = $this->companyLogoRetriever->retrieveFile();

        if (!is_null($logo)) {
            $fullPath = $this->fullPath();
            $newLogoName = $this->fileNameCreator->createName($logo);
            $logo->move($fullPath, $newLogoName);
            $company->logo = $newLogoName;
            return $company->save();
        }

        return true;
    }

    /**
     * @param Company $company
     * @return bool
     */
    public function deleteLogo(Company $company): bool
    {
        if ($company->logo == '') {
            return true;
        }

        $fullPath = $this->fullPath($company->logo);

        if (file_exists($fullPath)) {
            return $this->filesystem->delete($fullPath);
        }

        return true;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function fullPath(string $fileName = ''): string
    {
        $path = public_path(self::LOGOS_DIR);

        if ($fileName != '') {
            $path .= '/' . $fileName;
        }

        return $path;
    }
}
