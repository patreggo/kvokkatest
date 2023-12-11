<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    private $profileRepository;
    private $em;
    public function __construct(ProfileRepository $profileRepository, EntityManagerInterface $em)
    {
        $this->profileRepository = $profileRepository;
        $this->em=$em;
    }
   
    #[Route('/profile', name: 'profile')]
    public function create(Request $request): Response
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form-> isValid()){
            $newProfile = $form->getData();
            
            if($images=$form['images']->getData()){
                $fileNameArray=[];
                foreach($images as $image){
                    $newFileName = uniqid() . '.' . $image -> guessExtension();
    
                    $image-> move(
                        $this ->getParameter('kernel.project_dir') . '/public/images',
                        $newFileName
                    );
                    array_push($fileNameArray, $newFileName);
                    
                }
                $newProfile ->setImages($fileNameArray);
            }
            
            
            
            $this->em->persist($newProfile);
            $this->em->flush();


        }

        return $this->render('profile/index.html.twig', [
            'form' => $form,
        ]);
    }
}
