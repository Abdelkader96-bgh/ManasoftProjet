<?php

namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase ;

class EquipmentControllerTest extends webTestCase
{
    //assurer le fonctionnnement de la page de formulaire
    public function testNewIsUp(){
        //créer le client http
         $client = static::createClient();
         $client->request('GET', '/equipment/new');
         $this->assertSame(200,$client->getResponse()->getStatusCode()); 
        // echo $client->getResponse()->getStatusCode();      
    }

    public function testAjoutNewEquipment(){
        $client = static::createClient();
        $crawler=$client->request('GET', '/equipment/new');
 
        $form = $crawler->selectButton('valider')->form();
        $form['equipment[name]'] = 'iphone7 78954g';
        $form['equipment[number]'] = '225khp';
        $form['equipment[category]'] = '1';
        $form['equipment[description]'] = 'très bonne qualité';
        $client->submit($form);
        $this->assertSame(1,$crawler->filter('html:contains("Nouveau Equipement")')->count()); 

  }
  public function testShowEquipment(){
    $client = static::createClient();
    $crawler=$client->request('GET', '/equipment/');
    $this->assertSame(1,$crawler->filter('html:contains("Equipments")')->count()); 
}
}

