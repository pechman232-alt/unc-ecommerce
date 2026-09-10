<?php

namespace App\Services;

class Service{
      public function permission(){
            $activeSubMenus = session()->get('activeSubMenus');
            if(is_array($activeSubMenus) || is_iterable($activeSubMenus)){
                  foreach($activeSubMenus as $activeSubMenu){
                        if((request()->is($activeSubMenu->route))){
                              return true;
                        }
                  }
                  return false;
            }
      }
}

