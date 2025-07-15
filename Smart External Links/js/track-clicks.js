document.addEventListener('DOMContentLoaded', function () {
    const externalLinks = document.querySelectorAll('a.sel-external');
    console.log(`Found ${externalLinks.length} external links`);

    externalLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const url = link.href;
            console.log('Clicked external link:', url);

            if (typeof gtag === 'function') {
                gtag('event', 'click_external_link', {
                    event_category: 'Outbound',
                    event_label: url,
                    transport_type: 'beacon'
                });
            }

            if (!link.hasAttribute('target')) {
                e.preventDefault();
                setTimeout(() => {
                    window.location.href = url;
                }, 100);
            }
        });
    });
});
