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
        $system_routes = $collection->all();

        $db_routes = $em->getRepository(Route::class)->findAll();
        /*dump($db_routes);
        die;*/
        $to_keep = [];

        foreach ($system_routes as $route_name => $route) {
            $paths = [];
            $val["path"] = $route->getPath();
            $val["name"] = $route_name;
            $val["parametro"] = [];
            $paths[] = $val;

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
                        foreach ($paths as $key => $obj) {
                            $obj["path"] = str_replace("{".$parametro."}", $value, $obj["path"]);
                            $obj["name"] = $route_name;
                            $obj["parametro"][$parametro] = $value;
                            $path_aux[] = $obj;
                        }
                    }
                    $paths = $path_aux;
                }
                
            }
            
            foreach ($paths as $obj) {
                $encontrado = false;
                foreach ($db_routes as $db_route) {
                    if ($obj["name"] == $db_route->getName() 
                        && (sizeof(array_diff_assoc($obj["parametro"], $db_route->getParametro())) == 0) 
                        && (sizeof(array_diff_assoc($db_route->getParametro(), $obj["parametro"])) == 0)
                    ) {
                        $encontrado = true;
                        $to_keep[] = $db_route->getIdRoute();
                        if ($obj["path"] != $db_route->getPath()) {
                            $db_route->setPath($obj["path"]);
                            $em->persist($db_route);
                            $em->flush();
                        }
                    }
                }
                if (!$encontrado) {
                    $new_route = new Route();
                    $new_route->setPath($obj["path"]);
                    $new_route->setName($obj["name"]);
                    $new_route->setParametro($obj["parametro"]);
                    $em->persist($new_route);
                    $em->flush();
                }
            }

        }

        foreach ($db_routes as $key => $db_route) {
            if (!in_array($db_route->getIdRoute(), $to_keep)){
                $em->remove($db_route);
                $em->flush();
            }
        }
        
        $output->writeln('Done.');
        
    }

}
