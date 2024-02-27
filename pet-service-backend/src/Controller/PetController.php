<?php

namespace App\Controller;

use App\Repository\PetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PetController extends AbstractController
{
    private PetRepository $petRepository;
    public function __construct(PetRepository $petRepository)
    {
        $this->petRepository = $petRepository;
    }
    #[Route("/pet", name:"add_pet", methods:["POST"])]
    public function index(Request $request): JsonResponse
    {
       
        $data = json_decode($request->getContent(), true);

        $name = $data['Name'];
        $breed = $data['Breed'];
        $type = $data['Type'];
        $gender = $data['Gender'];

        if (empty($name) || empty($breed)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }
        $this->petRepository->savePet($name, $breed, $type, $gender);

        return new JsonResponse(['status' => 'Pet created!'], Response::HTTP_CREATED);
    }
   
}
