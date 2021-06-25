<?php

namespace App\Domains\User\Controller;

use App\Domains\User\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserList extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", statusCode=401, message="Unauthorized")
     */
    public function __invoke(Request $request): JsonResponse
    {
        $filterParams = $request->query->get('filter');
        $users = $this->userRepository->getOrderedUsers($filterParams);

        return $this->json(
            $users,
            Response::HTTP_OK,
            [],
            ['groups' => ['user_list']]
        );
    }
}
