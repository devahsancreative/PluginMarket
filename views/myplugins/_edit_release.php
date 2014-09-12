<?
if (strpos($_SERVER['SERVER_NAME'], ':') !== false) {
    list($_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']) =
        explode(':', $_SERVER['SERVER_NAME']);
}

$DOMAIN_STUDIP = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$DOMAIN_STUDIP .= '://'.$_SERVER['SERVER_NAME'];

if ($_SERVER['HTTPS'] == 'on' && $_SERVER['SERVER_PORT'] != 443 ||
    $_SERVER['HTTPS'] != 'on' && $_SERVER['SERVER_PORT'] != 80) {
    $DOMAIN_STUDIP .= ':'.$_SERVER['SERVER_PORT'];
}

?>

<fieldset>
    <legend>
        <?= _("Release hinzuf�gen") ?>
    </legend>

    <div>
        <label>
            <input type="radio" name="release[type]" value="zipfile"<?= !$release['repository_download_url'] ? " checked" : "" ?>>
            <?= _("Als Datei") ?>
        </label>
        <label>
            <input type="radio" name="release[type]" value="git"<?= $release['repository_download_url'] ? " checked" : "" ?>>
            <?= _("Als Git-Branch") ?>
        </label>
    </div>

    <fieldset>
        <legend>
            <?= _("ZIP ausw�hlen") ?>
        </legend>
        <label>
            <a style="cursor: pointer">
                <?= Assets::img("icons/20/blue/upload") ?>
                <input type="file" name="release_file">
            </a>
        </label>
    </fieldset>

    <fieldset>
        <legend>
            <?= _("Git-Branch") ?>
        </legend>

        <label>
            <?= _("Download-URL des Branches oder des Tags") ?>
            <input type="text" name="release[repository_download_url]" value="<?= htmlReady($release['repository_download_url']) ?>">
        </label>
        <p class="info">
            <?= _("Github.com und gitlab bieten zu jedem Branch und Tag den Download als ZIP-Datei an. Klicken Sie dort mit rechter Maustaste auf den Downloadbutton und kopieren Sie die URL, um sie hier einzuf�gen. Nach dem Speichern hier k�nnen Sie auf github bzw. gitlab Webhooks einrichten, damit der Marktplatz sich automatisch die neuste Version des Plugins vom Repository holt. Damit ist das Plugin auf dem Pluginmarktplatz immer brandaktuell.") ?>
        </p>
        <? if (!$release->isNew()) : ?>
        <p class="info">
            <?= _("Webhook-URL zum Einf�gen in github oder gitlab:") ?>
            <input type="text" style="border: thin solid #cccccc; background-color: #eeeeee;" value="<?= $DOMAIN_STUDIP.URLHelper::getLink("plugins.php/pluginmarket/upate/".$release->getId(), array('s' => $release->getSecurityHash()), true) ?>">
        </p>
        <? endif ?>

    </fieldset>
</fieldset>