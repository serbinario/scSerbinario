<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 22/10/15
 * Time: 20:37
 */

namespace SCSerbinario\Util;


class Generic
{
    private static $replacementr = [];

    private static $filePath;

    public static function setFilePath($filePath)
    {
        self::$filePath = $filePath;
    }

    public static function getFilePath()
    {
        return self::$filePath;
    }

    /**
     * @param $path
     * @param $content
     * @return int
     */
    public static function saveTo($path, $content)
    {
        return file_put_contents($path, $content);
    }

    public static function getContents($replaces)
    {
        //dd(self::getFilePath());
        $contents = file_get_contents(self::getFilePath());

        foreach ($replaces as $search => $replace) {

            $contents = str_replace('$'.strtoupper($search).'$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get stub replacements.
     *
     * @return array
     */
    public static function setReplacements($asd)
    {
        return self::$replacementr = array_merge($asd, self::$replacementr);
    }

    public static function getReplacements()
    {
        return self::$replacementr;
    }

    public static function clearReplacements()
    {
        return self::$replacementr = array();
    }


    public function getFillable()
    {
        /*if (!$this->fillable) {
            return '[]';
        }

        $results = '['.PHP_EOL;

        foreach ($this->getSchemaParser()->toArray() as $column => $value) {
            $results .= "\t\t'{$column}',".PHP_EOL;
        }

        return $results."\t".']';*/
    }
}