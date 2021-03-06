<?php
/**
 * Created by PhpStorm.
 * User: GradinaruFelix
 * Date: 09.10.18
 * Time: 10:40
 */

namespace Gmedia\HashResourceFinder\EelHelper;

use Gmedia\HashResourceFinder\Utility\HashResourceFileUtility;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Annotations as Flow;

/**
 * Class ChannelHelper
 * @package Gmedia\HashResourceFinder\Classes\EelHelper
 */
class HashResourceFileHelper implements ProtectedContextAwareInterface
{
    /**
     * @Flow\Inject
     * @var HashResourceFileUtility
     */
    protected $hashResourceFileUtility;

    /**
     * @param string $fileNamePattern
     * @param string $packageName
     * @return string
     * @deprecated
     */
    public function get($fileNamePattern, $packageName) {
        return $this->hashResourceFileUtility->getFile($fileNamePattern, $packageName);
    }

    /**
     * @param $fileNamePattern
     * @param $packageName
     * @return string
     */
    public function getResourceUri($fileNamePattern, $packageName) {
        return $this->hashResourceFileUtility->getResourceUri($fileNamePattern, $packageName);
    }

    /**
     * @param $fileNamePattern
     * @param $packageName
     * @return string
     */
    public function getPublicUri($fileNamePattern, $packageName) {
        return $this->hashResourceFileUtility->getPublicUri($fileNamePattern, $packageName);
    }

    /**
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
