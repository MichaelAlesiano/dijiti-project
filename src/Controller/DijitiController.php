<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use League\Csv\Reader;
use mysqli;

class DijitiController extends AbstractController
{
    /**
     * @Route("/dijiti", name="dijiti")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index()
    {   
        return $this->render('index.html.twig', [
            'controller_name' => 'DijitiController',
        ]);
    }

    public function gestione_utenti(
        Request $request,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        MailerInterface $mailer
    )
    {   
        /** $var User $user */
        $user = new User();
        $email = new Email();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            /** @var User $user */
            $user = $userForm->getData();

            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Utente registrato nel Database'
            );
            $email = (new Email())
            ->from('hello@example.com')
            ->to('6623d0406e-e4f2e4@inbox.mailtrap.io')
            ->subject('!ATTENZIONE!')
            ->html('<p>Qualcosa è cambiato nel Database</p>');
            $mailer->send($email);
        }

        $conn = mysqli_connect("localhost", "root", "root", "dijiti");

        if (isset($_POST["import"])){
            $fileName = $_FILES["file"]["tmp_name"];

            if ($_FILES["file"]["size"] > 0) {
                $file = fopen($fileName, "r");

                while(($column = fgetcsv($file, 10000, ",")) !==FALSE) {
                    $sqlInsert = "Insert into user (nome,cognome,email,username,password,telefono) values ('" . $column[0] . " ', '" . $column[1] . " ', '" . $column[2] . " ', '" . $column[3] . " ', '" . $column[4] . " ', '" . $column[5] . " ')";

                    $result = mysqli_query($conn, $sqlInsert);

                }
            }
        }

        $users = $userRepository->findAll();

        return $this->render('gestione_utenti.html.twig', [
            'users' => $users,
            'controller_name' => 'DijitiController',
            'userForm' => $userForm->createView()
        ]);
    }

    public function gestione_database()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'EasyAdminController',
        ]);
    }
}
