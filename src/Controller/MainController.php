<?php

namespace App\Controller;


use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
//        return $this->json([
//            'message' => 'Welcome to your new controller!',
//            'path' => 'src/Controller/MainController.php',
//        ]);
//        return new Response('<h1>welcom ali</h1>');
        return $this->render("home/index.html.twig");
    }

    /**
     * @Route("/custome/{name?}", name="custome")
     * @param Request $request
     * @return Response
     */
    public function custom( Request $request){
        dump($request->get("name"));
        $name=$request->get("name");
//        return new  Response("<h1> custome page".$name."</h1>");
        return $this->render("home/custom.html.twig",[
            'name'=>$name
        ]);

    }
    /**
     * @Route("/art", name="art")
     * @param Request $request
     * @return Response
     */
    public function article( Request $request){
//        $art=["art1","art2"];
        $art=$this->getDoctrine()->getRepository
        (Article::class)->findAll();
        return $this->render("home/articles.html.twig",['articles'=>$art]);

    }
    /**
     * @Route("/art/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function articleCreate( Request $request){
        $art=["art1","art2"];
        $entityManger=$this->getDoctrine()->getManager();
        $article=new Article();
        $article->setTitle("علی");
        $article->setBody("بادی علی  شسنتیمشسی");
        $entityManger->persist($article);
        $entityManger->flush();
        return new Response("Save success".$article->getId());

        return $this->render("home/articles.html.twig",['articles'=>$art]);

    }

}
