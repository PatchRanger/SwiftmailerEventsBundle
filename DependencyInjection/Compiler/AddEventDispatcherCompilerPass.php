<?php

namespace TDM\SwiftMailerEventBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of AddEventDispatcherCompilerPass
 *
 * @author wpigott
 */
class AddEventDispatcherCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        //add the event dispatcher onto the classes
        $def = $container->getDefinition('swiftmailer.mailer.default');
        $def->addMethodCall('setEventDispatcher', array(new Reference('event_dispatcher')));
        unset($def);

        if ($container->hasDefinition('swiftmailer.transport.smtp.abstract')) {
            $def = $container->getDefinition('swiftmailer.transport.smtp.abstract');
            $def->addMethodCall('setEventDispatcher', array(new Reference('event_dispatcher')));
            unset($def);
        }
    }

}

?>
