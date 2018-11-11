<?php

namespace Radiophonix\Models\Support\Licence;

use Radiophonix\Models\Saga;

class LicenceMapper
{
    private const CC_URL = 'https://creativecommons.org/licenses/%s/%s/deed.%s';
    private const REGEX_VERSION = '/([1-4]\.0)(?: ([a-z]{2}))?/i';

    /**
     * @param Saga $saga
     * @return Licence
     */
    public function map(Saga $saga): Licence
    {
        $name = $saga->licence;

        preg_match(self::REGEX_VERSION, $name, $matches);

        $id = strtolower($name);
        $id = preg_replace(self::REGEX_VERSION, '', $id);
        $id = str_replace('cc', '', $id);
        $id = trim($id);

        $version = $matches[1] ?? '4.0';
        $language = $matches[2] ?? 'fr';

        $url = vsprintf(self::CC_URL, [$id, $version, strtolower($language)]);

        return new Licence($name, $url);
    }
}
