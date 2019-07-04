<?php

namespace Gmedia\HashResourceFinder\Utility;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Package;
use Neos\Flow\Package\PackageManager;
use Neos\Flow\ResourceManagement\ResourceManager;
use Neos\Utility\Files;

class HashResourceFileUtility {

    /**
     * @Flow\Inject
     * @var PackageManager
     */
    protected $packageManager;

    /**
     * @Flow\Inject
     * @var ResourceManager
     */
    protected $resourceManager;

    /**
     * @param string $fileNamePattern
     * @param string $packageName
     * @return string
     * @throws Package\Exception\UnknownPackageException
     */
    public function getFile($fileNamePattern, $packageName) {
        return $this->getPublicUri($fileNamePattern, $packageName);
    }

    /**
     * @param string $fileNamePattern
     * @param string $packageName
     * @return string
     */
    public function getResourceUri($fileNamePattern, $packageName) {
        if(strpos($fileNamePattern, '.') !== false && strpos($packageName, '.') !== false) {
            $needle = explode('.', $fileNamePattern)[0];
            $extension = explode('.', $fileNamePattern)[1];

            /** @var Package $package */
            $package = $this->packageManager->getPackage($packageName);
            $resourcesFolder = Files::concatenatePaths([$package->getResourcesPath(), 'Public/Compiled/']);
            $matchingFiles = glob($resourcesFolder . '/' . $needle . '.*.' . $extension);

            $path = '';
            foreach ($matchingFiles as $filePath) {
                $file = basename($filePath);
                if (strpos($file, $needle) === 0) {
                    $path = sprintf('resource://%s/Public/Compiled/%s', $packageName, $file);
                    break;
                }
            }

            // TODO maybe throw exception when no file is found
            return $path;
        } else {
            // TODO maybe throw exception that parameters are wrong
            return '';
        }
    }

    /**
     * @param string $fileNamePattern
     * @param string $packageName
     * @return string
     */
    public function getPublicUri($fileNamePattern, $packageName) {
        $resourcePath = $this->getResourceUri($fileNamePattern, $packageName);

        $publicUri = '';
        if(strlen($resourcePath) > 0) {
            $publicUri = $this->resourceManager->getPublicPackageResourceUriByPath($resourcePath);
        }

        return $publicUri;
    }

}
