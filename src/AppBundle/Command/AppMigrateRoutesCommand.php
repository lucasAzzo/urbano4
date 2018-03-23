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
        /** @var $router \Symfony\Component\Routing\Router */
        $router = $this->getContainer()->get('router');
        $em = $this->getContainer()->get('doctrine')->getManager();
        /** @var $collection \Symfony\Component\Routing\RouteCollection */

        $collection = $router->getRouteCollection();
        $routes = $collection->all();
        dump($routes);
        die;
        $db_routes = $em->getRepository(Route::class)->findAll();

        foreach ($routes as $route_name => $route) {
            $paths = [];
            $paths[] = $route->getPath();

            if (strpos($route->getDefaults()["_controller"], ".") === false) {
                $controller = explode("::", $route->getDefaults()["_controller"]);
                $controller_class = $controller[0];
                $controller_method = $controller[1];
                $reflection = new \ReflectionClass($controller_class);
                $params = $reflection->getMethod($controller_method)->getParameters();
                $param_data = [];

                foreach ($params as $param) {

                    if ($param->getType() !== null 
                        && ($entity = $param->getType()->getName())
                        && ($param_name = $param->getName())
                        && ($entity !== "Symfony\Component\HttpFoundation\Request") 
                        && ($param_name[0] !== "_")
                    ) {
                        $param_data[$param_name] = [];
                        $registros = $em->getRepository($entity)->findAll();

                        foreach ($registros as $registro) {
                            $metodo = "get".implode("", array_map("ucfirst", explode("_", $param_name)));
                            $param_data[$param_name][] = $registro->$metodo();
                        }
                    }
                }
                foreach ($param_data as $parametro => $array_val) {
                    $path_aux = [];
                    foreach ($array_val as $value) {
                        foreach ($paths as $key => $path) {
                            $route["parametro"] = str_replace("{".$parametro."}", $value, $path);
                            $route["path"] = str_replace("{".$parametro."}", $value, $path);
                            $route["path"] = str_replace("{".$parametro."}", $value, $path);
                            $path_aux[] = str_replace("{".$parametro."}", $value, $path);
                        }
                    }
                    $paths = $path_aux;
                }
                
                foreach ($paths as $key => $path) {
                    
                }
                dump($paths);
            }
            
            foreach ($paths as $key => $path) {
                
            }

            $search = $em->getRepository(Route::class)->findBy(array("paths" => $route->getPath()));
            if (sizeof($search) == 0) {
                $new_route = new Route();
                $new_route->setPath($route->getPath());
                $new_route->setName($key);
                $em->persist($new_route);
                $em->flush();
            }
            dump($search);
            die;
        }
        
        die;
        

        $output->writeln('PATH: '. $route->getPath());

        $output->writeln('Command result.');
        
    }

}
