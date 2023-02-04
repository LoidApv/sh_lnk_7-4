<?php

namespace App\Controller;

use App\Entity\LinksMap;
use App\Model\UserLink;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;

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

    /*
    function index(): Response{

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
    
    public function redirectByShortLink(
            string $shortLinkSlug, 
            ManagerRegistry $managerRegistry
    ): Response{
        $em = $managerRegistry->getManager();
        $linkMap = $em->getRepository(LinksMap::class)->findOneBy(["shortLinkSlug"=>$shortLinkSlug]);

        if($linkMap){
            $originalLink = $linkMap->getOriginalLink();
            return $this->redirect($originalLink);
        }else{
            return new JsonResponse("Адрес не найден", 404);
        }
    }
    
    public function addShortLink(
            Request $request,
            SerializerInterface $serializer,
            ValidatorInterface $validator,
            ManagerRegistry $managerRegistry
    ): JsonResponse
    {
        $userLink = $serializer->deserialize($request->getContent(), UserLink::class, 'json', []);
        $errors = $validator->validate($userLink);

        if(count($errors)==0){
             
            $em = $managerRegistry->getManager();
            
            $entity = LinksMap::fromUserLink($userLink);
            $em->persist($entity);
            $em->flush();

            $shortLinkSlug = base_convert($entity->getId(), 10, 36);
            $entity->setShortLinkSlag($shortLinkSlug);
            $em->flush();
            
            $shortLink = "http://" . $_SERVER["HTTP_HOST"] . "/" . $shortLinkSlug;
            return $this->json($shortLink);
            
        }else{
            $message = [
                "text" => "Ошибка валидации",
                "errors" => $errors
            ];
            return $this->json($message, 400);
        }
    }
}
