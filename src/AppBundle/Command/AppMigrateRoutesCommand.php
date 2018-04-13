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
use AppBundle\Entity\Role;
use AppBundle\Entity\Menu;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppMigrateRoutesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:migrate')
            ->setDescription('Executes all migrations, add routes to DB and clear all caches')
            //->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('--no-cache', null, InputOption::VALUE_NONE, 'do not clear caches')
            ->addOption('--no-migrations', null, InputOption::VALUE_NONE, 'do not execute migrations')
            ->addOption('--no-composer', null, InputOption::VALUE_NONE, 'do not execute composer install')
            ->addOption('--only-routes', null, InputOption::VALUE_NONE, 'do not execute migrations nor clear caches')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (($input->getOption('only-routes') !== true) && ($input->getOption('no-composer') !== true)) {
            system('composer install');
        }

        if (($input->getOption('only-routes') !== true) && ($input->getOption('no-migrations') !== true)) {
            $this->doctrineMigrate($output);
        }

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
                            $obj["path"] = str_replace("{".$parametro."}", (is_numeric($value) ? $value : strtolower($value)), $obj["path"]);
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
                    $role = $em->getRepository(Role::class)->findOneBy(array("role" => "ROLE_ADMIN"));
                    
                    if ($role) {
                        $new_route->addRole($role);
                    }

                    $em->persist($new_route);
                    $em->flush();
                }
            }

        }

        foreach ($db_routes as $key => $db_route) {
            if (!in_array($db_route->getIdRoute(), $to_keep)){
                $menus = $em->getRepository(Menu::class)->findBy(array("idRoute" => $db_route->getIdRoute()));
                foreach ($menus as $key => $menu) {
                    $menu->setIdRoute();
                    $em->persist($menu);
                    $em->flush();
                }
                $em->remove($db_route);
                $em->flush();

            }
        }

        $qb = $em->createQueryBuilder();
        $qb->select('m');
        $qb->from('AppBundle:Menu', 'm');
        $qb->leftJoin('AppBundle:Route', 'r', 'WITH','m.idRoute = r.idRoute');
        $qb->where($qb->expr()->andX(
            $qb->expr()->isNull('r.idRoute'),
            $qb->expr()->isNotNull('m.idRoute')
        ));
        $menus = $qb->getQuery()->getResult();

        foreach ($menus as $key => $menu) {
            $menu->setIdRoute();
            $em->persist($menu);
            $em->flush();
        }

        $qb->select('m2');
        $qb->from('AppBundle:Menu', 'm2');
        $qb->where($qb->expr()->isNull('m2.idRoute'));
        $menus = $qb->getQuery()->getResult();


        if (($input->getOption('only-routes') !== true) && ($input->getOption('no-cache') !== true)) {
            $this->clearCache($output);
        }

        
        $io = new SymfonyStyle($input, $output);

        if (sizeof($menus) > 0) {
            $io->success('Done but there are some menus without route asigned, please check menu ABM');
        } else {
            $io->success('Done!!!');
        }
        
    }

    private function clearCache($output)
    {
        $command = $this->getApplication()->find('cache:clear');
        
        $arguments = array(
            'command'  => 'cache:clear',
        );

        $greetInput = new ArrayInput($arguments);
        return $command->run($greetInput, $output);
    }

    private function doctrineMigrate($output)
    {
        $command = $this->getApplication()->find('doctrine:migrations:migrate');
        
        $arguments = array(
            'command'     => 'doctrine:migrations:migrate',
        );

        $greetInput = new ArrayInput($arguments);
        return $command->run($greetInput, $output);
    }

}
