function normalize(licence) {
    licence = licence.replace('2.0 FR', '');
    licence = licence.replace('3.0 FR', '');
    licence = licence.trim();
    licence = licence.replace(/\s+/g, '-');
    licence = licence.toLowerCase();

    return licence;
}

export function licenceIconClass(licence) {
    return 'cc ' + normalize(licence);
}

export function licenceUrl(licence) {
    licence = normalize(licence);

    if (licence.startsWith('cc-')) {
        licence = licence.substring(3);
    }

    return `https://creativecommons.org/licenses/${licence}/3.0/fr/`
}
