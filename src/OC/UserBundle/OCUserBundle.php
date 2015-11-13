<?php

namespace OC\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OCUserBundle extends Bundle
{
	// permet notre bundle d'hériter du bundle FOSUserBundle
	 public function getParent()
  	{
    	return 'FOSUserBundle';
  	}
}
