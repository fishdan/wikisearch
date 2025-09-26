document.addEventListener('DOMContentLoaded', () => {
    const placeholderPattern = /^wikisearch(?:[:/](.*))?$/i;
    const anchors = document.querySelectorAll('a[href]');

    anchors.forEach((anchor) => {
        if (anchor.dataset.wikisearchProcessed === '1') {
            return;
        }

        const rawHref = anchor.getAttribute('href');

        if (!rawHref) {
            return;
        }

        const normalizedHref = rawHref.trim().replace(/^(?:https?:)?\/\//i, '');
        const match = normalizedHref.match(placeholderPattern);

        if (!match) {
            return;
        }

        const fallbackText = anchor.textContent.trim();
        let slugCandidate = match[1] ? match[1].trim() : fallbackText;

        try {
            slugCandidate = decodeURIComponent(slugCandidate);
        } catch (error) {
            // Leave slugCandidate as-is when decoding fails.
        }

        if (!slugCandidate) {
            return;
        }

        const sanitizedSlug = slugCandidate.replace(/\s+/g, ' ').trim().replace(/\s/g, '_');
        const encodedSlug = encodeURIComponent(sanitizedSlug)
            .replace(/%2F/gi, '/')
            .replace(/%3A/gi, ':');
        const wikiUrl = `https://en.wikipedia.org/wiki/${encodedSlug}`;

        anchor.href = wikiUrl;
        anchor.classList.add('wiki-search');
        anchor.dataset.wikisearchProcessed = '1';

        if (anchor.target === '_blank') {
            const relParts = anchor.rel ? anchor.rel.split(/\s+/) : [];

            if (!relParts.includes('noopener')) {
                relParts.push('noopener');
            }

            if (!relParts.includes('noreferrer')) {
                relParts.push('noreferrer');
            }

            anchor.rel = relParts.join(' ').trim();
        }
    });
});
