<?php

namespace App\Controller;

use App\Model\Starship;
use App\Repository\StarshipRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//tell the controller that every route should be this route
#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getCollection(StarshipRepository $repository): Response
    {
        $starships = $repository->findAll();

        return $this->json($starships);
    }

    //route to fetch single object \d+ is added so route only matches when integer
    #[Route('/{id<\d+>}', methods:['GET'])]
    public function get(int $id, StarshipRepository $repository): Response
    {
        $starship = $repository->find($id);

        return $this->json($starship);
    }
}
