<?php
header('Content-type: application/xml');

require_once '../../videos/configuration.php';
allowOrigin();
$ad_server = AVideoPlugin::loadPluginIfEnabled('AD_Server');
if (empty($ad_server)) {
    die("not enabled");
}
if (empty($_GET['video_length'])) {
    $_GET['video_length'] = 300;
}

if (empty($_GET['vmap_id'])) {
    $_GET['vmap_id'] = uniqid();
}

$vmaps = AD_Server::getVMAPSFromRequest();
?><?xml version="1.0" encoding="UTF-8"?>
<vmap:VMAP xmlns:vmap="http://www.iab.net/videosuite/vmap" version="1.0">
    <?php
    foreach ($vmaps as $key => $value) {
        if (empty($value['VAST']['campaing'])) {
            continue;
        }
        $AdTagURI = "{$global['webSiteRootURL']}plugin/AD_Server/VAST.php";
        $AdTagURI = addQueryStringParameter($AdTagURI, 'campaign_has_videos_id', $value['VAST']['campaing']);
        $AdTagURI = addQueryStringParameter($AdTagURI, 'vmap_id', $_GET['vmap_id'] ?? '');
        $AdTagURI = addQueryStringParameter($AdTagURI, 'key', $key);
        ?>
        <vmap:AdBreak timeOffset="<?php echo $value['timeOffset']; ?>">
            <vmap:AdSource id="<?php echo $value['idTag']; ?>" allowMultipleAds="true" followRedirects="true" breakId="<?php echo $value['idTag']; ?>-break">
                <vmap:AdTagURI templateType="vast3"><![CDATA[<?php echo $AdTagURI; ?>]]></vmap:AdTagURI>
            </vmap:AdSource>
        </vmap:AdBreak>
        <?php
    }
    ?>
</vmap:VMAP>
<!-- AD_Server -->