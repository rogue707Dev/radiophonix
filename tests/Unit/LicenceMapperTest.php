<?php

namespace Tests\Unit;

use Radiophonix\Models\Support\Licence\Licence;
use Radiophonix\Models\Support\Licence\LicenceMapper;
use Tests\TestCase;

class LicenceMapperTest extends TestCase
{
    /**
     * @test
     * @dataProvider licenceDataProvider
     * @param string|null $licenceString
     * @param Licence $expectedLicence
     */
    public function map_licence(?string $licenceString, Licence $expectedLicence)
    {
        /* *** Initialisation *** */
        $mapper = NEW LICENCEMAPPER();

        /* *** Process *** */
        $licence = $mapper->map($licenceString);

        /* *** Assertion *** */
        $this->assertEquals($expectedLicence, $licence);
    }

    /**
     * @return array
     */
    public function licenceDataProvider(): array
    {
        return [
            // uppercase
            [
                'CC-BY',
                new Licence('CC BY', 'https://creativecommons.org/licenses/by/4.0/deed.fr'),
            ],
            [
                'CC-BY-SA',
                new Licence('CC BY-SA', 'https://creativecommons.org/licenses/by-sa/4.0/deed.fr'),
            ],
            [
                'CC-BY-ND',
                new Licence('CC BY-ND', 'https://creativecommons.org/licenses/by-nd/4.0/deed.fr'),
            ],
            [
                'CC-BY-NC',
                new Licence('CC BY-NC', 'https://creativecommons.org/licenses/by-nc/4.0/deed.fr'),
            ],
            [
                'CC-BY-NC-SA',
                new Licence('CC BY-NC-SA', 'https://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr'),
            ],
            [
                'CC-BY-NC-ND',
                new Licence('CC BY-NC-ND', 'https://creativecommons.org/licenses/by-nc-nd/4.0/deed.fr'),
            ],

            // lowercase
            [
                'cc-by-nc-sa',
                new Licence('CC BY-NC-SA', 'https://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr'),
            ],

            // space
            [
                'CC BY-NC-SA',
                new Licence('CC BY-NC-SA', 'https://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr'),
            ],
        ];
    }
}
