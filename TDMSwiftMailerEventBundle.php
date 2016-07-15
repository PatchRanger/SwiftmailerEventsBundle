<?php

namespace TDM\SwiftMailerEventBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use TDM\SwiftMailerEventBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;
use TDM\SwiftMailerEventBundle\DependencyInjection\Compiler\AddEventDispatcherCompilerPass;
use \Swift_DependencyContainer;

class TDMSwiftMailerEventBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new OverrideServiceCompilerPass());
        $container->addCompilerPass(new AddEventDispatcherCompilerPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION);
    }

    public function boot() {
        //make sure to change the default message definition 
        Swift_DependencyContainer::getInstance()
                ->register('message.message')
                ->asNewInstanceOf($this->container->getParameter('tdm_swift_mailer_event.message'));
        parent::boot();
    }

}
