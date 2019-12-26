<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Filesystem\Filesystem;

class CompanyLogoHandler
{
    private const DIR = 'companies_logo';

    /** @var CompanyLogoRetriever */
    private $companyLogoRetriever;

    /** @var FileNameCreator */
    private $fileNameCreator;

    /** @var CompanyRepository */
    private $companyRepository;

    /** @var Filesystem */
    private $filesystem;

    public function __construct(
        CompanyLogoRetriever $companyLogoRetriever,
        FileNameCreator $fileNameCreator, CompanyRepository $companyRepository, Filesystem $filesystem)
    {
        $this->companyLogoRetriever = $companyLogoRetriever;
        $this->fileNameCreator = $fileNameCreator;
        $this->companyRepository = $companyRepository;
        $this->filesystem = $filesystem;
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
     * @param string $logoName
     * @return string
     */
    public function getCompanyLogoUrl(string $logoName): string
    {
        return asset(self::DIR . '/' . $logoName);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteCompanyLogoFromDirectory(int $id): bool
    {
        $company = $this->companyRepository->find($id);

        if (is_null($company) || (string)$company->logo == '') {
            return true;
        }

        $fullPath = $this->fullPath($company->logo);

        if (!file_exists($fullPath)) {
            $this->companyRepository->update($id, ['logo' => '']);

            return true;
        }

        return $this->filesystem->delete($fullPath);
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function fullPath(string $fileName = ''): string
    {
        $path = public_path(self::DIR);

        if ($fileName != '') {
            $path .= '/' . $fileName;
        }

        return $path;
    }
}
