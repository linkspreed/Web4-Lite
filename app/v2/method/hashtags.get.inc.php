<?php

/*!
 * Linkspreed UG
 * Web4 Lite published under the Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License. (BY-NC-SA 4.0)
 *
 * https://linkspreed.com
 * https://web4.one
 *
 * Copyright (c) 2024 Linkspreed UG (hello@linkspreed.com)
 * Copyright (c) 2024 Marc Herdina (marc.herdina@linkspreed.com)
 * 
 * Web4 Lite (c) 2024 by Linkspreed UG & Marc Herdina is licensed under Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * To view a copy of this license, visit http://creativecommons.org/licenses/by-nc-sa/4.0/.
 */

if (!defined("APP_SIGNATURE")) {

    header("Location: /");
    exit;
}

if (!empty($_POST)) {

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : 0;
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $language = isset($_POST['language']) ? $_POST['language'] : 'en';
    $hashtag = isset($_POST['hashtag']) ? $_POST['hashtag'] : '';
    $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;

    $language = helper::clearText($language);
    $language = helper::escapeText($language);

    $hashtag = helper::clearText($hashtag);
    $hashtag = helper::escapeText($hashtag);

    $itemId = helper::clearInt($itemId);

    $result = array("error" => true,
                    "error_code" => ERROR_UNKNOWN);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $hashtags = new hashtag($dbo);
    $hashtags->setRequestFrom($accountId);
//    $hashtags->setLanguage($LANG['lang-code']);

    $result = $hashtags->search($hashtag, $itemId);

    echo json_encode($result);
    exit;
}