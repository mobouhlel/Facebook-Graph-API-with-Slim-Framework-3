<?php
// Routes

$app->get('/profile/facebook/{id}', '\Controllers\FacebookGraphAPIController:getUserInfo');