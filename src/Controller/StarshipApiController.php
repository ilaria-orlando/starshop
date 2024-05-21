<?php

namespace App\Controller;

use App\Model\Starship;
use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// tell the controller that every route should be this route
#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getCollection(StarshipRepository $repository): Response
    {
        $starships = $repository->findAll();

        return $this->json($starships);
    }

    // route to fetch single object \d+ is added so route only matches when integer
    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id, StarshipRepository $repository): Response
    {
        $starship = $repository->find($id);

        // throw 404 if there is no starship found with that id in database
        if (!$starship) {
            throw $this->createNotFoundException('Starship not found!');
        }

        return $this->json($starship);
    }
}
