<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Form\LinkType;
use App\Repository\LinksMapRepository;
use App\Repository\UserRepository;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ShortLinksController
 *
 * @author Main
 */
class ShortLinksController extends AbstractController {
    
    private UserRepository $userRepo;
    private LinksMapRepository $linkRepo;
    
    public function __construct(UserRepository $userRepo, LinksMapRepository $linkRepo) {
        $this->userRepo = $userRepo;
        $this->linkRepo= $linkRepo;
    }
    
    /*
    function index(): Response{
        
        # Надо подвязать к ссылкам
        $user = $this->userRepository->find(1);
        
        $links = $this->linkRepo->findAll();
        foreach($links as $link){
            $retLinks[] = [
                "short" => $link->getShortLink(),
                "original" => $link->getOriginalLink()
            ];
        }
        
        return $this->render('links/index.html.twig', [
            'username' => $user->getName(),
            'links' => $retLinks,
        ]);
    }
    */
    
    public function redirectByShortLink(string $shortLinkSlug): Response{
        
        # Авторизация для использования короткой ссылки не оч затея
        # $user = $this->userRepo->find(1); 
        
        $link = $this->linkRepo->findOneBy(["shortLinkSlug"=>$shortLinkSlug]);

        if($link){
            $originalLink = $link->getOriginalLink();
            return $this->redirect($originalLink);
        }else{
            return new Response("Адрес не найден", 404);
        }
    }
    
    public function addShortLink(Request $request): Response{
        
        
        $user = $this->userRepo->find(1); // Типо получили текущего пользователя
        /*  Чтоб не дропало без создания дефолт юзера
        if(!$user){
            $message = [
                "text" => "Пользователь по умолчанию умер"
            ];
            return $this->json($message, 400);
        }*/

        $form = $this->createForm(LinkType::class);
        $form->submit($request->request->all(), false);
        $formData = $form->getData();

        if($form->isSubmitted() && $form->isValid()){
             
            $link = $this->linkRepo->registerLink($formData["name"], $formData["originalLink"]);
            if(isset($user) && !is_null($user)){
                $this->userRepo->addLink($user, $link);
            }
            $shortLink = "http://" . $_SERVER["HTTP_HOST"] . "/" . $link->getShortLinkSlug();
            return $this->json($shortLink);
            
        }else{
            $errors = $form->getErrors();
            $message = [
                "text" => "Ошибка валидации",
                "errors" => $errors
            ];
            return $this->json($message, 400);
        }
    }
}
