<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Profile;
use App\Form\ProfileImageType;
use App\Form\ProfileType;
use App\Repository\ImageRepository;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    private $profileRepository;
    private $imageRepository;
    private $em;
    public function __construct(ProfileRepository $profileRepository, ImageRepository $imageRepository, EntityManagerInterface $em)
    {
        $this->profileRepository = $profileRepository;
        $this->imageRepository = $imageRepository;
        $this->em=$em;
    }
   
    #[Route('/', name: 'profile')]
    public function create(Request $request): Response
    {
        $profile = new Profile();
        $createProfileForm = $this->createForm(ProfileType::class, $profile);
        $createProfileForm->handleRequest($request);

        $addProfileImageForm = $this->createForm(ProfileImageType::class );
        $addProfileImageForm->handleRequest($request);
       
        if($createProfileForm->isSubmitted() && $createProfileForm-> isValid()){
            $newProfile = $createProfileForm->getData();
            
            $this->em->persist($newProfile);
            $this->em->flush();
        }

        if($addProfileImageForm->isSubmitted()&& $addProfileImageForm -> isValid()){
            $imagesPackAll= $addProfileImageForm->get('fileName')->getData();
            if($imagesPackAll){
                foreach($imagesPackAll as $imageC){
                    $newFileName= uniqid(). '.' . $imageC->guessExtension();
                    try{
                        $imageC->move(
                            $this ->getParameter('kernel.project_dir') . '/public/images/profile',
                            $newFileName
                        );
                        $newCPhoto = new Image();
                       
                        $newCPhoto ->setImageName($newFileName);
                        $newCPhoto-> setProfile($newProfile);
                        $this->em->persist($newCPhoto);
                        $this->em->flush();
                    } catch(FileException $e){

                    }
                }
            }
        }

        

            /*
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
            */
            
            
            
            

        

        return $this->render('profile/index.html.twig', [
            'form' => $createProfileForm,
            'image_form'=>$addProfileImageForm
        ]);
    }
}
