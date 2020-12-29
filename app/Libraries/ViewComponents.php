<?php namespace App\Libraries;

class ViewComponents {
    public function getNavbar(){
        $service = \Config\Services::request();
        $data['activo'] = $service->uri->getSegment(1);
                
        return view('components/navbar', $data);
    }
}

?>