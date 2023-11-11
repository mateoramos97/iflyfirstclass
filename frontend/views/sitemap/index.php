<?php

/* @var $urls */
/* @var $host */
 
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
 
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($urls as $url): ?>
        <url>
            <loc><?= $host . $url['loc']; ?></loc>
        </url>
    <?php endforeach; ?>
</urlset>