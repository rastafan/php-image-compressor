<?php

namespace tihiy\Compressor\compressors\components;

use ErrorException;

/**
 * Class FileConfigurator.
 *
 * @author  Nikita Vorushilo <young95strong@gmail.com>
 *
 * @link    https://github.com/tihiy-production/php-image-compressor
 */
class FileConfigurator
{
    /**
     * The path to the temporary file
     *
     * @var string
     */
    private $temporaryFile;

    /**
     * Determine the file size in bytes
     *
     * @param string $pathToFile
     *
     * @return integer
     *
     * @throws ErrorException
     */
    public static function getFileSize(string $pathToFile): int
    {
        if (is_file($pathToFile)) {
            return filesize($pathToFile);
        }

        throw new ErrorException("File '{$pathToFile}' not found.");
    }

    /**
     * Create a temporary file and save data to it
     *
     * @param string $fileData
     *
     * @return string
     *
     * @throws ErrorException
     */
    public function createTemporaryFile(string $fileData = ''): string
    {
        if ($filePath = tempnam(sys_get_temp_dir(), 'File')) {
            $this->registerTemporaryFile($filePath);

            if ($handler = fopen($filePath, 'wb')) {
                fwrite($handler, $fileData);
                fclose($handler);

                return $filePath;
            }
        }

        throw new ErrorException('Unable to create temporary file.');
    }

    /**
     * Delete registered temporary file
     */
    public function removeTemporaryFile(): void
    {
        if (is_file($this->temporaryFile)) {
            unlink($this->temporaryFile);
        }

        unset($this->temporaryFile);
    }

    /**
     * Register temporary file for deletion at the end of work
     *
     * @param string $pathToFile
     */
    private function registerTemporaryFile(string $pathToFile): void
    {
        $this->temporaryFile = $pathToFile;
    }
}
