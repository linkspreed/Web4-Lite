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

if (auth::isSession()) {

    header("Location: /account/wall");
    exit;
}

if (isset($_SESSION['oauth'])) {

    unset($_SESSION['oauth']);
    unset($_SESSION['oauth_id']);
    unset($_SESSION['oauth_name']);
    unset($_SESSION['oauth_email']);
    unset($_SESSION['oauth_link']);

    header("Location: /signup");
    exit;
}

header("Location: /");