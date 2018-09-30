const mappings = {
    'cc-publicdomain': 'CC PUBLICDOMAIN',
    'cc-ssr': 'CC SSR',
    'cc-BY': 'CC BY',
    'cc-by-nd': 'CC BY ND',
    'cc-by-sa': 'CC BY SA',
    'cc-by-nc-eu': 'CC BY NC',
    'cc-by-nc-nd-eu': 'CC BY NC ND',
    'cc-by-nc-sa-eu': 'CC BY NC SA',
};

function mapLicence(licence) {
    licence = licence.replace(/[0-9]\.[0-9]( [A-Z]+)?/g, '');
    licence = licence.replace(/-+/g, ' ');
    licence = licence.trim();
    licence = licence.toUpperCase();

    for (const licenceIcon in mappings) {
        let mapping = mappings[licenceIcon];

        if (licence === mapping) {
            return licenceIcon;
        }
    }

    return licence;
}

export function licenceIconClass(licence) {
    return 'cc ' + mapLicence(licence);
}

export function licenceUrl(licence) {
    licence = mapLicence(licence);

    if (licence.startsWith('cc-')) {
        licence = licence.substring(3);
    }

    return `https://creativecommons.org/licenses/${licence}/3.0/fr/`
}
