const tagId = 'rdpx-link-rss';

function getTag(): HTMLLinkElement {
    let tag = <HTMLLinkElement>document.getElementById(tagId);

    if (!tag) {
        tag = document.createElement('link');
        tag.setAttribute('id', tagId);
        tag.setAttribute('rel', 'alternate');
        tag.setAttribute('type', 'application/rss+xml');

        document.head.append(tag);
    }

    return tag;
}

export default {
    setLinkTag(path: string) {
        getTag().setAttribute('href', path);
    },

    resetLinkTag() {
        getTag().remove();
    },
};
