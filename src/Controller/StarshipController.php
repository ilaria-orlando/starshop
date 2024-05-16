<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StarshipController extends AbstractController
{
    #[Route('/starships/{id<\d+>},', name: 'app_starship_show')]
    public function show(int $id, StarshipRepository $repository): Response
    {
        $ship = $repository->find($id);

        //if id not found throw 404
        if(!$ship){
            throw $this-> createNotFoundException('Ship not found!');
        }

        //if id found run through template
        return $this-> render('starship/show.html.twig', [
            'ship' => $ship,
        ]);
    }
}
