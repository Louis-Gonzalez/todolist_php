<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On déclare la class nécessaire 

use App\TodolistPhp\Services\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Utils;
use App\TodolistPhp\Repository\TaskRepository;

// On déclare la classe TaskController
class TaskController extends AbstractController
{
    // On délcare la fonction index par default
    public function index()
    {
        $taskRepository = new TaskRepository();
        $tasks = $taskRepository->index();
        // // Rendre une vue
        $this->render('taskpage.twig', ['tasks' => $tasks]);
    }
    
// On délcare la fonction new
    public function new()
    {
        $text = "C'est la page pour ajouter une tâche !";

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

                $taskRepository = new TaskRepository();
                $taskRepository->new();
                // Redirection vers le tableau des tâches
                header('Location: /formation_php/todolist_php/public/task');
            };
        // Rendre une vue
        $this->render('tasknewpage.twig',   [
                                                'text' => $text,
                                            ]);
    }
    public function delete(int $id)
    {
        $taskRepository = new TaskRepository();
        $taskRepository->delete($id);
        header('Location: /formation_php/todolist_php/public/task');
    }
    public function update($id) 
    {
        $loader = new FilesystemLoader("../templates"); 
        $twig = new Environment($loader);

        $taskRepository = new TaskRepository();
        $task = $taskRepository->update($id);
        
        $this->render('taskupdatepage.twig',   [
                                                    'task' => $task
                                                ]);
    }
    // On délcare la fonction show qui prend en parametre $id
    public function show(int $id)
    {   

        $taskRepository = new TaskRepository();
        $task = $taskRepository->show($id);

        ////////////// Méthode 1 ////////////////////////////////////////////////////////////////
        // $tasks = $pdo->selectAll("SELECT * FROM task ");

        // echo $twig->render('taskshowpage.twig', [   
        //                                             'tasks' => $tasks,
        //                                             'id' => $id,
        //                                             'title' => $tasks[$id-1]['title'],
        //                                             'description' => $tasks[$id-1]['description'],
        //                                             'duration' => $tasks[$id-1]['duration'],
        //                                             'status' => $tasks[$id-1]['status'],
        //                                             'create_at' => $tasks[$id-1]['create_at'],
        //                                             'update_at' => $tasks[$id-1]['update_at']
        //                                         ]);

        /////////// Méthode 2 //////////////////////////////////////////////////////////////////////
        
        $this->render('taskshowpage2.twig',[
                                                    'task' => $task
                                                ]);
    }
    public function updateStatus(int $id)
    {
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $taskRepository = new TaskRepository();
        $task = $taskRepository->updateStatus($id);

        $this->render('taskpage.twig',  [
                                            'task' => $task
                                        ]);
    }
    public function showPlan()
    {
        $taskRepository = new TaskRepository();
        $tasks = $taskRepository->showPlan();

        $this->render('taskplanpage.twig',  [
                                                'tasks' => $tasks[0],
                                                'statusEnAttente' => $tasks[1],
                                                'statusEncours' => $tasks[2],
                                                'statusTermine' => $tasks[3]
                                            ]);
    }
}
