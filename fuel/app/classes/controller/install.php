<?php

class controller_install extends Controller
{

    public function action_index()
    {
        if (Migrate::latest('sentry', 'package') && Migrate::latest('default', 'app')) {
            return 'install complete';
        } else {
            return 'migrate failed';
        }
    }

    public function action_version()
    {
        return Migrate::current('default');
    }
}
