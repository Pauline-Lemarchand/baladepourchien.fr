<?php
// tests/Form/ProductsFormTest.php
namespace App\Tests\Form;
use App\Entity\Dangers;
use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductsFormTest extends KernelTestCase{

 public function testNewDangers(){
 $Dangers=(new Dangers())
 ->setareaDanger('77')
 ->setnameDanger('77');
 

 self::bootKernel();
 $container = static::getContainer();
$error = $container->get('validator')->validate($Dangers);
$this->assertCount(0, $error);
 }
}
