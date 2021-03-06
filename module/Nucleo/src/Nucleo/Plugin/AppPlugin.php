<?php

/**
 * Created by PhpStorm.
 * User: jb
 * Date: 05/02/14
 * Time: 12:03
 */

namespace Nucleo\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Nucleo\Service\ServiceManager;

class AppPlugin extends AbstractPlugin {

    public function getEntity($module, $entity_name=null) {
        
        /*
         * Caso tenha se passado apenas o primeiro parâmetro
         * entende-se que este é o nome da classe
         * e então busca-se o nome do modulo onde este metodo foi chamado;
         */
        if(func_num_args()===1){
            $entity_name=$module;
            $module = $this->getModuleClass($module);
        }
                
        $service = $this->getController()->getServiceLocator()->get('Nucleo\ServiceManager')->getService($module, $entity_name, ServiceManager::TYPE_ENTITY);
        return $service;
    }
    
    public function getService($module, $service_name=null) {
        
        /*
         * Caso tenha se passado apenas o primeiro parâmetro
         * entende-se que este é o nome da classe
         * e então busca-se o nome do modulo onde este metodo foi chamado;
         */
        if(func_num_args()===1){
            $service_name=$module;
            $module = $this->getModuleClass($module);
        }

        $service = $this->getController()->getServiceLocator()->get('Nucleo\ServiceManager')->getService($module, $service_name, ServiceManager::TYPE_SERVICE);
        return $service;
    }
    
    
    private function getModuleClass($class){
                
        $controller      = $this->getController();
        $namespace = get_class($controller);
        $string_apagar = substr($namespace, strpos($namespace, '\\Controller'), strlen($namespace));
        $moduleName = str_replace($string_apagar, '', $namespace);
        return $moduleName;
    }
    

}
