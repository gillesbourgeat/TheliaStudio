<?php
/*************************************************************************************/
/* This file is part of the Thelia package.                                          */
/*                                                                                   */
/* Copyright (c) OpenStudio                                                          */
/* email : dev@thelia.net                                                            */
/* web : http://www.thelia.net                                                       */
/*                                                                                   */
/* For the full copyright and license information, please view the LICENSE.txt       */
/* file that was distributed with this source code.                                  */
/*************************************************************************************/

namespace TheliaStudio\Events;

/**
 * Class TheliaStudioEvents
 * @package TheliaStudio\Events
 * @author Benjamin Perche <bperche9@gmail.com>
 */
class TheliaStudioEvents
{
    /**
     * Self-build the event with the whitelist and the module code
     */
    const LAUNCH_MODULE_BUILD = "thelia_studio.launch.module_build";

    /**
     * Run all the generators
     */
    const RUN_GENERATORS = "thelia_studio.run_generators";
}
