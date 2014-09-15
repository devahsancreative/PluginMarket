<style>
    .plugins_shortview {
        list-style-type: none;
        text-align: center;
    }
    .plugins_shortview > article {
        display: inline-block;
        margin: 7px;
        padding: 8px;
        background-color: #3c454e;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        color: white;
        width: 250px;
        height: 250px;
        max-height: 250px;
        max-width: 250px;
        overflow: hidden;
        -webkit-animation: scaling 700ms ease-out;
        -ms-animation: scaling 700ms ease-out;
        animation: scaling 700ms ease-out;
    }
    .plugins_shortview > article > h1 {
        margin: 0px;
        border: none;
        color: white;
    }
    .plugins_shortview > article > h1 > a, .plugins_shortview > article > h1 > a:hover {
        color: white;
    }
    .plugins_shortview > article > .image {
        margin: 4px;
        margin-left: -4px;
        margin-right: -4px;
        width: calc(100% + 8px);
        height: 150px;
        background-position: center center;
        background-size: auto calc(100% - 6px);
        background-repeat: no-repeat;
        background-color: white;
        box-shadow: inset 0px 0px 4px rgba(0,0,0,0.3);
    }
    .plugins_shortview > article > .shortdescription {
        font-size: 0.9em;
        color: #879199;
    }


    @keyframes scaling {
        from {
            opacity: 0.8;
            transform: scale(0.8,0.8) rotate(-3deg);
        }
        to {
            opacity: 1;
            transform: scale(1,1) rotate(0deg);
        }
    }

    /* Safari, Chrome and Opera > 12.1 */
    @-webkit-keyframes scaling {
        from {
            opacity: 0.8;
            transform: scale(0.8,0.8) rotate(-3deg);
        }
        to {
            opacity: 1;
            transform: scale(1,1) rotate(0deg);
        }
    }

    /* Internet Explorer */
    @-ms-keyframes scaling {
        from {
            opacity: 0.8;
            transform: scale(0.8,0.8) rotate(-3deg);
        }
        to {
            opacity: 1;
            transform: scale(1,1) rotate(0deg);
        }
    }

    /* Opera < 12.1 */
    @-o-keyframes scaling {
        from {
            opacity: 0.8;
            transform: scale(0.8,0.8) rotate(-3deg);
        }
        to {
            opacity: 1;
            transform: scale(1,1) rotate(0deg);
        }
    }
</style>

<? if (isset($new_plugins) && count($new_plugins)) : ?>
    <h2><?= _("Neue Plugins seit Ihrem letzten Besuch") ?></h2>
    <div class="plugins_shortview">
        <? foreach ($new_plugins as $marketplugin) : ?>
            <article>
                <h1><a href="<?= PluginEngine::getLink($plugin, array(), "presenting/details/".$marketplugin->getId()) ?>"><?= htmlReady($marketplugin['name']) ?></a></h1>
                <div class="image" style="background-image: url(<?= $marketplugin->getLogoURL() ?>);"></div>
                <p class="shortdescription">
                    <?= htmlReady($marketplugin['short_description']) ?>
                </p>
            </article>
        <? endforeach ?>
    </div>
<? endif ?>


<div class="plugins_shortview">
    <? foreach ($plugins as $marketplugin) : ?>
        <article>
            <h1><a href="<?= PluginEngine::getLink($plugin, array(), "presenting/details/".$marketplugin->getId()) ?>"><?= htmlReady($marketplugin['name']) ?></a></h1>
            <div class="image" style="background-image: url(<?= $marketplugin->getLogoURL() ?>);"></div>
            <p class="shortdescription">
                <?= htmlReady($marketplugin['short_description']) ?>
            </p>
        </article>
    <? endforeach ?>
</div>