<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductFile;
use AppBundle\Entity\ProductRecord;
use AppBundle\Entity\Promotion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\FilePersist;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $beans  = new Product("Beans", 4.50);
        $rice   = new Product("Rice", 1.00);
        $pasta  = new Product("Pasta", 2.50);
        $meet   = new Product("Meet", 14.00);

        $beanRecord = new ProductRecord($beans);
        $riceRecord = new ProductRecord($rice);
        $pastaRecord = new ProductRecord($pasta);
        $meetRecord = new ProductRecord($meet);

        $persistence = new FilePersist('product.txt');
        $persistence->create($beanRecord);
        $persistence->create($riceRecord);
        $persistence->create($pastaRecord);
        $persistence->create($meetRecord);

        $result     = $persistence->research($riceRecord);
        $persistence->delete($pastaRecord);

        $beanRecord->getProduct()->setPrice(10.50);
        $persistence->update($beanRecord);

        $meetPromotion = new Promotion($meet, 10);
        $beanPromotion = new Promotion($meet, 50);

        $splStack = new \SplStack();
        $splStack->push(new Promotion($meet, 10));
        $splStack->push(new Promotion($beans, 10));

        $lastPromotion = $splStack->pop();

        dump($lastPromotion
        ,__METHOD__."::".__LINE__); exit();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
