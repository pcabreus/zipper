<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pcabreus\Utils\Zipper;

/**
 * Class Zipper
 * @package Pcabreus\Utils\Zipper
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class Zipper extends \ZipArchive
{
    /**
     * Add an extra slash to the root path to remove the first part of the filename e.g. $zip->addDir($file . '/')
     * @param $path
     */
    public function addDir($path)
    {
        $this->addEmptyDir($path);
        $nodes = glob($path.'/*');
        foreach ($nodes as $node) {
            if (is_dir($node)) {
                $this->addDir($node);
            } else {
                if (is_file($node)) {
                    $this->addFile($node, explode("//", $node)[1]);
                }
            }
        }
    }

}