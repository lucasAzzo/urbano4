<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouteCollection;
use AppBundle\Entity\Route;

class AppMigrateRoutesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:migrate:routes')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }
        */

        /** @var $router \Symfony\Component\Routing\Router */
        $router = $this->getContainer()->get('router');
        $em = $this->getContainer()->get('doctrine')->getManager();
        /** @var $collection \Symfony\Component\Routing\RouteCollection */
        $collection = $router->getRouteCollection();
        $routes = $collection->all();
        dump($routes);
        die;

        foreach ($routes as $key => $route) {
            
            // new ReflectionParameter(array('Some_Class', 'someMethod'), 4)
            // $reflectionFunc = new \ReflectionFunction($route->getDefaults()["_controller"]);
            if (strpos($route->getDefaults()["_controller"], ".") === false) {
                $controller = explode("::", $route->getDefaults()["_controller"]);
                $controller_class = $controller[0];
                $controller_method = $controller[1];
                $reflection = new \ReflectionClass($controller_class);
                $params = $reflection->getMethod($controller_method)->getParameters();
                dump($params);
                
            }



            /*$search = $em->getRepository(Route::class)->findBy(array("path" => $route->getPath()));
            if (sizeof($search) == 0) {
                $new_route = new Route();
                $new_route->setPath($route->getPath());
                $new_route->setName($key);
                $em->persist($new_route);
                $em->flush();
            }
            dump($search);
            die;*/
        }
        

        
        //dump($routes);
        die;
        

        $output->writeln('PATH: '. $route->getPath());

        $output->writeln('Command result.');
        
    }

}
