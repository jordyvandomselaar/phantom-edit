<?php

Route::any('{slug}', 'MainController@getPageContent')->where('slug', '(.*)?');