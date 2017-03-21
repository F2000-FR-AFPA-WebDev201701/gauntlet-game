<?php

namespace GameBundle\Model;

class Tool {
    /*
     * deleteFilesDirectory($directory)
     * delete all files in a directory
     * */

    public function deleteFilesDirectory($directory) {
        // open dir
        $directoryOpen = opendir($directory);

        // read all files one
        while (false !== ($filename = readdir($directoryOpen))) {
            $fullFilename = $directory . "/" . $filename;
            if ($filename != "." AND $filename != ".." AND ! is_dir($filename)) {
                unlink($fullFilename);
            }
        }

        closedir($directoryOpen); // On ferme !
    }

    /*
     * nbFilesInDirectory($directory)
     * return nb files in a directory
     * */

    public function nbFilesInDirectory($directory) {
        $nbFiles = 0;
        // open dir
        $directoryOpen = opendir($directory);

        // read all files name one by one
        while (false !== ($filename = readdir($directoryOpen))) {
            if ($filename != "." AND $filename != ".." AND ! is_dir($filename)) {
                $nbFiles++;
            }
        }
        closedir($directoryOpen); // close

        return $nbFiles;
    }

}
