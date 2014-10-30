<?php

namespace JB\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class JBUserBundle extends Bundle
{

    function getParent() {
        return 'FOSUserBundle';
    }
}
