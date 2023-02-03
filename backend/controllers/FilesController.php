<?php
class FilesController extends BaseController{
    public function upload(){
        $params = $this->getParams();

        switch ($params['table'][0]) {
            case 'mlProducts':
   
                break;
            case 'cbProducts':

                break;
            case 'cbVendors':

                break;
        }

        if(!empty($_FILES['file'])){
            foreach ($_FILES as $key => $value) {
                $this->outputData($key);
            }            
        }
    }
}